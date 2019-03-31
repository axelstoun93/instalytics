<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id','name','created_at','updated_at'
    ];

    public function users() {
        return $this->belongsToMany('App\User','role_user');
    }

}
