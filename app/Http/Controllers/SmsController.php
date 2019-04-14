<?php

namespace App\Http\Controllers;

use App\Proxy;
use App\Repositories\Api\SmsaeroApiV2;
use App\Repositories\Api\SmsInt;
use App\Repositories\UserRepository;
use App\User;

class SmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $u_rep;

    public function __construct()
    {
        $this->u_rep = new UserRepository(new User());
    }


    //Оповещяем в день оплаты
    public function payDayNotification(){

        if(config('setting.sms_send')){
            $phone = $this->u_rep->getPhoneClientPayDay();
            if($phone and !empty($phone)){
                $smsaero_api = new SmsaeroApiV2(); // api_key из личного кабинета
                $smsaero_api->send($phone,'Тестовая отправка', 'DIGITAL');
            }
        }
    }

    //Оповещяем за 3 дня до оплаты
    public function payDayThreeNotification(){
        if(config('setting.sms_send')){
            $phone = $this->u_rep->getPhoneClientPayThreeDay();
            if($phone and !empty($phone)){
                $smsaero_api = new SmsaeroApiV2(); // api_key из личного кабинета
                $smsaero_api->send($phone,'Тестовая отправка', 'DIGITAL');
            }
        }
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $res = $this->u_rep->getPhoneClientPayDay();
        $smsaero_api = new SmsaeroApiV2(); // api_key из личного кабинета
        dump($smsaero_api->send($res,'Добрый день.Сегодня крайний день продвижения, работа скоро остановится.Нужно продлить доступ.Реквизиты и статистика на сайте', 'DIRECT'));

    }
}
