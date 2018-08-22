<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shops=Shop::take(8)
        ->get();

        return view('home',compact('shops'));
    }
}
