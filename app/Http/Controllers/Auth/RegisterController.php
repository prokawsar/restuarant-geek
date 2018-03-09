<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\Verify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'owner-name' => 'required|string|max:255',
            'rest-name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'g-recaptcha-response' => 'required|captcha',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'owner_name' => $data['owner-name'],
            'rest_name' => $data['rest-name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email'])
        ]);

        Mail::to($user->email)->send(new Verify($user));

        return $user;

    }

    /**
     * Override default register method from RegistersUsers trait
     *
     * @param array $request
     * @return redirect to $redirectTo
     */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        $this->create($request->all());
        return redirect('/register')->with('status', 'We have sent an activation link on your email id. Please verify your account.');

    }

    public function verify($token)
    {
        $user = User::where('email_token', $token)->first();
        if(!$user->verified) {
            $user->verified = 1;
            $user->save();
            $status = "Your e-mail is verified. You can now login.";
        }else{
            $status = "Your e-mail is already verified. You can now login.";
        }

        return redirect('/login')->with('status', $status);

    }

}
