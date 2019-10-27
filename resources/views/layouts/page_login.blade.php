<html class="loading" lang="ru" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="Честный сервис статистики datalytics.pro"/>
    <meta property="og:site_name" content="datalytics.pro"/>
    <meta property="og:url" content="http://datalytics.pro/"/>
    <meta property="og:description" content="Контролируйте приросты и оттоки аудитории, проверьте аккаунт на ботов, получайте ежедневные списки, кто подписался и отписался от вас с уникальным сервисом datalytics.pro. Зарегистрируйтесь и получите 3 дня бесплатно!"/>
    <meta property="og:image" content="http://datalytics.pro/site/images/datalytics.jpg"/>


    <title>Статистика по продвижению - datalytics.pro</title>

    <link rel="apple-touch-icon" href="{{asset(config('setting.theme-admin'))}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(config('setting.theme-admin'))}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/plugins/extensions/toastr.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/assets/css/style.css">
    <!-- END Custom CSS-->
</head>
<body class="horizontal-layout horizontal-menu 1-column   menu-expanded blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">

@yield('content')
@yield('script')

</body>
</html>
