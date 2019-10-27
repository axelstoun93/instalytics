<div class="content-wrapper">

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('statisticController') }}
        </div>
    </div>

    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ИНФОРМАЦИЯ О ПЛАТЕЖАХ</h4>
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
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="my-1 text-center">
                                        <div class="card-header pt-0">
                                            <h2 class="success">Осталось дней</h2>
                                            <h3 class="font-large-2 text-bold-800"> {{(!empty($client->pay_day) || $client->pay_day) ? $client->pay_day : '0'}}</h3>
                                        </div>
                                        <div class="card-content">
                                            @if($client->pay_day)
                                                <input type="text" value="{{round((100 / (31 / $client->pay_day)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#16D39A" data-knob-icon="ft-calendar">
                                            @else
                                                <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#16D39A" data-knob-icon="ft-calendar">
                                            @endif
                                            <ul class="list-inline clearfix pt-1 mb-0">
                                                <li>
                                                    <h2 class="grey darken-1 text-bold-800">Ваше продвижение оплачено до: {{$client->pay_day_full}}</h2>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{route('clientPay')}}" class="btn btn-primary">
                                            <i class="fa fa-credit-card"></i> Продлить доступы
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(!$client->pay_day)
        <div class="row">
            <div class="col-12">
                <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                    <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                        У вас нет прав на просмотр статистики! Оплаченные дни подошли к концу!
                    </div>
                </div>
            </div>
        </div>
   </div>
   @else


    <div class="content-body">
        @if($nowFollower <= 30000 and $client->pay_day > 6)
            <section id="bot-statistic-div">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Проверка аудитории аккаунта</h4>
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
                                    @if(!empty($accountFollowersValidate) and $accountFollowersValidate['data']->status === 1)
                                        <div id="botsDiagram" class="echart-container" style="width: 100%;height: 100%;min-height: 460px;text-align: center;"></div>
                                        <div class="accountFollowersValidateDetails" style="text-align: center;padding: 10px 0;">
                                            <p>Дата проверки аккаунта: {{$accountFollowersValidate['data']->date_rus}} г.</p>
                                            <p>Количество подписчиков на момент проверки: {{$accountFollowersValidate['data']->followers}} </p>
                                        </div>
                                        <div class="accountFollowersButtonDiv" style="text-align: center">
                                            <a href="#" id="accountFollowersButton" data-url="{{route('clientInstagram.check')}}" class="btn btn-primary">
                                                <i class="fa fa-search"></i> Проверить аккаунт
                                            </a>
                                        </div>
                                    @elseif(!empty($accountFollowersValidate) and $accountFollowersValidate['data']->status === 0)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                                                    <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                                        Мы еще собираем данные по аккаунту обычно это занимает 1-2 дня!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                                                    <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                                        Аккаунт не стоит в очереди на проверку аудитории!
                                                    </div>
                                                    <div class="accountFollowersButtonDiv" style="padding: 20px 0;text-align: center">
                                                        <a href="#" id="accountFollowersButton" data-url="{{route('clientInstagram.check')}}"  class="btn btn-primary">
                                                            <i class="fa fa-search"></i> Проверить аккаунт
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            @else
            <section id="bot-statistic-div">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Проверка аудитории аккаунта</h4>
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                                            <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                                Проверить на наличие ботов можно аккаунты, у которых аудитория меньше или равна 30 000 подписчиков!
                                            </div>
                                            <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                                У вас должно быть более 6 дней доступа, для проверки аккаунта на наличие ботов. Проверка на ботов не доступна в пробном бесплатном периоде.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        @endif

        @if(!empty($statistic['data']) and count($statistic['data']) >= config('setting.client_stats_min_day'))

        <section id="line-area-charts" class="trend-client">
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

            @if($nowFollower <= 30000)
            <section id="follow-unfollow-stats" class="trend-client-two">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Детальный график прироста и оттока аудитории</h4>
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

            <section id="follow-unffolow">
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
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
            @endif

        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Итоговая статистика по счетчику подписчиков</h4>
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
                                @if(!empty($statistic['data']) and count($statistic['data']) >= config('setting.client_stats_min_day'))
                                    <table class="table table-striped base-configuration client-table-statistic">
                                        <thead>
                                        <tr>
                                            <th><span class="pc">Дата</span><span class="mobile"><i class="fa fa-calendar"></i></span></th>
                                            <th><span class="pc">Изменение кол-ва подписчиков</span><span class="mobile"><i class="fa fa-user-plus"></i></span></th>
                                            <th><span class="pc">Общее кол-во подписчиков</span><span class="mobile"><i class="fa fa-users"></i></span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($statistic['data'] as $v)
                                            <tr class="{{(($v->growth >= 1)) ? 'statistic-green' : 'statistic-red'}}" >
                                                <td>{{$v->date_rus}}</td>
                                                <td>{{$v->growth}}</td>
                                                <td>{{$v->follower}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th><span class="pc">Дата</span><span class="mobile"><i class="fa fa-calendar"></i></span></th>
                                            <th><span class="pc">Изменение кол-ва подписчиков</span><span class="mobile"><i class="fa fa-user-plus"></i></span></th>
                                            <th><span class="pc">Общее кол-во подписчиков</span><span class="mobile"><i class="fa fa-users"></i></span></th>
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
            @else
            <section id="info">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                            <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                Система собирает базовые данные в течение 48 часов.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
    </div>
</div>

@endif

<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/all/clipboard.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/extensions/toastr.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/modal/components-modal.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>

<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/all/jquery.mask.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/echarts/echarts.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/client/statistic.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/client/client.js"></script>

<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/serial.js" type="text/javascript"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/pie.js" type="text/javascript"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/amcharts/themes/light.js" type="text/javascript"></script>


<script>
    $(window).on("load", function(){
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
    });
</script>




<!-- 2. Include library -->
@if($client->pay_day and !empty($statistic['data']))
<script>
    $(window).on("load", function(){

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
                            @foreach($statistic['data'] as $v)
                                '{{$v->date_rus}}',
                            @endforeach
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
                            @foreach($statistic['data'] as $v)
                                '{{$v->follower}}',
                            @endforeach
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
    (function(window, document, $) {

        var data_r = {!! $statistic['json_data_follow_unfollow']['detail_data'] !!};

        var title =  {!! $statistic['json_data_follow_unfollow']['detail_title'] !!};

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
    })(window, document, jQuery);
</script>

<script>
    $(window).on("load", function(){

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
                'echarts/chart/pie',
                'echarts/chart/bar'
            ],


            // Charts setup
            function (ec) {
                // Initialize chart
                // ------------------------------
                var botsChart = ec.init(document.getElementById('botsDiagram'));

                var accountFollowersValidate = @if(!empty($accountFollowersValidate['json'])) {!!$accountFollowersValidate['json']!!}; @else ''; @endif
                var login = 'Аккаунт - ' + '{!!$client->account->login!!}';

                // ------------------------------
                chartOptions = {

                    // Add title
                    title: {
                        text: 'Диаграмма аудитории',
                        subtext: login,
                        x: 'center'
                    },



                    // Add legend
                    legend: {
                        orient: 'horizontal',
                        x: 'center',
                        y: 'bottom',
                        data: accountFollowersValidate
                    },

                    color: ['#0088cc', '#2baab1', '#E36159'],

                    toolbox: {
                        show: true,
                        orient: 'vertical',
                        feature: {
                            mark: {
                                show: false
                            },
                            dataView: {
                                show: true,
                                readOnly: true,
                                title: 'Просмотр данных',
                                lang: ['Просмотр данных диаграммы', 'Закрыть', 'Обновить']
                            },
                            restore: {
                                show: true,
                                title: 'Обновить'
                            },
                            saveAsImage: {
                                show: true,
                                title: 'Сохранить',
                                lang: ['Save']
                            }
                        }
                    },

                    // Enable drag recalculate
                    calculable: true,

                    // Add series
                    series: [
                        {
                            name: 'Данные',
                            type: 'pie',
                            radius: ['50%', '70%'],
                            center: ['50%', '54.0%'],

                            itemStyle: {
                                normal: {
                                    label: {
                                        show: true,
                                        formatter: '{b}: {c} ({d}%)'

                                    },
                                    labelLine: {
                                        show: true
                                    }
                                },
                                emphasis: {
                                    label: {
                                        show: true,
                                        formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                                        position: 'center',
                                        textStyle: {
                                            fontSize: '17',
                                            fontWeight: '500'
                                        }
                                    }
                                }
                            },

                            data: accountFollowersValidate
                        }
                    ]
                };

                // Apply options
                // ------------------------------

                botsChart.setOption(chartOptions);


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
                            botsChart.resize();
                        }, 200);
                    }
                });
            }
        );
    });
</script>
@endif
