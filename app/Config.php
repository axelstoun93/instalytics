<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    public $timestamps = false;

    protected $fillable = [
        'id','name','value','class'
    ];
}
