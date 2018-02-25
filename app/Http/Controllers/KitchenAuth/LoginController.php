<?php

namespace App\Http\Controllers\KitchenAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
    public $redirectTo = '/kitchen/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('kitchen.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('kitchen.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('kitchen');
    }


    // Checking login by override
    public function login(Request $request)
    {   
//         dd($request);

        $this->validate($request, [
            'kCode' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('kCode', 'password');

        // if ($this->auth->guard('waiters')->attempt($credentials))
        if(Auth::guard('kitchen')->attempt( ['kCode' => $request->kCode, 'password' => $request->password] ))
        {

            return redirect()->intended($this->redirectPath());
//            return redirect(route('makeorder'));
        }

        return redirect(route('klogin'))
                    ->withInput($request->only('kCode'))
                    ->withErrors([
                        // 'kCode' => $this->getFailedLoginMessage(),
                        'kCode' => "Problem with kCode or password !!",
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
        Auth::guard('kitchen')->logout();

        return redirect('/kitchen/login');
    }

}
