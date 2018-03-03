<?php

namespace App\Http\Controllers;
use App\Waiter;
use App\Kitchen;
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

    public function setCode()
    {
        return view('owner.kitchenucode');
    }

    public function showOrder()
    {
        return view('owner.orders');
    }

    public function viewKitchen()
    {
        return view('owner.kitchen');
    }

    public function viewReview()
    {
        return view('owner.allreview');
    }

    public function viewCustomer()
    {
        return view('owner.customer');
    }

    public function smsCampaign()
    {
        return view('owner.sms');
    }

    public function setUCode(Request $request)
    {
        // $waiter = new Waiter();
        $waiter = Waiter::firstOrNew(array('rest_id' => $request['rest_id']));
        $waiter->wCode = $request['wCode'];
        $waiter->password = ($request['password']);
        // $waiter->rest_id = $request['rest_id'];
        $waiter->save();

        return redirect('/ucode')->with('alert', 'Unique Code Updated !');
    }

    public function setKitchenCode(Request $request)
    {
        // $waiter = new Waiter();
        $kitchen = Kitchen::firstOrNew(array('rest_id' => $request['rest_id']));
        $kitchen->kCode = $request['kCode'];
        $kitchen->password = ($request['password']);
        // $waiter->rest_id = $request['rest_id'];
        $kitchen->save();

        return redirect('/kitchen/ucode')->with('alert', 'Unique Code Updated !');
    }
}
