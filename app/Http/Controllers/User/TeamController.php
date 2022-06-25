<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\TeamRequest;
use App\Mail\NewTeamInvitation;
use App\Models\Article;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $team = $this->team->find($id);
        return view('team', compact('articles', 'users', 'team'));
    }

    public function create()
    {
        return view('team_create');
    }

    public function store(TeamRequest $request)
    {
        $input = $request->validated();
        $teamId = $this->team->createTeamAndGetId($input, Auth::id());
        $this->invite($input['emails'], Auth::user()->name, $input['name'], $teamId);
        return redirect()->route('mypage');
    }

    public function showInviteForm()
    {
        return view('invite');
    }

    public function inviteToExistingTeam(InviteRequest $request)
    {
        $input = $request->validated();
        $teamIdData = $request->session()->get('team_id');
        $teamId = $teamIdData['id'];
        $teamName = $this->team
                         ->find($teamId)
                         ->first()
                         ->name;
        $this->invite($input['emails'], Auth::user()->name, $teamName, $teamId);
        return redirect()->route('team.show', $teamId);
    }

    private function invite($mailTo, $fromName, $teamName, $teamId)
    {
        foreach($mailTo as $address) {
            Mail::to($address)->send( new NewTeamInvitation($fromName, $teamName, $teamId) );
        }
    }
}
