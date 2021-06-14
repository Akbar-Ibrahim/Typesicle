<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feed;
use App\Services\AccountService;
use App\Services\CategoryService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryUtilController extends Controller
{
    //

    public function createCategory(CategoryService $categoryService)
    {
        //
        return $categoryService->createCategory();
    }

    public function getMyCategories(CategoryService $categoryService)
    {

        return $categoryService->getMyCategories();
    }

    public function getUserCategories($username, CategoryService $categoryService)
    {
        //

        $user = User::where('username', $username)->first();
        $user_categories = $categoryService->getUserCategories($user);

        return $user_categories;
    }

    public function getCategory($username, $categoryURL, CategoryService $categoryService)
    {

        $user = User::where('username', $username)->first();
        $user_categories = $categoryService->getUserCategories($user);
        $category = Category::where(["url" => $categoryURL])->with('feeds', 'posts')->first();

        $feeds = [];
        

        if (Auth::check()){
        foreach ($category->posts as $post) {
            if ($post !== null) {
                $feed = Feed::where(["category_id" => $post->category_id])->with("post.photo", "post.user.profile", "post.category", "user.profile", "shortie.shortiePhoto.photo")->first();
                if ($feed !== null) {
                    if ($feed->post) {
                        if (auth()->user()->isLiked($feed->post_id)) {
                            // $feed->is_liked = "yes";
                            $feed->post->is_liked = 1;
                        } else {
                            // $feed->is_liked = "no";
                            $feed->post->is_liked = 0;
                        }

                        if (auth()->user()->isReposted($feed->post_id)) {
                            // $feed->is_shared = "yes";
                            $feed->post->is_shared = 1;
                        } else {
                            // $feed->is_shared = "no";
                            $feed->post->is_shared = 0;
                        }

                        if (auth()->user()->isQueued($feed->post_id)) {
                            $feed->post->is_queued = 1;
                        } else {
                            $feed->post->is_queued = 0;
                        }


                        array_push($feeds, $feed);
                    } else if ($feed->shortie) {
                        if (auth()->user()->isLikedShortie($feed->shortie_id)) {
                            $feed->shortie->is_liked = 1;
                        } else {
                            $feed->shortie->is_liked = 0;
                        }

                        if (auth()->user()->isSharedShortie($feed->shortie_id)) {
                            $feed->shortie->is_shared = 1;
                        } else {
                            $feed->shortie->is_shared = 0;
                        }

                        array_push($feeds, $feed);
                    }
                }
                // array_push($feeds, $feed);
            }
        }
        // return $feeds;
    } else {
        foreach ($category->posts as $post) {
            if ($post !== null) {
                $feed = Feed::where(["category_id" => $post->category_id])->with("post.photo", "post.user.profile", "post.category", "user.profile", "shortie.shortiePhoto.photo")->first();
                array_push($feeds, $feed);
            }
        }
        // return $feeds;
    }
        return view("category.posts", compact("user",  "user_categories", "category", "feeds"));
    }
}
