<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Feed;


class SearchService{
    
    
    public function searchAuthorList() {

        $searchterm = request()->q;
        
        $users = User::where('name','LIKE','%'.$searchterm.'%')->orWhere('username','LIKE','%'.$searchterm.'%')
        ->with('profile', 'posts')->get();


        $users->makeHidden(['role_id', 'is_active', 'email', 'email_verified_at', 'created_at', 'updated_at']);

        return $users;
        

    

    }


    public function searchPostList() {

        $searchterm = request()->q;

        $posts = Post::where('title','LIKE','%'.$searchterm.'%')->with('user.profile', 'user', 'feed')->get();

        // $posts->makeHidden(['user_id', 'is_active', 'email', 'email_verified_at', 'created_at', 'updated_at']);

        $feeds = [];

        foreach ($posts as $post) {
            if ($post !== null) {
            $feed = Feed::where(["post_id" => $post->id])->with("post.photo", "post.user.profile", "post.category", "user.profile", "shortie.shortiePhoto.photo")->first();
            if ($feed !== null) {
            array_push($feeds, $feed);
            }
            }
        }


        return $feeds;
        
  }

}

?>