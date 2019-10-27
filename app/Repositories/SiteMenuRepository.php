<?php
namespace App\Repositories;

use App\SiteMenu;

class SiteMenuRepository extends Repository
{
    function __construct(SiteMenu $menu)
    {
        $this->model = $menu;
    }
}
