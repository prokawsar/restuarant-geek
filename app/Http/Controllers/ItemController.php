<?php

namespace App\Http\Controllers;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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

    public function addItem(Request $request){
        $item = new Item();
        $item->item_name = $request['name'];
        $item->price = $request['price'];
        if($request['image']){
            $item->image = $request['image'];
        }
        $item->rest_id = $request['rest_id'];
        $item->cat_id = $request['cat_id'];
        
        $item->save();

        return redirect('/additem')->with('status', 'New Item Added !');
    }

}
