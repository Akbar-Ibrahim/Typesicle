<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Services\PhotoService;
use App\User;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    //

    public function photos($username, PhotoService $photoService) {
        
        $user = User::where(['username' => $username])->first();
        $photos = $photoService->photos($user->id);
        
        
        if (auth()->user()) {
            $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
            return view('photos.index', compact('photos', 'user', 'n'));
        } else {
            return view('photos.index', compact('photos', 'user'));
        }

        
    }

    public function getPhotos($id, PhotoService $photoService) {
        
        return $photoService->getPhotos($id);
    }
}
