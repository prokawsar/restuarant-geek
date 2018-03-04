<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\FoodOrder;
use App\FoodOrderItem;
class WaiterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('waiter');
    }

    public function index()
    {
        return view('waiter.home');
    }

    public function takeReview()
    {
        return view('waiter.takereview');
    }

    public function placedOrder()
    {
        return view('waiter.placedorder');
    }

    public function placeOrder(Request $request){
        $items = json_decode($request['order_list']);

//        dd($request['order_list']);
        //dd($request);
        $customer = new Customer();
        $customer->name = $request['cust_name'];
        if(isset($request['cust_phone'])){
            $customer->phone = $request['cust_phone'];
        }
        if(isset($request['cust_email'])){
            $customer->email = $request['cust_email'];
        }
        $customer->rest_id= $request['rest_id'];
        $customer->save();

        $cust_id = Customer::select('id')->orderBy('created_at', 'desc')->first();

        $foodOrder = new FoodOrder();
        $foodOrder->total_bill = 10;
        $foodOrder->status = 0;
        $foodOrder->cust_id = $cust_id['id'];
        $foodOrder->table_id = $request['table_id'];
        $foodOrder->rest_id = $request['rest_id'];
        $foodOrder->save();

        $order_id = FoodOrder::select('id')->orderBy('order_date', 'desc')->first();
//        $orderItem = new FoodOrderItem();

        foreach ($items as $item){
            $orderItem = new FoodOrderItem();
            $orderItem->order_id = $order_id['id'];
            $orderItem->item_id = $item->item_id;
            $orderItem->save();
        }

        return redirect('/waiter/makeorder')->with('status', 'Order Place Successfully!');
    }

}
