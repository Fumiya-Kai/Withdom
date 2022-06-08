<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(Team $team, Article $article)
    {
        $this->team = $team;
        $this->article = $article;
    }

    public function show($id)
    {
        $articles = $this->article->getByTeamId($id);
        $users = $this->team->getMembers($id);
        return view('team', compact('articles', 'users'));
    }

    public function create()
    {
        return view('team_create');
    }
}
