<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistic';

    public $timestamps = false;

    protected $fillable = [
        'id','instagram_id','follower','following','media_count','date'
    ];

}
