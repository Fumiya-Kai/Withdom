<?php

namespace App\Http\Middleware;

use App\Models\Article;
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
        $routeTo = str_replace(url(''), '', url()->current());

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
        } elseif(preg_match('/\/article\/[0-9]+/', $routeTo) === 1) {
            $articleId = str_replace(url(''). '/article/', '', url()->current());
            if(Article::find($articleId)->user_id === Auth::id()) {
                return $next($request);
            };
        }
        return response(view('error.failed_team_authentication'));
    }
}
