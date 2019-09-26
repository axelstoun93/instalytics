<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowerUserList extends Model
{
    protected $table = 'follower_user_list';
    protected $fillable = [
        'id','instagram_id','login','follower_instagram_id','follower','following','date'
    ];
}
