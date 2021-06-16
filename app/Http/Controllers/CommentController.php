<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //


    public function handlePostComment(CommentService $commentService){

        return $commentService->handlePostComment();
        
   }

   
   public function handleCommentReply(CommentService $commentService){

    return $commentService->handleCommentReply();
    
}

   public function getAllComments($id, CommentService $commentService){

        return $commentService->getAllComments($id);
   }

   public function getAllUserComments($id, CommentService $commentService){

    return $commentService->getAllUserComments($id);
}


   public function getAllReplies($id, CommentService $commentService){
    return $commentService->getAllReplies($id);
   }

   public function getMoreReplies($id, $count, $user_id, CommentService $commentService){
    
    return $commentService->getMoreReplies($id, $count, $user_id);
   }
}
