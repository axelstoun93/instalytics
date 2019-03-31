<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    protected $table = 'admin_menu';
    protected $fillable = [
        'name','class','url','order','parent_id'
    ];
}
