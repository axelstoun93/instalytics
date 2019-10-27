<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccountFollowerCheck extends Model
{

    protected $table = 'instagram_account_followers_check';

    public $timestamps = false;

    protected $fillable = [
        'id','instagram_id','login','follower_instagram_id','check','status'
    ];

}
