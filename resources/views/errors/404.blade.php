<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Инстаграм - Статистика 404</title>
    <link rel="apple-touch-icon" href="{{asset(config('setting.theme-admin'))}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(config('setting.theme-admin'))}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/app.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/pages/error.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/assets/css/style.css">
    <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 p-0">
                        <div class="card-header bg-transparent border-0">
                            <h2 class="error-code text-center mb-2">404</h2>
                            <h3 class="text-uppercase text-center">Страница не найдена!</h3>
                        </div>
                        <div class="card-content">
                            <div class="row py-2">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <a href="{{route('login')}}" class="btn btn-primary btn-block"><i class="ft-home"></i> Вернуться на главную</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <p class="text-muted text-center col-12 py-1">© 2019 <a href="http://datalytics.pro/" target="_blank">datalytics.pro </a>Ручной работы и сделано с <i class="ft-heart pink"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/forms/form-login-register.js"></script>
</body>