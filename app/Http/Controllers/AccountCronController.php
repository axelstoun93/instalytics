<?php
namespace App\Http\Controllers;

use App\InstagramAccountCheck;
use App\InstagramAccountFollowerCheck;
use App\InstagramDonor;
use App\CalendarTask;
use App\CalendarAndroidTask;
use App\Repositories\CalendarTaskRepository;
use App\Repositories\CalendarAndroidTaskRepository;
use App\Repositories\Assistant\DataAssistant;
use App\Repositories\InstagramDonorRepository;
use App\Repositories\InstagramAccountCheckRepository;
use App\Repositories\InstagramAccountFollowerCheckRepository;
use App\Repositories\Api\InstagramAndroidApi;

class AccountCronController extends Controller
{

    protected $account_rep;
    protected $account_follower_rep;
    protected $donor_rep;
    protected $task_android_rep;
    protected $task_rep;


    public function __construct(){

        $this->account_rep = new InstagramAccountCheckRepository(new InstagramAccountCheck());
        $this->account_follower_rep = new InstagramAccountFollowerCheckRepository(new InstagramAccountFollowerCheck());
        $this->donor_rep = new InstagramDonorRepository(new InstagramDonor());
        $this->task_rep = new CalendarTaskRepository(new CalendarTask());
        $this->task_android_rep = new CalendarAndroidTaskRepository(new CalendarAndroidTask());

    }


    //Метод проверяет очередь на проверку аккаунта
    public function init(){

        //Проверяем если есть задачи по получениям данных то ничего не делаем

        $androidList =  $this->task_rep->isEmpty();
        $taskList =  $this->task_android_rep->isEmpty();

        if(!$androidList or !$taskList){
            return false;
        }

        $donor = $this->donor_rep->getFirstValidateDonor();

        $androidAPI = new InstagramAndroidApi($donor);

        $checkAccount = $this->account_rep->getFirstAccount();

        $nextMaxIdDb = $checkAccount->next_max_id;
        $rankTokenDb = $checkAccount->rank_token;


        // Проверяем что не пусто и есть с чем работать
        if(!empty($checkAccount)){

            $instagramId = $checkAccount->instagram_id;


            // проверяем всех ли подписчиков получили по последнему аккаунту который сейчас на проверке
            // Если не всех до дополучаем список
            if(!$checkAccount->check_all_page){
                $followers = $androidAPI->getPageFollowers($instagramId,$nextMaxIdDb,$rankTokenDb);

                //Готовим новый лист по которому будим получать данные
                $readyListArray = [];

                foreach ($followers as $key => $item){
                    $readyListArray[$key]['login'] = $item->getUsername();
                    $readyListArray[$key]['instagram_id'] = $instagramId;
                    $readyListArray[$key]['follower_instagram_id'] = $item->getPk();
                    $readyListArray[$key]['check'] = 0;
                    $readyListArray[$key]['status'] = 0;
                }

                $nextMaxId = $androidAPI->getNexMaxId();
                $rankToken = $androidAPI->getRankToken();

                if($nextMaxId){
                    $this->account_rep->update($checkAccount->id,['check_all_page' => 0,'next_max_id' => $nextMaxId,'rank_token' => $rankToken]);
                }else{
                    $this->account_rep->update($checkAccount->id,['check_all_page' => 1,'next_max_id' => 0,'rank_token' => 0]);
                }

                $this->account_follower_rep->insert($readyListArray);

            }



            //Если лист пустой формируем новый
            $FollowersBotsList = $this->account_follower_rep->isEmpty();

            if($FollowersBotsList){

                //Проверяем количество подписчиков
                $countFollowers = $androidAPI->getCountFollowers($instagramId);

                //Если подписчиков больше 100 000 мы не будем анализировать аккаунт удаляем его из таблицы
                if($countFollowers >= 100000){
                    $this->account_rep->delete($instagramId);
                }else{

                    $followers = $androidAPI->getPageFollowers($instagramId,$nextMaxIdDb,$rankTokenDb);

                    //Готовим новый лист по которому будим получать данные
                    $readyListArray = [];

                    foreach ($followers as $key => $item){
                        $readyListArray[$key]['login'] = $item->getUsername();
                        $readyListArray[$key]['instagram_id'] = $instagramId;
                        $readyListArray[$key]['follower_instagram_id'] = $item->getPk();
                        $readyListArray[$key]['check'] = 0;
                        $readyListArray[$key]['status'] = 0;
                    }

                    $nextMaxId = $androidAPI->getNexMaxId();
                    $rankToken = $androidAPI->getRankToken();

                    if($nextMaxId){
                        $this->account_rep->update($checkAccount->id,['followers' => $countFollowers,'check_all_page' => 0,'next_max_id' => $nextMaxId,'rank_token' => $rankToken]);
                    }else{
                        $this->account_rep->update($checkAccount->id,['followers' => $countFollowers,'check_all_page' => 1,'next_max_id' => 0,'rank_token' => 0]);
                    }

                    $this->account_follower_rep->insert($readyListArray);


                }

            }

        }

    }

