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
    public function getNearbyShops()
    {

        $user= Auth::user();
        $user_id= Auth::id();


        //get ids of shops the user liked
        $liked= $user->_liked ?: [];
        //get ids of shops the user disliked
        $disliked= $user->_disliked ?: [];


        //get shops sorted by distance and then filter shops and get only the ones the user hasn't liked nor disliked
        /***
            HAD TO GO WITH THIS SINCE MongoDB DOESN'T USE A PIVOT TABLE FOR MANY TO MANY RELATIONSHIPS UNLIKE MySQL 
        ***/

        $shops = Shop::where('location', 'near', [              
            '$geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $user->location["coordinates"][1],
                    $user->location["coordinates"][0],
                ],
            ]
        ])
        ->whereNotIn('_id', array_merge($liked,$disliked))
        ->get();


        return response()->json(["shops"=>$shops],200);
    }


    public function getPreferredShops(){
        $user=Auth::user();

        $shops= $user->liked;

        return response()->json(["shops"=>$shops],200);
    }


    public function likeShop($shop_id){
        $user=Auth::user();

        //retrieve data the users has liked and add the new shop to them
        $user->liked()
        ->attach($shop_id);

        return response('liked', 200);    
    }


    public function dislikeShop($shop_id){
        $user=Auth::user();

        $user->disliked()
        ->attach($shop_id);

        return response('disliked', 200);

    }


    public function unlikeShop($shop_id){
        $user=Auth::user();

        //retrieve data the users has liked and remove the specified shop out
        $user->liked()
        ->detach($shop_id);

        return response('unliked', 200);
    }
}
