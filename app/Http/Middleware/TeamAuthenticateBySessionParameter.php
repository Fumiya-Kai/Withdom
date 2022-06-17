<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeamAuthenticateBySessionParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('team_id')) {
            $teamIdData = $request->session()->get('team_id');
            if(Hash::check('team_id='. $teamIdData['id'], $teamIdData['check'])) {
                $usersTeams = Auth::user()->teams;
                foreach($usersTeams as $usersTeam) {
                    if($usersTeam->id == $teamIdData['id']) {
                        return $next($request);
                    }
                }
            }
        }
        return response(view('error.failed_team_authentication'));
    }
}
