<?php
namespace App\Repositories;

use App\ClientMenu;

class ClientMenuRepository extends Repository
{
    function __construct(ClientMenu $menu)
    {
        $this->model = $menu;
    }
}