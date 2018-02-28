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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::where('id', $id)
                        ->first();
        // dd($item);
        return view('item.edit', compact('item', 'id'));
    }

    public function deleteItem($id){

        $item = Item::where('id', $id)->delete();
        
        return redirect('/allitem')->with('danger', 'Item Deleted !');
    }

    public function updateItem(Request $request){
        $item = new Item();
        $item = $item->find($request['id']);
        $item->item_name = $request['name'];
        $item->price = $request['price'];
        if($request['image']){
            $item->image = $request['image'];
        }
        $item->rest_id = $request['rest_id'];
        $item->cat_id = $request['cat_id'];

        $item->save();

        return redirect('/allitem')->with('status', 'Item Updated Successfully !');
    }
}
