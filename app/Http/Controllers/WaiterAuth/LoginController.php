<?php

namespace App\Http\Controllers\WaiterAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hesto\MultiAuth\Traits\LogsoutGuard;


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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/waiter/makeorder';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('waiter.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('waiter.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('waiter');
    }

    // Checking login by override
    public function login(Request $request)
    {   
        // dd($request);

        $this->validate($request, [
            'uCode' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('uCode', 'password');

        // if ($this->auth->guard('waiters')->attempt($credentials))
        if(Auth::guard('waiter')->attempt( ['uCode' => $request->uCode, 'password' => $request->password] ))
        {   
            // return view('waiter.home');
            return redirect()->intended($this->redirectPath());
        }

        return redirect(route('wlogin'))
                    ->withInput($request->only('uCode'))
                    ->withErrors([
                        // 'uCode' => $this->getFailedLoginMessage(),
                        'uCode' => "Problem with uCode or password !!",
                    ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // $this->guard()->logout();
        //auth('waiter')->logout();
        Auth::guard('waiter')->logout();

        return redirect('/waiter/login');
    }

}
