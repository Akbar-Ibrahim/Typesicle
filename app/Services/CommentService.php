<?php
namespace App\Services;
use App\Comment;
use Illuminate\Http\Request;
use App\CommentReply;
use App\Events\CommentEvent;
use App\Events\ReplyEvent;

class CommentService
{
    
    public function handlePostComment() {

        $post_id = request()->postId;
        $user_id = request()->userId;
        $body = request()->body;

        // Comment::create($data);
        $comment = Comment::create(['feed_id' => $post_id, 'user_id' => $user_id, 'body' => $body]);

        // $request->session()->flash('comment_post', 'Your comment has been posted and is awaiting moderation');
        $comments = Comment::where(["feed_id" => $post_id])->get();
        $numOfComments = $comments->count();

        $comment->load('user.profile', 'replies');

        broadcast(new CommentEvent($comment, $numOfComments));
                return $comment;
    

    }


    public function getAllComments($id) {

        return Comment::where('feed_id', $id)->with('user.profile', 'replies.user.profile')->get();

    }

    public function getAllUserComments($id) {

        return Comment::where('user_id', $id)->with('user.profile', 'postLookUp.post.user', 'replies.user.profile')->get();

    }


    public function handleCommentReply(){
  
            // $user = auth()->user();      
            $comment_id = request()->commentId;
            $user_id = request()->userId;
            $body = request()->body;

            $comment = Comment::where(["id" => $comment_id])->first();

            $reply = CommentReply::create(['comment_id' => $comment_id, 'user_id' => $user_id, 'body' => $body]);

            $replies = CommentReply::where(["comment_id" => $comment_id])->first();
            $numOfReplies = $replies->count();


            $reply->load('user.profile');
            broadcast(new ReplyEvent($comment, $reply, $numOfReplies))->toOthers();

            return $reply;
    }

    public function getAllReplies($id) {

        return CommentReply::where('comment_id', $id)->with('user.profile')->get();

    }

    public function getMoreReplies($id, $count, $user_id) {

        $replies = CommentReply::where(["comment_id" => $id])->get();
        $replyCount = $replies->count();
        $take = $replyCount - $count;
        // return $replyCount;
        $newReplies = CommentReply::where('comment_id', $id)->with('user.profile')->skip($count)->take($take)->get();
        $result = [];
        $toNum = (int)$user_id;

        // foreach ($newReplies as $n) {
        //     if ($n->user_id !== $toNum) {
        //         array_push($result, $n);
        //     }
        // }
        
        return $newReplies;


    }

}
