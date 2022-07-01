<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showInvitedLogin(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $teamId = $request->team_id;
        $signature = Hash::make('team_id='. $teamId);
        return view('auth.invited.login', compact('teamId', 'signature'));
    }

    public function authenticated(Request $request, $user)
    {
        $input = $request->only('team_id', 'signature');
        $routeFrom = parse_url(url()->previous());
        if($routeFrom['path'] === '/login_invited') {
            if(Hash::check('team_id='. $input['team_id'], $input['signature'])) {
                $user->teams()->sync($input['team_id']);
                return redirect()->route('team.show', $input['team_id']);
            } else {
                abort(401);
            }
        } elseif($routeFrom['path'] === '/login') {
            return redirect()->route('mypage');
        } else {
            abort(401);
        }
    }

    protected function loggedOut()
    {
        return redirect(route('login'));
    }
}
