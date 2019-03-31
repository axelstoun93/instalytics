<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarTask extends Model
{
    protected $table = 'calendar_task';

    protected $fillable = [
        'id','instagram_id','login'
    ];
}
