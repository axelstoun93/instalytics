<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Инстаграм - Статистика</title>
    <link rel="apple-touch-icon" href="{{asset(config('setting.theme-admin'))}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(config('setting.theme-admin'))}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/weather-icons/climacons.min.css">
    <!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/app.css">
    <!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->
    @yield('css')
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/assets/css/style.css">
    <!-- END Custom CSS-->

</head>
<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row position-relative">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('client')}}"><img class="brand-logo" alt="stack admin logo" src="{{asset(config('setting.theme-admin'))}}/app-assets/images/logo/stack-logo-light.png">
                        <h2 class="brand-text">Instalytics</h2></a></li>
                <li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            @yield('navigation')
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        @yield('leftMenu')
    </div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->

<div class="app-content content">
    @yield('content')
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->


<footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2019 <a class="text-bold-800 grey darken-2" href="http://instalytics.pro/" target="_blank">instalytics.pro</a>, All rights reserved. </span></p>
</footer>

@yield('script')

@yield('noPhone')


</body>
</html>