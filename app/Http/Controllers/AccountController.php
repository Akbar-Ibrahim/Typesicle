<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    public function accountsToFollow($id, AccountService $accountService) {

        return $accountService->accountsToFollow($id);
    }

    public function followers($id, AccountService $accountService) {

        return $accountService->followers($id);
    }


    public function getProfile($id, AccountService $accountService) {

        return $accountService->getProfile($id);
    }

    
    public function getMostPopularAuthors($username, AccountService $accountService, PostUtilService $postUtilService) {
        $user = $postUtilService->getUser($username);
        return $accountService->getMostPopularAuthors($user);
    }
}
