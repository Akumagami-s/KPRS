<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

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
    
    protected $maxAttempts = 6;
    protected $decayMinutes = 30;

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

    public function authenticated()
    {
        // if (auth()->user()->last_session == '') {
        //     auth()->user()->update([
        //         'last_session' => session()->getId()
        //     ]);
        // }
        // if(session()->getId() != auth()->user()->last_session){
        //   Auth::logout();
        //   return redirect()->route('login')->with('error', 'Akun sedang digunakan');
        // } else {
        //     auth()->user()->update([
        //         'last_session' => session()->getId()
        //     ]);
            Alert::success('Informasi Pesan', 'Selamat datang ' . auth()->user()->name);
        // }
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
    
        throw ValidationException::withMessages([
            'throttle' => [Lang::get('auth.throttle', ['seconds' => $seconds])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    public function username()
    {
        return 'nrp';
    }

    public function logout()
    {
        // auth()->user()->update([
        //     'last_session' => null
        // ]);
        $this->guard()->logout();
        Alert::success('Informasi Pesan', 'Logout Berhasil');
        return redirect()->route('login');
    }
}
