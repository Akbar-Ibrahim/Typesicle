<?php
namespace App\Services;

use App\Category;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class CategoryService{
    
    
    public function createCategory() {



        $user = auth()->user();
        $name = request()->category;
        $url = request()->category;

        $category = Category::create(['user_id' => $user->id, 'name' => $name, 'url' => $url]);

        $category->load('user.profile');
        return $category;
    

    }


    public function getUserCategories($user){

        return Category::where(['user_id' => $user->id])->with('user.profile', 'feeds', 'posts')->get();        
    }  

    public function getMyCategories() {

        $user_id = request()->user_id;
        return Category::where(["user_id" => $user_id])->with("user", "feeds", "posts")->get();
    }

    public function getTopCategories(){

        return Category::postCountTen()->with('posts', 'user')->get();
    
    }
    


}

?>