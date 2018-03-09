<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Checking login by override
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // if(Auth::guard('waiter')->attempt( ['wCode' => $request->wCode, 'password' => $request->password] ))

         if( Auth::attempt( ['email' => $request->email, 'password' => $request->password, 'verified' => 1] ))
        {

            Auth::login(Auth::user(), true);

            return redirect()->intended($this->redirectPath());
//            return redirect(route('home'));
        }

         return $this->sendFailedLoginResponse($request);

//        return redirect(route('login'))
//            ->withInput($request->only('email'))
//            ->withErrors([
//                $this->sendFailedLoginResponse($request)
////                'email' => 'Your account is inactive yet. Please confirm your e-mail address.',
//            ]);
    }

    /* Method override to send correct error messages
    * Get the failed login response instance.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    protected function sendFailedLoginResponse(Request $request)
    {

        if ( ! User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($request->email, 'remember'))
                ->withErrors([
                    'email' => Lang::get('auth.failed'),
                ]);
        }

        if ( ! User::where('email', $request->email)->where('password', bcrypt($request->password))->where('verified', 1)->first() ) {
            return redirect()->back()
                ->withInput($request->only($request->email, 'remember'))
                ->withErrors([
                    'email' => Lang::get('auth.failed_status'),
                ]);
        }

        if ( ! User::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($request->email, 'remember'))
                ->withErrors([
                    'password' => Lang::get('auth.password'),
                ]);
        }



    }

}
