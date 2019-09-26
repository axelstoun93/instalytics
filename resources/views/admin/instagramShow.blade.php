<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('instagramShow',$client) }}
        </div>
    </div>
    <div class="content-body">
        @if(!empty($info) && !empty($client))
        <section>
                    <div class="row">
                        <h2 style="text-align: center;padding: 20px 0;width:100%;">Общие данные</h2>
                    </div>

                    <div class="row">

                            <div class="col-xl-2 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h3 class="success growth-data"></h3>
                                                    <span>Прирост</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="ft-trending-up success font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{(!empty($client->pay_day) || $client->pay_day) ? $client->pay_day : '0'}}</h3>
                                                    <span>Осталось дней</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="ft-calendar info font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <div class="col-xl-2 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="primary">{{$info->follower}}</h3>
                                                <span>Подписчики сейчас</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-user-check primary font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="primary">{{$client->account->follower}}</h3>
                                                <span>Подписчики вначале</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-user-check primary font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="danger">{{$info->following}}</h3>
                                                <span>Подписки сейчас</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-users danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="danger">{{$client->account->following}}</h3>
                                                <span>Подписки вначале</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="ft-users danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        @endif


        @if(!empty($statistic['data']))

                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Детальная статистика</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        @if(!empty($statistic['data']) and count($statistic['data']) >= 1)
                                            <table class="table table-striped base-configuration">
                                                <thead>
                                                <tr>
                                                    <th>Дата</th>
                                                    <th>Изменение кол-ва подписчиков</th>
                                                    <th>Общее кол-во подписчиков</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($statistic['data'] as $v)

                                                    <tr class="{{($v->growth >= 1) ? 'statistic-green' : 'statistic-red'}}" >
                                                        <td>{{$v->date_rus}}</td>
                                                        <td>{{$v->growth}}</td>
                                                        <td>{{$v->follower}}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Дата</th>
                                                    <th>Изменение кол-ва подписчиков</th>
                                                    <th>Общее кол-во подписчиков</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section id="follow-unffolow">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Подписался - отписался</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                    </div>
                                        <div class="card-content collapse show">
                                            @if(!empty($statistic['data']))
                                                <div class="row">
                                                    <div class="col-12">
                                                        <fieldset class="form-group" style="min-width:140px;float: right;padding:5px 20px;">
                                                            <select name="category" class="form-control" id="dataFollowUnfollowSelect" data-url="{{route('FollowUnfollowAccount',$client->id)}}" >
                                                                <option value="">Дата:</option>
                                                                @foreach(array_reverse($statistic['data']) as $k => $v)
                                                                    <option value="{{$v->date}}" {{($k === 0) ? 'selected':''}} >{{$v->date_rus}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row" id="follow-unfollow-block">

                                                <div class="col-sm-12 col-md-6">
                                                <div class="card-body card-dashboard">
                                                        <table class="table table-striped follow-table">
                                                                <thead>
                                                                <tr>
                                                                    <th>№</th>
                                                                    <th>Дата</th>
                                                                    <th>Аккаунт</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($follow) and count($follow) >= 1)
                                                                    @foreach($follow as $k => $v)
                                                                        <tr class="statistic-green-follow">
                                                                            <td>{{$k+1}}</td>
                                                                            <td>{{$v->date_rus}}</td>
                                                                            <td><a href="https://instagram.com/{{$v->login}}" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> https://instagram.com/{{$v->login}}</a></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>№</th>
                                                                    <th>Дата</th>
                                                                    <th>Аккаунт</th>
                                                                </tr>
                                                                </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                        <div class="card-body card-dashboard">
                                                                <table class="table unfollow-table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>№</th>
                                                                        <th>Дата</th>
                                                                        <th>Аккаунт</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @if(!empty($unfollow) and count($unfollow) >= 1)
                                                                        @foreach($unfollow as $k => $v)
                                                                            <tr class="statistic-red-follow">
                                                                                <td>{{$k+1}}</td>
                                                                                <td>{{$v->date_rus}}</td>
                                                                                <td><a href="https://instagram.com/{{$v->login}}" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> https://instagram.com/{{$v->login}}</a></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <th>№</th>
                                                                        <th>Дата</th>
                                                                        <th>Аккаунт</th>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>



                <section id="follow-unfollow-stats" class="trend-client-two">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Детальный график</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div id="area-chart-followers-stats" style="width:100%;height:380px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="line-area-charts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Тренд график</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div id="basic-line" class="height-400 echart-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


        @else
            <section id="info">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                            <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                Мы еще собираем данные по аккаунту!
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
</div>



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
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/echarts/echarts.js"></script>


