<?php

namespace App\Http\Controllers;
use App\FoodOrder;
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

    public function show(){

        return view('table.allTable');
    }
    
    public function addTableForm(){

        return view('table.addTable');
    }

    public function addTable(Request $request){
        $Table = new Table();
        $Table->name_or_no = $request['table_title'];
        $Table->rest_id = $request['rest_id'];
        
        $Table->save();

        return redirect('/addtable')->with('status', 'New Table Added !');
    }

    public function deleteTable($id){

        $table = FoodOrder::where('table_id', $id)->get();
        // dd($item);

        if(!$table->isEmpty()){
            return redirect('/alltable')->with('warning', 'You can not delete this table, its already in use !');
        }
        Table::where('id', $id)->delete();

        return redirect('/alltable')->with('danger', 'Table Deleted !');
    }

}
