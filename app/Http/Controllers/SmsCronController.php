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
                $smsaero_api->send($phone,'Добрый день.Сегодня крайний день продвижения,завтра работа с аккаунтом будет завершена.Нужно продлить доступ и отправить чек.', 'DIRECT');
            }
        }
    }

    //Оповещяем за 3 дня до оплаты
    public function payDayThreeNotification(){
        if(config('setting.sms_send')){
            $phone = $this->u_rep->getPhoneClientPayThreeDay();
            if($phone and !empty($phone)){
                $smsaero_api = new SmsaeroApiV2(); // api_key из личного кабинета
                $smsaero_api->send($phone,'Добрый день. Через 3 дня заканчивается срок инстаграм-продвижения. Необходимо продлить доступ.Посмотрите статистику в личном кабинете. Логин - ваш инстаграм, пароль: promotion', 'DIRECT');
            }
        }
    }

}
