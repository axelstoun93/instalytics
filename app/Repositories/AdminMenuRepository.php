<?php
namespace App\Repositories;

use App\AdminMenu;

class AdminMenuRepository extends Repository
{
    function __construct(AdminMenu $menu)
    {
        $this->model = $menu;
    }
}