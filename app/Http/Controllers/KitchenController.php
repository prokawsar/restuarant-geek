<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('kitchen');
    }

    public function index()
    {
        $data = "All Items";
        return view('kitchen', compact('data'));
    }
}
