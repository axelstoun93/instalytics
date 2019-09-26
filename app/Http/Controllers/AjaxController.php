<?php
namespace App\Http\Controllers;


use App\Repositories\FollowListRepository;
use App\Repositories\UnFollowListRepository;
use App\UnFollowList;
use App\FollowList;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    protected $follow_rep;
    protected $unfollow_rep;
    protected $user_rep;

    public function __construct(){
        $this->follow_rep = new FollowListRepository(new FollowList());
        $this->unfollow_rep = new UnFollowListRepository(new UnFollowList());
        $this->user_rep = new UserRepository(new User);
    }


    public function getFollowUnfollowAccount(Request $request,$id){
        if($request->isMethod('post')) {
            $date = $request->date;
            echo $this->getFollowUnfollowHtml($id,$date);
        }

    }

    function getFollowUnfollowHtml($id,$date){
        $id = (int)$id;
        $client = $this->user_rep->getInstagramId($id);
        $instagramId = $client->account->instagram_id;
        $follow = $this->follow_rep->getFollowListDay($instagramId, $date);
        $unfollow = $this->unfollow_rep->getUnfollowListDay($instagramId, $date);
        $views = view(config('setting.ajax') . '.followUnfollowList')->with(['follow' => $follow, 'unfollow' => $unfollow])->render();
        return $views;
    }


}
