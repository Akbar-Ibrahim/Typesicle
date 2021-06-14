<?php
namespace App\Services;

use App\Category;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class PhotoService{
    
    public function photos($id){
        
        return Photo::where(['user_id' => $id])->orderBy('created_at', 'desc')->get();
    }
    
    public function getPhotos($id){
        
        return Photo::where(['user_id' => $id])->orderBy('created_at', 'desc')->limit(9)->get();
        // return User::where(["id" => $id])->with('photos')->orderBy("created_at", "desc")->limit(4)->get();
    }

}

?>