    //Проверка подписчиков аккаунта на наличие ботов
    public function checkAccountFollowers(){

        //Проверяем если есть задачи по получениям данных то ничего не делаем

        $androidList =  $this->task_rep->isEmpty();
        $taskList =  $this->task_android_rep->isEmpty();

        if(!$androidList or !$taskList){
            exit();
        }


        $donor = $this->donor_rep->getValidateDonor(5);

        //Id аккаунта по которому делается анализ в данный момент
        $selectId = '';
        //Массив будем складывать готовые результаты
        $ready = [];

        try{


        if (!empty($donor)) {

               //Если список пуст, получаем данные по аккаунту и записываем
                if($this->account_follower_rep->isCheckEmpty() and !$this->account_follower_rep->isEmpty()){

                    $humans = $this->account_follower_rep->getAllHumans();
                    $massFollowingHumans = $this->account_follower_rep->getAllMassFollowingHumans();
                    $bots = $this->account_follower_rep->getAllBots();

                    $countAll = $humans + $massFollowingHumans + $bots;

                    $checkAccount = $this->account_rep->getFirstAccount();

                    $nowDate = DataAssistant::nowDay();

                    //Чистим лист подписчиков для проверки следующего аккаунта.
                    $clearList = $this->account_follower_rep->clearList();

                    //Обновляем статус аккаунта записываем данные
                    $accountUpdate = $this->account_rep->update($checkAccount->id,['humans' => $humans,'mass_following_humans' =>  $massFollowingHumans,'bots' => $bots,'status' => 1,'date' => $nowDate,'followers' => $countAll]);

                }else{
                    foreach ($donor as $v) {

                        $listArray = $this->account_follower_rep->getList(70);

                        $androidAPI = new InstagramAndroidApi($v);
                        $ready = [];

                        foreach ($listArray as $k => $item){

                                $selectId =  $item->id;

                                $account = $androidAPI->getInfoUserById($item->follower_instagram_id);
                                $ready[$k]['id'] = $selectId;
                                $ready[$k]['instagram_id'] = $item->instagram_id;
                                $ready[$k]['login'] = $item->login;
                                $ready[$k]['follower_instagram_id'] = $item->follower_instagram_id;
                                $ready[$k]['check'] = 1;
                                $ready[$k]['status'] = $this->account_follower_rep->isBots($account);

                        }
                        $this->account_follower_rep->update($ready);

                    }
                }
        }}catch (\Exception $e){
           if($e->getMessage() === 'Requested resource does not exist.'){
               $this->account_follower_rep->update($ready);
               //Помечаем как бота аккаунт который уже заблокировали и
               // делаем отметку что бы пропустить его при следующем запуске
               $res = $this->account_follower_rep->updateRow($selectId,['status' => 2,'check' => 1]);
           }elseif($e->getMessage() === 'No response from server. Either a connection or configuration error.'){
               $this->account_follower_rep->update($ready);
               //Помечаем как бота аккаунт который уже заблокировали и
               // делаем отметку что бы пропустить его при следующем запуске
               $res = $this->account_follower_rep->updateRow($selectId,['status' => 2,'check' => 1]);
            }
            echo $e->getMessage();
        }

    }












}
