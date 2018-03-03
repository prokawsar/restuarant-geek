<?php

namespace App\Http\Controllers;
use App\Item;
use App\Category;
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

    public function show()
    {
        return view('item.allitem');
    }

    public function addFormShow(){

        return view('item.add');

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

    public function setCategory()
    {
        return view('item.addcate');
    }

    public function addCategory(Request $request){
                $category = new Category();
                $category->cat_name = $request['title'];
                $category->rest_id = $request['rest_id'];
                
                $category->save();
        
                return redirect('/addcategory')->with('status', 'New Category Added !');
            }
}
