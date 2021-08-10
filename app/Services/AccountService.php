<?php
namespace App\Services;

use App\Category;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class AccountService{
    
    
    public function accountsToFollow($id) {
        
        $user = User::where(["id" => $id])->first();
        $accounts = User::where('id', '!=', $id)->where('role', '!=', 'guest')->with('profile.photo')->get();
        $users = [];

        foreach($accounts as $account) {
        if ( !$account->isFollowing($user->profile->id) && !$user->isFollowing($account->id) ) {
            array_push($users, $account);
        }
    }
        // return User::where('id', '!=', auth()->user()->id)->with('profile')->get();
        return $users;
    }



    public function followers($id) {
        
        $user = User::where(["id" => $id])->first();
        $accounts = User::where('id', '!=', $id)->with('profile.photo')->get();
        $users = [];

        foreach($accounts as $account) {
        if ($account->isFollowing($user->profile->id)) {
            array_push($users, $account);
        }
    }
        // return User::where('id', '!=', auth()->user()->id)->with('profile')->get();
        return $users;
    }


    public function getPhotos($id){
        
        return Photo::where(['user_id' => $id])->orderBy('created_at', 'desc')->limit(9)->get();
    }

    
    public function getProfile($id) {

        return User::where(["id" => $id])->with("profile.photo")->first();
    }


    public function getMostPopularAuthors($user) {

        return User::postGreaterTen()->where('id', '!=', $user->id)->with('profile.photo', 'posts')->get();
    }

}

?>