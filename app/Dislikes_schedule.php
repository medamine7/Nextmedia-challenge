<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Dislikes_schedule extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'dislikes_schedules';


    protected $fillable = [
        'user_id','shop_id'
    ];

}
