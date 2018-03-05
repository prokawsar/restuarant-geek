<?php

namespace App\Http\Controllers;
use App\FoodOrder;
use App\FoodOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('kitchen');
    }

    public function index()
    {

//        dd(FoodOrder::with('item','table')->get());

        return view('kitchen.home');
    }

    public  function orderData(Request $request)
    {
        if($request->ajax())
        {
//            $foodOrder = FoodOrder::where('rest_id', Auth::guard('kitchen')->user()->rest_id)->whereDate('order_date',DB::raw('CURDATE()'))->orderBy('status')->get();
//            $foodOrder = FoodOrder::with('item','table')->where('rest_id', Auth::guard('kitchen')->user()->rest_id)->whereDate('order_date',DB::raw('CURDATE()'))->orderBy('status')->get();
            $foodOrder = FoodOrder::with('item','table')->where('rest_id', Auth::guard('kitchen')->user()->rest_id)->whereDate('order_date',DB::raw('CURDATE()'))->orderBy('status')->get();
            return $foodOrder;
        }
    }


    public function OrderDone($id){
        FoodOrder::where('id', $id)->update(array('status' => 1));
        return redirect('/kitchen/home')->with('status', 'Order no '.$id.' Done !');
    }
}
