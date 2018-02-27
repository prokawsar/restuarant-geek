<?php

namespace App\Http\Controllers;
use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
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

    public function addTable(Request $request){
        $Table = new Table();
        $Table->name_or_no = $request['table_title'];
        $Table->rest_id = $request['rest_id'];
        
        $Table->save();

        return redirect('/addtable')->with('status', 'New Table Added !');
    }

}
