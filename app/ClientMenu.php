<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientMenu extends Model
{
    protected $table = 'client_menu';
    protected $fillable = [
        'name','class','url','order','parent_id'
    ];
}
