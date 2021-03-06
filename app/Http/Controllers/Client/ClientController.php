<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ClientMenuRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\User;
use Menu;

abstract class ClientController extends Controller
{
    protected $vars;
    protected $template;
    protected $m_rep;
    protected $u_rep;

    public function __construct(ClientMenuRepository $menu)
    {
        $this->m_rep = $menu;
        $this->u_rep = new UserRepository(new User);
    }

    public function renderOutput()
    {

        $menu = $this->getMenu();
        $userInfo = $this->u_rep->clientInfo(Auth::id());

        $navigation = view('layouts.'.config('setting.theme-client').'.navigation')->with('userInfo',$userInfo)->render();
        $this->vars = array_add($this->vars,'navigation',$navigation);

        $leftMenu = view('layouts.'.config('setting.theme-client').'.leftMenuBar')->with('menu',$menu)->render();
        $this->vars = array_add($this->vars,'leftMenu', $leftMenu);

        return view(config('setting.theme-client').'.'.$this->template)->with($this->vars);

    }

    public function getMenu()
    {
        $menu = $this->m_rep->all();
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


    public function getUserInfo(){

    }


}