<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Shop;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'location','password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'users';


    public function liked(){
        return $this->belongsToMany('App\Shop',null, '_hasLiked', '_liked');

    }


    public function disliked(){
        return $this->belongsToMany('App\Shop',null, '_hasDisliked', '_disliked');

    }


    // public function indifferent(){
    //     return App\Shop::doesntHave('hasLiked', function ($query) {
    //         $query->where('id', '!=', auth()->user()->id)
    //     })
    //     ->doesntHave('hasDisliked')->get() 
    // }

}
