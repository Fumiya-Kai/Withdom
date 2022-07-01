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
        session([
            'team_id' => [
                'id' => $request->team_id,
                'check' => Hash::make('team_id='. $request->team_id)
            ]
        ]);
        return view('auth.invited.login');
    }

    public function authenticated(Request $request, $user)
    {
        if(! $request->session()->has('team_id')) {
            abort(401);
        }
        $teamIdData = $request->session()->get('team_id');
        $routeFrom = parse_url(url()->previous());
        if($routeFrom['path'] === '/login_invited') {
            if(Hash::check('team_id='. $teamIdData['id'], $teamIdData['check'])) {
                $user->teams()->sync($teamIdData['id']);
                return redirect()->route('team.show', $teamIdData['id']);
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
