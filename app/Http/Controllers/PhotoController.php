<?php

namespace App\Http\Controllers;

use App\Services\PhotoService;
use App\User;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    //

    public function photos($username, PhotoService $photoService) {
        
        $user = User::where(['username' => $username])->first();
        $photos = $photoService->photos($user->id);

        return view('photos.index', compact('photos', 'user'));
    }

    public function getPhotos($id, PhotoService $photoService) {
        
        return $photoService->getPhotos($id);
    }
}
