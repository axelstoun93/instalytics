<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login',['uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');


//Регистрация нового пользователя
Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register','Auth\RegisterController@registerClient')->name('register');

//Восстановление пароля
Route::get('reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('reset','Auth\ResetPasswordController@reset')->name('password.update');
Route::post('email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

/* сайт */
Route::resource('/','Site\IndexController',[
    'only' =>['index'],
    'names' => ['index'=>'site']
]);

//FAQ
Route::resource('/faq','Site\FaqController',[
    'names' => [
        'index'=>'faq',
    ]
]);

//Инструкция
Route::resource('/information','Site\InformationController',[
    'names' => [
        'index'=>'information',
    ]
]);

//Пользовательское соглашение
Route::resource('/agreement','Site\AgreementController',[
    'names' => [
        'index'=>'agreement',
    ]
]);

//Правила безопасности
Route::resource('/security','Site\SecurityController',[
    'names' => [
        'index'=>'security',
    ]
]);

//Политика конфиденциальности
Route::resource('/confidentiality','Site\ConfidentialityController',[
    'names' => [
        'index'=>'confidentiality',
    ]
]);
/* сайт конец */


/* Администратор */
Route::group(['prefix'=> 'administrator','middleware' => ['auth','administrator']], function ()
{

    Route::resource('/','Admin\IndexController',[
        'only' =>['index'],
        'names' => [ 'index'=> 'admin']
    ]);

    Route::resource('/client','Admin\ClientController',[
             'names' => [
                 'index' => 'adminClient',
                 'store' => 'adminClient.store',
                 'create' => 'adminClient.create',
                 'show' => 'adminClient.show',
                 'edit' => 'adminClient.edit',
                 'update' => 'adminClient.update',
                 'destroy' => 'adminClient.destroy'
             ]
    ]);

    Route::put('/pay/client/pay/{id}','Admin\ClientController@payDayUpdate')->name('payDay.update');

    Route::post('/editDay/client/{id}','Admin\ClientController@editDayUpdate')->name('editDay.update');

    Route::post('/publicDay/client/{id}','Admin\ClientController@publicDayUpdate')->name('publicDay.update');


    Route::resource('/proxy','Admin\ProxyController',[
        'names' => [
            'index' => 'adminProxy',
            'store' => 'adminProxy.store',
            'show' => 'adminProxy.show',
            'destroy' => 'adminProxy.destroy',
            'create' => 'adminProxy.create',
            'edit' => 'adminProxy.edit',
            'update' => 'adminProxy.update'
        ]
    ]);


    Route::post('proxy/validate/{id}/','Admin\ProxyController@statusProxy')->name('proxy.validate');


    Route::resource('/donor','Admin\InstagramDonorController',[
        'names' => [
            'index' => 'adminDonor',
            'store' => 'adminDonor.store',
            'show' => 'adminDonor.show',
            'destroy' => 'adminDonor.destroy',
            'create' => 'adminDonor.create',
            'edit' => 'adminDonor.edit',
            'update' => 'adminDonor.update'
        ]
    ]);

    Route::post('donor/validate/{id}/','Admin\InstagramDonorController@statusDonor')->name('donor.validate');

    Route::resource('/instagram','Admin\InstagramController',[
        'names' => [
            'index' => 'instagram',
            'store' => 'instagram.store',
            'show' => 'instagram.show',
            'destroy' => 'instagram.destroy',
            'create' => 'instagram.create',
            'edit' => 'instagram.edit',
            'update' => 'instagram.update'
        ]
    ]);

    Route::post('/instagram/check','Admin\InstagramController@checkAccount')->name('instagram.check');

    Route::resource('/top','Admin\TopAccountController',[
        'names' => [
            'index' => 'adminTop',
            'store' => 'adminTop.store',
            'create' => 'adminTop.create',
            'show' => 'adminTop.show',
            'edit' => 'adminTop.edit',
            'update' => 'adminTop.update',
            'destroy' => 'adminTop.destroy'
        ]
    ]);

    Route::resource('/config','Admin\ConfigController',[
        'names' => [
            'index' => 'adminConfig',
            'update' => 'adminConfig.update',
            'store' => 'adminConfig.store',
        ]
    ]);

});

/* Teсты */

/*Route::get('/init','CronController@init');
Route::get('/getTask','CronController@getTask');
Route::get('/getAndroidTask','CronController@getAndroidTask');
Route::get('/deleteTest','CronController@clearFollowerUserList');*/
//Route::get('/getTask','CronController@getTaskNew');
//Route::get('/botInit','AccountCronController@init');
//Route::get('/checkBotsAccount','AccountCronController@checkAccountFollowers');

//Route::get('/getAndroidTaskTest','CronController@getAndroidTaskTest');
//Route::get('/getTask','CronController@getTaskNew');
//Route::get('/botInit','AccountCronController@init');
Route::get('/init','CronController@init');
Route::get('/getTask','CronController@getTaskNew');
Route::get('/getAndroidTask','CronController@getAndroidTaskTest');
Route::get('/botInit','AccountCronController@init');
/* Teсты конец */

Route::get('/checkBotsAccount','AccountCronController@checkAccountFollowers');

/* Клиент */
Route::group(['prefix'=> 'client','middleware' => ['auth','client']], function ()
{


    Route::resource('/','Client\StatisticController',[
        'only' =>['index'],
        'names' => [
            'index' => 'client'
        ]
    ]);


    Route::post('/check','Client\StatisticController@checkAccount')->name('clientInstagram.check');

    Route::resource('/analytic','Client\AnalyticController',[
        'names' => [
            'index' => 'analyticStatistic',
            'store' => 'analyticStatistic.store',
            'show' => 'analyticStatistic.show',
            'destroy' => 'analyticStatistic.destroy',
            'create' => 'analyticStatistic.create',
            'edit' => 'analyticStatistic.edit',
            'update' => 'analyticStatistic.update'
        ]
    ]);


    //Политика конфиденциальности
    Route::resource('/police','Client\PoliceController',[
        'only' =>['index'],
        'names' => [
            'index' => 'police'
        ]
    ]);

    Route::resource('/pay','Client\PayController',[
        'only' =>['index'],
        'names' => [
            'index' => 'clientPay'
        ]
    ]);



    //Настройки профиля клиента
    Route::resource('/setting','Client\SettingController',[
        'names' => [
            'index' => 'clientSetting',
            'store' => 'clientSetting.store',
            'show' => 'clientSetting.show',
            'destroy' => 'clientSetting.destroy',
            'create' => 'clientSetting.create',
            'edit' => 'clientSetting.edit',
            'update' => 'clientSetting.update'
        ]
    ]);


    //Обновляем номер телефона
    Route::post('/addPhone','Client\SettingController@addPhone')->name('clientSetting.addPhone');

});


/* Общий ajax контроллер */
Route::post('/ajax/FollowUnfollowAccount/{id}','AjaxController@getFollowUnfollowAccount')->name('FollowUnfollowAccount');
