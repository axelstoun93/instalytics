@extends('layouts.client.page')
@section('css')

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
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/fonts/meteocons/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/pages/users.css">

    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/pages/gallery.css">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/assets/css/style.css">
    <!-- END Custom CSS-->

@endsection
@section('navigation')
    {!! $navigation !!}
@endsection
@section('leftMenu')
    {!! $leftMenu !!}
@endsection
@section('content')
    {!! $content !!}
@endsection

@section('script')
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js"></script>

    <script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/client/pay.js"></script>
@endsection
