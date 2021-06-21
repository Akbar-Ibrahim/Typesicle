<?php

namespace App\Http\Controllers;

use App\History;
use App\Notification;
use App\Services\HistoryService;
use App\Services\PostUtilService;
use App\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //

    public function index($username, HistoryService $historyService, PostUtilService $postUtilService) {

        // $user = User::where('id', auth()->user()->id)->first();
        $user = $postUtilService->getUser($username);
        $history = $historyService->getHistory($user);
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        

        return view('history.index', compact('history', 'user', 'n'));
    }

    public function delete(Request $request){

        History::where(["user_id" => auth()->user()->id])->delete();

        return redirect()->back();
    }
}
