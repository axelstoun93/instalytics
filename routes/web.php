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

Route::get('/',['uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

/*Route::get('reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('reset','Auth\ResetPasswordController@reset');
Route::post('email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');*/


/*Route::post('email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('reset','Auth\ResetPasswordController@reset');
Route::get('reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');*/


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

    Route::put('/client/pay/{id}','Admin\ClientController@payDayUpdate')->name('payDay.update');


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

    Route::resource('/config','Admin\configController',[
        'names' => [
            'index' => 'adminConfig',
            'update' => 'adminConfig.update',
            'store' => 'adminConfig.store',
        ]
    ]);

  /*  Route::resource('/test','CronController',[
        'names' => [
            'index' => 'CronController',
            'store' => 'CronController.store',
            'show' => 'CronController.show',
            'destroy' => 'CronController.destroy',
            'create' => 'CronController.create',
            'edit' => 'CronController.edit',
            'update' => 'CronController.update'
        ]
    ]);

    Route::get('/init','CronController@init');*/




});


/* Клиент */
Route::group(['prefix'=> 'client','middleware' => ['auth','client']], function ()
{


    Route::resource('/','Client\StatisticController',[
        'only' =>['index'],
        'names' => [
            'index' => 'client'
        ]
    ]);

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



});

Route::get('/sms','SmsController@index');