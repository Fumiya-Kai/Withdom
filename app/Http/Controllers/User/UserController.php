<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    private $article;
    private $team;

    public function __construct(User $user, Article $article, Team $team)
    {
      $this->user = $user;
      $this->article = $article;
      $this->team = $team;
    }

    public function mypage()
    {
      $teams = $this->team->getByUserId(Auth::id());
      $articles = $this->article->getByUserId(Auth::id());

      return view('mypage', compact('teams', 'articles'));
    }
}
