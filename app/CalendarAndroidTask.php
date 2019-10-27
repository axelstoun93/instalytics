<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarAndroidTask extends Model
{
    protected $table = 'calendar_android_task';

    protected $fillable = [
        'id','instagram_id','login','rank_token','next_max_id'
    ];
}
