<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowList extends Model
{
    protected $table = 'follow_list';

    public $timestamps = false;

    protected $fillable = [
        'id','instagram_id','login','date'
    ];
}
