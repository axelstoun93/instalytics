<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnFollowList extends Model
{
    protected $table = 'unfollow_list';

    public $timestamps = false;

    protected $fillable = [
        'id','instagram_id','login','date'
    ];
}
