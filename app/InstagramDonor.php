<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramDonor extends Model
{
    protected $table = 'instagram_donor';
    protected $fillable = [
        'id','name','password','proxy_id','status'
    ];

    public function proxy(){
        return $this->hasOne('App\Proxy','id','proxy_id');
    }
}
