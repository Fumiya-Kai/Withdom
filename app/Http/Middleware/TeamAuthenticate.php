<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamAuthenticate
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
        $teamId = $request->route()->parameter('teamId');
        $usersTeams = Auth::user()->teams;
        foreach($usersTeams as $usersTeam) {
            if($usersTeam->id == $teamId) {
                return $next($request);
            }
        }
        return redirect()->route('home');
    }
}
