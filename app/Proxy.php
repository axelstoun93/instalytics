<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $table = 'proxy';
    protected $fillable = [
        'id','name','password','ip','port','status'
    ];

    public function donors(){
        return $this->hasMany('App\InstagramDonor','proxy_id','id');
    }
}
