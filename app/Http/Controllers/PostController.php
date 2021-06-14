<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feed;
use App\Hashtag;
use App\Http\Requests\PostRequest;
use App\Photo;
use App\Post;
use App\Services\PhotoService;
use App\Services\PostService;
use App\Services\PostUtilService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username, $url, $id, PostUtilService $postUtilService)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $photos = Photo::where(['user_id' => auth()->user()->id])->get();
        $user = auth()->user();

        $responding_to = $request->responding_to;

        $feed = Feed::where(['post_id' => $responding_to])->first();

        return view('write.create', compact('photos', 'user', 'feed'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostService $postService)
    {

        
        $postService->insertPost($request);
        
        return redirect("/" . auth()->user()->username);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $user = auth()->user();

        $body = $post->body;
        $body = str_replace("#", " #", $body);
        $body = str_replace("<", " <", $body);
        $body = str_replace(">", "> ", $body);

        $tags = getHashTags($body);

        if (count($tags) > 0) {
            foreach ($tags as $tag) {

                $findHashtag = Hashtag::where('hashtag', 'like', "%{$tag}%")->first();
                
                $hashtagUrl = str_replace("#", "", $findHashtag->hashtag);
                $anchoredHashtag = str_replace("<a href='/hashtag/" . $hashtagUrl . "'>" . $tag . "</a>", $tag, $post->body);
                $post->update(['body' => $anchoredHashtag]);
            }
        }

        $photos = Photo::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();

        
        return view('write.edit', compact('post', 'categories', 'user', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PostService $postService)
    {
        //
        $post = Post::findOrFail($id);

        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }

        $postService->updatePost($id);
        return redirect("/".auth()->user()->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $feed = Feed::findOrFail($id);
        $post = Post::where(["id" => $feed->post_id])->delete();
        $feed->delete();
    }


}