<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/admin/instagram.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/serial.js" type="text/javascript"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/themes/light.js" type="text/javascript"></script>


<!-- 2. Include library -->

<script >
    $(window).ready(function(){

        // Set paths
        // ------------------------------
        require.config({
            paths: {
                echarts: '{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/echarts'
            }
        });


        // Configuration
        // ------------------------------

        require(
            [
                'echarts',
                'echarts/chart/bar',
                'echarts/chart/line'
            ],


            // Charts setup
            function (ec) {
                // Initialize chart
                // ------------------------------
                var myChart = ec.init(document.getElementById('basic-line'));

                // Chart Options
                // ------------------------------
                chartOptions = {

                    color: ['#404E67','#404E67','#404E67'],
                    xAxis: {
                        type: 'category',
                        data: [
                            @if(!empty($statistic['data']))
                                @foreach($statistic['data'] as $v)
                                    '{{$v->date_rus}}',
                                @endforeach
                            @endif
                        ],
                    },
                    yAxis: {
                        scale:true,
                        type: 'value',
                    },
                    tooltip: {
                        trigger: 'axis'
                    },


                    series: [{
                        data: [
                            @if(!empty($statistic['data']))
                                @foreach($statistic['data'] as $v)
                                    '{{$v->follower}}',
                                @endforeach
                            @endif
                        ],
                        type: 'line',
                        name: 'Подписчиков',
                        smooth: true,
                        itemStyle: {
                            normal: {
                                lineStyle: {
                                    // Regional map, longitudinal gradient fill
                                    color : '#404E67'
                                },
                            }},
                    }]
                };

                // Apply options
                // ------------------------------

                myChart.setOption(chartOptions);


                // Resize chart
                // ------------------------------

                $(function () {

                    // Resize chart on menu width change and window resize
                    $(window).on('resize', resize);
                    $(".menu-toggle").on('click', resize);

                    // Resize function
                    function resize() {
                        setTimeout(function() {

                            // Resize chart
                            myChart.resize();
                        }, 200);
                    }
                });
            }
        );
    });
</script>

<script>
    $(window).ready(function(){

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

        var data_r =  @if(!empty($statistic['json_data_follow_unfollow']['detail_data'])) {!!$statistic['json_data_follow_unfollow']['detail_data']!!} @endif

        var title =   @if(!empty($statistic['json_data_follow_unfollow']['detail_title'])) {!!$statistic['json_data_follow_unfollow']['detail_title']!!} @endif

        if (data_r && data_r.length) {
            var graphsFollowers = [];
            for (var i = 0; i < data_r.length; i++) {
                data_r[i].unfollow_day = -1 * data_r[i].unfollow_day;
            }

            for (var key in title) {
                var fillColors = '#ff200d';
                if (key === 'follow_day') {
                    fillColors = '#00B5B8';
                }

                graphsFollowers.push({
                    "balloonText": "<b>[[title]]</b>: <span style='font-size:14px'><b>[[value]]</b></span>",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.8,
                    "title": title[key].title,
                    "color": "#000000",
                    'fillColors': fillColors,
                    'lineColors': '#000000',
                    "valueField": key,
                    "type": "column",
                });
            }



            var chartFollowersHistogram = AmCharts.makeChart('area-chart-followers-stats', {
                "type": "serial",
                "theme": "light",
                "legend": {
                    "align": "center",
                    "equalWidths": true,
                    "periodValueText": "[[value]]",
                    "valueAlign": "center",
                    "valueText": "[[value]]",
                    "valueWidth": 100,
                    "useGraphSettings": true,
                },
                "chartScrollbar": {
                    "scrollbarHeight": 20,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": false,
                    "color": "#AAAAAA",
                    "resizeEnabled": false,
                },
                "chartCursor": {
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "dataProvider": data_r,
                "valueAxes": [{
                    "stackType": "regular" ,
                    "gridAlpha": 0.07,
                    "position": "left",
                    "integersOnly": true,
                }],
                "graphs": graphsFollowers,
                "plotAreaBorderAlpha": 0,
                "categoryField": "date",
                "categoryAxis": {
                    "startOnAxis": true,
                    "axisColor": "#DADADA",
                    "gridAlpha": 0.07,
                    "autoWrap": true,
                    "centerLabels": true,
                    "parseDates": true,
                    "dataDateFormat": "YYYY-MM-DD",
                },
                "export": {
                    "enabled": true
                },
            });
        }


    });
</script>


