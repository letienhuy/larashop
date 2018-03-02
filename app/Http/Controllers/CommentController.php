<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Rate;
class CommentController extends Controller
{
    /**
     * Add comment/reply
     *
     * @param Request $req
     * @param int $productId
     * @param int $commentId
     * @return void
     */
    public function addComment(Request $req, $productId, $commentId = 0){
        if(is_null($req->comment))
            return response('', 404)->header('Content-type', 'text/plain');
        $comment = new Comment();
        $comment->comment = $req->comment;
        $comment->comment_id = $commentId;
        $comment->product_id = $productId;
        $comment->user_id = \Auth::id();
        $comment->save();
        return response('', 200)->header('Content-type', 'text/plain');
    }
    /**
     * Get comment for productId
     *
     * @param integer $productId
     * @param integer $skip
     * @param integer $take
     * @return void
     */
    public function getComment($productId, $skip = 0, $take = 5){
        $comment = Comment::where(['product_id' => $productId, 'comment_id' => 0])->orderBy('id','desc')->skip($skip)->take($take)->get();
        $html = view('comment.comment', [
            'comment' => $comment
        ])->render();
        return response()->json(['html' => $html]);
    }
    /**
     * Edit comment
     *
     * @param Request $req
     * @param int $commentId
     * @return void
     */
    public function editComment(Request $req, $commentId){
        if(is_null($req->comment))
        return response('', 404)->header('Content-type', 'text/plain');
        $comment = Comment::find($commentId);
        $comment->comment = $req->comment;
        $comment->save();
        return response('', 200)->header('Content-type', 'text/plain');
    }
    /**
     * Remove comment
     *
     * @param [type] $commentId
     * @return void
     */
    public function removeComment($commentId){
        $comment = Comment::find($commentId)->delete();
        $replyComment = Comment::where('comment_id', $commentId)->delete();
        return response('', 200)->header('Content-type', 'text/plain');

    }
    /**
     * Get reply comment for commentId
     *
     * @param integer $commentId
     * @param integer $skip
     * @param integer $take
     * @return void
     */
    public function getReply($commentId, $skip = 0, $take = 5){
        $comment = Comment::find($commentId);
        $replyComment = Comment::where('comment_id', $commentId)->orderBy('id','desc')->skip($skip)->take($take)->get();
        $html = view('comment.reply', [
            'replyComment' => $replyComment
        ])->render();
        return response()->json(['html' => $html]);
    }
    /**
     * Get rate for product
     *
     * @param integer $productId
     * @param integer $skip
     * @param integer $take
     * @return void
     */
    public function getRate($productId, $skip = 0, $take = 5){
        $rate = Rate::where(['product_id' => $productId])->orderBy('id','desc')->skip($skip)->take($take)->get();
        $html = view('comment.rate', [
            'rates' => $rate
        ])->render();
        return response()->json(['html' => $html]);
    }
}
