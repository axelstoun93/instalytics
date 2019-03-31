<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccountCategory extends Model
{
    protected $table = 'instagram_account_category';

    protected $fillable = [
        'id','name'
    ];
}
