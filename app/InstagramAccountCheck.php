<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccountCheck extends Model
{
    protected $table = 'instagram_account_check';

    public $timestamps = false;

    protected $fillable = [
        'id','instagram_id','humans','mass_following_humans','bots','followers','status','next_max_id','rank_token','check_all_page','date'
    ];
}
