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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $review = Review::with('customer')->where('rest_id', Auth::user()->id)->get();
//dd($review);

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
        if ($request['image']) {

            $photoName = time() . '.' . $request['image']->getClientOriginalExtension();

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

    public function editForm(Request $request)
    {
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
        $foodOrder->bill_paid = true;
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


    public function checkWcode(Request $request)
    {
        $waiter = Waiter::where('wCode', $request->wCode)->get();
        // return $kitchen;

        if($request->ajax())
        {
            if(isset($waiter[0])){
                return response()->json(array("exists" => true));
            }else{
                return response()->json(array("exists" => false));
            }
        }

    }


    public function checkKcode(Request $request)
    {
        $kitchen = Kitchen::where('kCode', $request->kCode)->get();
       // return $kitchen;

        if($request->ajax())
        {
            if(isset($kitchen[0])){
                return response()->json(array("exists" => true));
            }else{
                return response()->json(array("exists" => false));
            }
        }

    }


    public function orderDataDate(Request $request)
    {
        if ($request['start'] == $request['end']) {
            $foodOrder = FoodOrder::with('item', 'customer')->where(DB::raw('DATE(order_date)'),
                $request['start'])->where('rest_id', Auth::user()->id)->get();

        } else {
            // $start = FoodOrder::select('order_date')->where(DB::raw('DATE(order_date)'),
            //     $request['start'])->first();
            // $end = FoodOrder::select('order_date')->where(DB::raw('DATE(order_date)'), $request['end'])->first();

            if ($request->ajax()) {
                //   $foodOrder = FoodOrder::where( DB::raw('DATE(order_date)'), $request['start'])->where('rest_id', Auth::user()->id)->get();
                $foodOrder = FoodOrder::with('item', 'customer')->whereBetween('order_date',
                    array($request['start'], $request['end']))->where('rest_id', Auth::user()->id)->get();

            }
        }
        return $foodOrder;

    }

    public function emailCamp(Request $request)
    {
        $total = count($request['name']);
        $data = array(
            'name' => array( $request['name'] ),
            'email' => array($request['email'] )
        );

    //    Mail::send('campemail', $data, function ($message) use ($data){
    //         $message->to($data['email'])
    //                 ->subject('Hello system');
    //    });

       return redirect('/emailcamp')->with('status', 'Email Sent Successfully to '.$total. ' User.');
    }

    public function smsCamp(Request $request)
    {
        $total = count($request['phone']);
        return redirect('/sms')->with('status', 'SMS Sent to '. $total .' User Successfully!');
    }
}
