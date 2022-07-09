<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    private $comment;
    private $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;
    }

    public function comment($articleId, Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['article_id'] = $articleId;
        $newComment = $this->comment->saveNewComment($input);
        $commentData = [
            'content' => $newComment->content,
            'user' => $this->user->find($newComment->user_id)->name,
        ];
        return response()->json($commentData);
    }
}
