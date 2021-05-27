<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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

    
    public function authenticate(Request $request)
    {
    
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            ]);
        }
        
    public function authenticate2(Request $request)
    {

        $user=User::where('email','=',$request->get('email'))->where('id_empresa','=',$request->get('id_empresa'))->first();
        $myVariable =Auth::login($user,true);

        return redirect()->intended('/home');

    }


    public function authenticate3($request)
    {
        // dd($request->only('email', 'password','id_empresa'));
    
        $credentials = $request->only('email', 'password','id_empresa');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            ]);
        }
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
}
