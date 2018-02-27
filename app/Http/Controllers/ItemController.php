<?php

namespace App\Http\Controllers;
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

    public function addCategory(Request $request){
        $category = new Category();
        $category->cat_name = $request['title'];
        $category->rest_id = $request['rest_id'];
        
        $category->save();

        return redirect('/addcategory')->with('status', 'New Category Added !');
    }

}
