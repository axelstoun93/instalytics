<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\SiteMenuRepository;

use Menu;

abstract class SiteController extends Controller
{
    protected $vars;
    protected $template;
    protected $site_menu_rep;
    protected $title;
    protected $keywords;
    protected $description;

    function __construct(SiteMenuRepository $menu){
        $this->site_menu_rep = $menu;
    }

    public function renderOutput()
    {
        //page-description
        $this->vars = array_add($this->vars,'title',$this->title);
        $this->vars = array_add($this->vars,'keywords',$this->keywords);
        $this->vars = array_add($this->vars,'description',$this->description);
        $menu = $this->getMenu();
        $footer = view('layouts.'.config('setting.theme').'.footer')->with('menu',$menu)->render();
        $navigation = view('layouts.'.config('setting.theme').'.menu')->with('menu',$menu)->render();
        $this->vars = array_add($this->vars,'menu',$navigation);
        $this->vars = array_add($this->vars,'footer', $footer);
        return view(config('setting.theme').'.'.$this->template)->with($this->vars);
    }


    public function getMenu()
    {
        $menu = $this->site_menu_rep->all();

        $mBuilder = Menu::make('menu', function($m) use ($menu) {
            foreach($menu as $item) {
                if($item->parent_id == 0) {
                    if(empty($item->url) or $item->url == '#')
                    {
                        $m->add($item->name,['url'  =>   $item->url ,  'class' => $item->class, 'id' => $item->id])->data('order', $item->order)->link->href('#');
                    }
                    else
                    {
                        $m->add($item->name,['url'  =>   $item->url ,  'class' =>  $item->class, 'id' => $item->id])->data('order', $item->order);
                    }
                }
                else {
                    if($m->find($item->parent_id)) {
                        $m->find($item->parent_id)->add($item->name,['url'  => $item->url,  'class' => $item->class, 'id' => $item->id])->data('order', $item->order);
                    }
                }
            }
        })->sortBy('order');
        return $mBuilder;
}
}
