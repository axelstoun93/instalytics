<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{$title}}</title>

    <meta name="keywords" content="{{$keywords}}" />
    <meta name="description" content="{{$description}}">

    <meta property="og:title" content="Честный сервис статистики datalytics.pro"/>
    <meta property="og:site_name" content="datalytics.pro"/>
    <meta property="og:url" content="http://datalytics.pro/"/>
    <meta property="og:description" content="Контролируйте приросты и оттоки аудитории, проверьте аккаунт на ботов, получайте ежедневные списки, кто подписался и отписался от вас с уникальным сервисом datalytics.pro. Зарегистрируйтесь и получите 3 дня бесплатно!"/>
    <meta property="og:image" content="http://datalytics.pro/site/images/datalytics.jpg"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset(config('setting.theme'))}}/img/favicon.ico" type="image/x-icon" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/css/theme.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/css/theme-elements.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/css/theme-blog.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/vendor/rs-plugin/css/navigation.css">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset(config('setting.theme'))}}/css/custom.css">

    <!-- Head Libs -->
    <script src="{{asset(config('setting.theme'))}}/vendor/modernizr/modernizr.min.js"></script>

</head>
<body>
<div class="body">
    @yield('menu')
    @yield('content')
    @yield('footer')
</div>

<!-- Vendor -->
<script src="{{asset(config('setting.theme'))}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/common/common.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery.validation/jquery.validation.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/isotope/jquery.isotope.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/vide/vide.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{asset(config('setting.theme'))}}/js/theme.js"></script>

<!-- Banner -->
<script type="text/javascript" src="{{asset(config('setting.theme'))}}/js/video-banner.js"></script>
<!-- /Banner -->

<!-- Current Page Vendor and Views -->
<script src="{{asset(config('setting.theme'))}}/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="{{asset(config('setting.theme'))}}/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Theme Custom -->
<script src="{{asset(config('setting.theme'))}}/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="{{asset(config('setting.theme'))}}/js/theme.init.js"></script>


</body>
</html>
