<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pay';
    protected $fillable = [
        'id','user_id','amount','description','status','check','date'
    ];

}
