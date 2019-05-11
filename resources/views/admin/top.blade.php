@extends('layouts.admin.page')
@section('css')

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/plugins/extensions/toastr.css">
    <!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/fonts/meteocons/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/pages/users.css">
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
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/extensions/toastr.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/modal/components-modal.js"></script>

    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>

    <script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/admin/top.js"></script>

@endsection