<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            if ($user->role_id == 1) {
                return redirect()->route('depart.home');
            } else if ($user->role_id == 2) {
                return redirect()->route('mitra.home');
            } else if ($user->role_id == 3) {
                return redirect()->route('dospem.home');
            } else if ($user->role_id == 4) {
                return redirect()->route('supervisor.home');
            } else if ($user->role_id == 5) {
                return redirect()->route('mahasiswa.home');
            }
        } else {
            return redirect()->route('login')
            ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}
