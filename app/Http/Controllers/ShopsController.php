<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\Auth;


class ShopsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShops()
    {
        $user= Auth::user();

        $shops = Shop::take(8)
        ->get();

        return view('nearbyShops',compact('shops'));
    }


    public function getPreferredShops(){
        $user=Auth::user();

        $shops= $user->_shops;

        dd($shops);
    }


    public function likeShop($shop_id){
        $user=Auth::user();

        $user->shops()
        ->attach([$shop_id, 'action'=>'liked']);

        return response('liked', 200);    
    }


    public function dislikeShop($shop_id){
        $user=Auth::user();

        $user->shops()
        ->attach([$shop_id, 'action'=>'disliked']);

        return response('disliked', 200);

    }
}
