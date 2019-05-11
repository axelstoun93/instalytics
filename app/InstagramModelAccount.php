<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramModelAccount extends Model
{
    protected $table = 'instagram_account';

    protected $fillable = [
        'id','user_id','instagram_id','avatar','name','login','old_login','follower','following','media_count','bots','status','promotion','category_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
