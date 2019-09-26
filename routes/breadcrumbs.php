<?php
/* Админ панель администратор */

Breadcrumbs::for('adminHome', function ($trail) {
    $trail->push('Главная',route('admin'));
});


Breadcrumbs::for('adminClient', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('Клиенты','#');
});

Breadcrumbs::for('instagram', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('Аккаунты',route('instagram'));
});

Breadcrumbs::for('instagramShow', function ($trail,$client) {
    $trail->parent('instagram');
    $trail->push($client->account->login, '#');
});

Breadcrumbs::for('adminConfig', function ($trail) {
    $trail->push('Настройки','#');
});



Breadcrumbs::for('adminProxy', function ($trail) {
    $trail->parent('adminConfig');
    $trail->push('Прокси','#');
});

Breadcrumbs::for('adminDonor', function ($trail) {
    $trail->parent('adminConfig');
    $trail->push('Доноры','#');
});

Breadcrumbs::for('adminAllConfig', function ($trail) {
    $trail->parent('adminConfig');
    $trail->push('Общие настройки','#');
});

/* Админ панель администратор конец */

/* Админ панель клиента */
Breadcrumbs::for('clientHome', function ($trail) {
    $trail->push('Главная',route('client'));
});

Breadcrumbs::for('statisticController', function ($trail) {
    $trail->parent('clientHome');
    $trail->push('Статистика','#');
});

Breadcrumbs::for('analyticController', function ($trail) {
    $trail->parent('clientHome');
    $trail->push('Общая аналитика','#');
});

//Персональные данные
Breadcrumbs::for('policeController', function ($trail) {
    $trail->parent('clientHome');
    $trail->push('Политика обработки персональных данных','#');
});

Breadcrumbs::for('setting', function ($trail) {
    $trail->push('Настройки','#');
});


Breadcrumbs::for('settingAccount', function ($trail) {
    $trail->parent('setting');
    $trail->push('Настройки аккаунта','#');
});


/* Админ панель клиента конец */
