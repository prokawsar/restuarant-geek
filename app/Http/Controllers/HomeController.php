<?php

namespace App\Http\Controllers;
use App\Customer;
use App\FoodOrder;
use App\Review;
use App\User;
use App\Waiter;
use App\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $review = Review::with('customer')->where('rest_id',Auth::user()->id)->get();

        return view('owner.allreview')->with('reviews', $review);
    }

    public function viewCustomer()
    {
        return view('owner.customer');
    }

    public function profile()
    {
        $ProfileData = User::where('id', Auth::id())->get();
//        dd($ProfileData);
        return view('owner.profile')->with('data', $ProfileData);
    }

    public function updateProfile(Request $request)
    {
        $profileData = User::find(Auth::id());
//        dd($ProfileData);
        $profileData->owner_name = $request['name'];
        if($request['image']) {

            $photoName = time().'.'.$request['image']->getClientOriginalExtension();

            /*
            talk the select file and move it public directory and make avatars
            folder if doesn't exsit then give it that unique name.
            */
            $request['image']->move(public_path('restaurant'), $photoName);

            $profileData->image = $photoName;
        }

        $profileData->address = $request['address'];
        $profileData->phone = $request['phone'];
        $profileData->closing_day = $request['closing_day'];

        $profileData->save();

        return redirect('/profile')->with('status', 'Profile Updated Successfully.');
    }

    public function editForm(Request $request){
        $data = User::find($request['id']);
        //dd($data);
        return view('owner.profileEdit')->with('data', $data);
    }
    public function smsCampaign()
    {
        return view('owner.sms');
    }

    public function emailCampaign()
    {
        return view('owner.emailcamp');
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

    public function billPaid($id)
    {
        $foodOrder = FoodOrder::find($id);
        $foodOrder->bill_paid = true ;
        $foodOrder->save();

        return redirect('/allorder')->with('alert', 'Bill Paid for a Order!');
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
