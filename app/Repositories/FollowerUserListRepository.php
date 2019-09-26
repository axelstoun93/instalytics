<?php
namespace App\Repositories;

use App\FollowerUserList;
use App\FollowList;
use App\Repositories\Assistant\DataAssistant;
use App\Statistic;
use App\UnFollowList;

class FollowerUserListRepository extends Repository
{
    function __construct(FollowerUserList $followUserList)
    {
        $this->model = $followUserList;
    }


    function insert($data){

        if(is_array($data) and !empty($data)){
            if(count($data) > 1000){
                $explodeArray = array_chunk($data, 1000);

                $status = true;

                foreach ($explodeArray as $value){
                    $res = $this->model->insert($value);
                    if(!$res){
                        $status = false;
                        break;
                    }
                }

                return $status;
            }else{
                $res = $this->model->insert($data);
                if($res){
                    return true;
                }
                return false;
            }
        }


        //Если все плохо возвращяем пустой ответ
        return false;

    }


    //Получаем данные сравниваем заполняем
    public function getDataFollowUnFollow($instagramID,$nowFollower){

        $backDay = DataAssistant::backDay();
        $oldBackDay = DataAssistant::oldBackDay();

        $oldBackDayData = $this->model->select('login','follower_instagram_id')->where('date','=',$oldBackDay)->where('instagram_id','=',$instagramID)->pluck('login','follower_instagram_id')->toArray();
        $backDayData = $this->model->select('login','follower_instagram_id')->where('date','=',$backDay)->where('instagram_id','=',$instagramID)->pluck('login','follower_instagram_id')->toArray();

        if(!empty($oldBackDayData) and count($oldBackDayData) >= 1){

            $follow = array_diff_key($backDayData, $oldBackDayData);

            $unFollow = array_diff_key($oldBackDayData, $backDayData);

            $countFollow = count($follow);

            $countUnFollow = count($unFollow);

            $statistics = new StatisticRepository(new Statistic());

            $statistics->updateFollowUnFollow($instagramID,$countFollow,$countUnFollow,$nowFollower);

            $followList = new FollowListRepository(new FollowList());

            //Формируем масив для записи в базу данных
            $readyFollow = [];

            foreach ($follow as $key => $v){
                $readyFollow[$key]['instagram_id'] = $instagramID;
                $readyFollow[$key]['login'] = $v;
                $readyFollow[$key]['date'] = $backDay;
            }

            $followList->insert($readyFollow);

            $unFollowList = new UnFollowListRepository(new UnFollowList());

            //Формируем масив для записи в базу данных
            $readyUnFollow = [];
            foreach ($unFollow as $key => $v){
                $readyUnFollow[$key]['instagram_id'] = $instagramID;
                $readyUnFollow[$key]['login'] = $v;
                $readyUnFollow[$key]['date'] = $backDay;
            }

            $unFollowList->insert($readyUnFollow);

        }


        return false;

    }

    //Удаляем записи за предыдущие дни
    public function deleteBackDate($day){
        $res = $this->model->where('date','<=',$day)->take(500000)->delete();
        if($res){
            return true;
        }else{
            return false;
        }
    }

}
