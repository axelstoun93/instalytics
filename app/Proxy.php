<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $table = 'proxy';
    protected $fillable = [
        'id','name','password','ip','port','status'
    ];
}
