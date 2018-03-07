<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Customer;
use App\FoodOrder;
use App\FoodOrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if(isset($request['order_id'])){
            $foodOrder = FoodOrder::find($request['order_id']);
            $bill = 0;

            foreach ($items as $item){
                $orderItem = new FoodOrderItem();
                $orderItem->order_id = $request['order_id'];
                $orderItem->item_id = $item->item_id;
                $orderItem->item_quantity = $item->item_quantity;

                $bill += $item->item_price * $item->item_quantity;
                $orderItem->save();
            }
            $currentBill = $foodOrder->total_bill;
            $foodOrder->total_bill = $currentBill + $bill;
            $foodOrder->status = 0;
            $foodOrder->save();

            return redirect('/waiter/placedorder')->with('status', 'Item Added Successfully!');
        }
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
        $foodOrder->total_bill = 0;
        $foodOrder->status = 0;
        $foodOrder->cust_id = $cust_id['id'];
        $foodOrder->table_id = $request['table_id'];
        $foodOrder->rest_id = $request['rest_id'];
        $foodOrder->save();

        $order_id = FoodOrder::select('id')->orderBy('order_date', 'desc')->first();
//        $orderItem = new FoodOrderItem();
        $bill = 0;

        foreach ($items as $item){
            $orderItem = new FoodOrderItem();
            $orderItem->order_id = $order_id['id'];
            $orderItem->item_id = $item->item_id;
            $orderItem->item_quantity = $item->item_quantity;

            $bill += $item->item_price * $item->item_quantity;
            $orderItem->save();
        }
        $foodOrder = FoodOrder::find($order_id['id']);
        $foodOrder->total_bill = $bill;
        $foodOrder->save();

        return redirect('/waiter/makeorder')->with('status', 'Order Place Successfully!');
    }

    public function checkEmail(Request $request){
        if( isset($request['email']) ){
            $email = $request->input('email');
            $isExists = Customer::where('email',$email)->first();
        }else{
            $phone = $request->input('phone');
            $isExists = Customer::where('phone',$phone)->first();
        }

        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    public function getNotification(Request $request)
    {
        if($request->ajax()) {
//            $foodOrder = FoodOrder::where('rest_id', Auth::guard('kitchen')->user()->rest_id)->whereDate('order_date',DB::raw('CURDATE()'))->orderBy('status')->get();
            $completeOrder = FoodOrder::with('table')->where('rest_id', Auth::guard('waiter')->user()->rest_id)->where('status', 1)->whereDate('order_date',DB::raw('CURDATE()'))->get();
          
            return $completeOrder;
        }
    }

    public function addMoreItem($id)
    {

        return view('waiter.moreitem')->with('id', $id);
    }

    public function saveReview(Request $request)
    {
        if(! isset($request['email'])){
            return redirect('/waiter/takereview')->with('warning', 'Please give customer email!');

        }

        $review = new Review();

        $cust_id = Customer::select('id')->where('email', $request['email'])->get();

        if( !isset($cust_id[0]->id) ){
            return redirect('/waiter/takereview')->with('warning', 'Customer email not found!');

        }

        $review->review = $request['review'];
        $review->discount_amount = $request['discount'];
        $review->order_id = $request['order_id'];
        $review->cust_id= $cust_id[0]->id;
        $review->rest_id = $request['rest_id'];
        $review->rating = $request['rating'];
        $review->save();

        return redirect('/waiter/takereview')->with('status', 'Review Taken Successfully!');
    }

}
