<?php

namespace App\Http\Controllers;
use App\Waiter;
use App\Kitchen;
use App\Customer;
use App\FoodOrder;
use App\FoodOrderItem;
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

    public function placeOrder(Request $request){
        $items = json_decode($request['order_list']);

//        dd($request['order_list']);
        //dd($request);
        $customer = new Customer();
        $customer->name = $request['cust_name'];
        $customer->phone = $request['cust_phone'];
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
