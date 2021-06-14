<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
// use Socialite;
use Exception;
// use Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    //

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['google_id'] = $user->getId();
            $userModel = new User;

            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);

            return redirect()->route('home');

        } catch (Exception $e) {

            return redirect('auth/google');
        }
    }
}
