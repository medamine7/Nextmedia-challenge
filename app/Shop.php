<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Shop extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'shops';



    public function hasLiked(){
        return $this->belongsToMany('App\User',null, '_liked', '_hasLiked');
    }

    public function hesDisliked(){
        return $this->belongsToMany('App\User',null, '_disliked', '_hasDisliked');
    }
}
