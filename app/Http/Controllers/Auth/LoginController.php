<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function redirectToKeycloak()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function handleKeycloakCallback()
    {
        
        $user = Socialite::driver('keycloak')->user();
        $existingUser = User::where('email', $user->email)->first();
        
        if ($existingUser) {
            Auth::login($existingUser);
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();

        $redirectUri = config('app.url').'/logout/callback';

        // Redirect to Keycloak logout URL.
        $logoutUrl = Socialite::driver('keycloak')->getLogoutUrl($redirectUri, env('KEYCLOAK_CLIENT_ID'));
    
        return redirect($logoutUrl);
    }

    public function handleLogoutCallback()
    {
        return redirect()->route('login');
    }


}
