<?php

namespace App\Http\Controllers;

use App\Services\PostUtilService;
use App\Services\ShortieService;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    //

    public function thread($username, $id, PostUtilService $postUtilService, ShortieService $shortieService){
        
        $user = $postUtilService->getUser($username);
        $feed = $postUtilService->getFeed($id);
        $recentShorties = $shortieService->recentShorties($user->id);

        return view('shortie.thread', compact('user', 'feed', 'recentShorties'));
    }
}
