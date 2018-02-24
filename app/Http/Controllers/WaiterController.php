<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = "All Items";
        return view('makeorder', compact('data'));
    }
}
