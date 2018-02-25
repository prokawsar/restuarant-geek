<?php

namespace App\Http\Controllers;
use App\Waiter;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.home');
    }

    public function getUCode()
    {
        return view('owner.ucode');
    }

    public function setUCode(Request $request)
    {
        $waiter = new Waiter();
        $waiter->wCode = $request['wCode'];
        $waiter->password = bcrypt($request['password']);
        $waiter->rest_id = $request['rest_id'];
        $waiter->save();

        return redirect('/ucode')->with('alert', 'Unique Code Updated !');
    }
}
