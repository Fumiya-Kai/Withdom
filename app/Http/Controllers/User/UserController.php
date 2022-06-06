<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      $teams = $this->user->getTeamsByUserId(Auth::id());
      $articles = $this->article->getByUserId(Auth::id());
      return view('mypage', compact('teams', 'articles'));
    }
}
