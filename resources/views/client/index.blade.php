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
    <link rel="stylesheet" type="text/css" href="{{asset(config('setting.theme-admin'))}}/app-assets/css/core/colors/palette-gradient.css">p
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
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBDkKetQwosod2SZ7ZGCpxuJdxY3kxo5Po"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/gmaps.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/unslider-min.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/echarts/echarts.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app.js"></script>
    <script>


        (function(window, document, $) {

            var rtl = false;
            if($('html').data('textdirection') == 'rtl')
                rtl = true;
            $(".knob").knob({
                rtl:rtl,
                draw: function() {
                    var ele = this.$;
                    var style = ele.attr('style');
                    var fontSize = parseInt(ele.css('font-size'), 10);
                    var updateFontSize = Math.ceil(fontSize * 1.65);
                    style = style.replace("bold", "normal");
                    style = style + "font-size: " +updateFontSize+"px;";
                    var icon = ele.attr('data-knob-icon');
                    ele.hide();
                    $('<i class="knob-center-icon '+icon+'"></i>').insertAfter(ele).attr('style',style);

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        this.cursorExt = 0.3;

                        var a = this.arc(this.cv), // Arc
                            pa, // Previous arc
                            r = 1;

                        this.g.lineWidth = this.lineWidth;

                        if (this.o.displayPrevious) {
                            pa = this.arc(this.v);
                            this.g.beginPath();
                            this.g.strokeStyle = this.pColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });

        })(window, document, jQuery);
    </script>
@endsection
