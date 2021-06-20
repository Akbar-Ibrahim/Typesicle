<?php

namespace App\Http\Controllers;

use App\Services\PostUtilService;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    
        public function welcome (PostUtilService $postUtilService) {
            $feeds = $postUtilService->getHomeFeeds();
            $user = ["id" => 0, "name" => "guest"];
            
            return view('welcome', compact('feeds', 'user'));
        }
}
