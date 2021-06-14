<?php

namespace App\Http\Controllers;

use App\Draft;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        $drafts = Draft::where(['user_id' => $user->id])->get();

        return view("drafts.index", compact("drafts", "user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //       

        $input = $request->all();
        $user = auth()->user();
        $photos = Photo::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();        

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images/' . auth()->user()->id . '/', $name);
            $photo = Photo::create(['photo' => $name, 'user_id' => auth()->user()->id]);
            $input['photo_id'] = $photo->id;

        }

        if ($cover_image = Photo::where(['photo' => str_replace('/images/' . auth()->user()->id . '/', '', request()->cover_photo)])->first()) {
            $input['photo_id'] = $cover_image->id;
        }

        $draft = $user->drafts()->create($input);
        

         return redirect('/draft');
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
        $user = auth()->user();
        $draft = Draft::where(["id" => $id])->first();

        return view("drafts.show", compact("draft", "user"));
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
        $user = auth()->user();
        // $draft = Draft::findOrFail($id);
        $draft = Draft::where(["id" => $id])->with("photo")->first();
        $post = Post::where(["id" => $draft->responding_to])->first();
        $photos = Photo::where(["user_id" => $user->id])->get();

        return view("drafts.edit", compact("draft", "post", "user", "photos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $draft = Draft::findOrFail($id);

        if (! Gate::allows('update-draft', $draft)) {
            abort(403);
        }

        $user = auth()->user();
        $input =$request->all();
        
        if($cover_image = $request->file('photo_id')){
            $image_name = time() . $cover_image->getClientOriginalName();
        // $cover_image = Image::make($cover_image)->resize(200, 170);
        $cover_image->storePubliclyAs($user->id . '/', $image_name, ['disk' => 'public']);
        // $cover_image->save('images/' . auth()->user()->id . '/' . $image_name, 80, 'png');
        $photo = Photo::create(['photo' => $image_name, 'user_id' => auth()->user()->id]);
        $input['photo_id'] = $photo->id;
    }

    if ($cover_image = Photo::where(['photo' => str_replace('/images/' . auth()->user()->id . '/', '', $request->cover_photo)])->first()) {
        $input['photo_id'] = $cover_image->id;
    }
        
        $draft->update($input);


        return redirect("/draft");

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
    }
}
