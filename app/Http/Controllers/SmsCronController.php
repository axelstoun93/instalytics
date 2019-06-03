<?php

namespace App\Http\Controllers;

use App\Repositories\Api\SmsaeroApiV2;
use App\Repositories\UserRepository;
use App\User;

class SmsCronController extends Controller
{

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
                $smsaero_api->send($phone,'Через 3 дня продвижение завершится.Нужно продлить доступ, прислать чек', 'DIRECT');
            }
        }
    }

    //Оповещяем за 3 дня до оплаты
    public function payDayThreeNotification(){
        if(config('setting.sms_send')){
            $phone = $this->u_rep->getPhoneClientPayThreeDay();
            if($phone and !empty($phone)){
                $smsaero_api = new SmsaeroApiV2(); // api_key из личного кабинета
                $smsaero_api->send($phone,'Добрый день.Сегодня продвижение отключится.Пришлите пожалуйста квитанцию об оплате или сообщите о завершении работы.', 'DIRECT');
            }
        }
    }

}
