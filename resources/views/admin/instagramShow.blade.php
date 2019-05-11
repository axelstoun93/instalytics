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


        @if(!empty($statistic) and !empty($clientStatistic))

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
                                    @if(!empty($statistic) and count($statistic) >= 1)
                                        <table class="table table-striped base-configuration">
                                            <thead>
                                            <tr>
                                                <th>Дата</th>
                                                <th>Изменение кол-ва подписчиков</th>
                                                <th>Общее кол-во подписчиков</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($statistic as $v)

                                                <tr class="{{($v->growth >= 1) ? 'statistic-green' : 'statistic-red'}}" >
                                                    <td>{{$v->date}}</td>
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Детальная статистика - клиент</h4>
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
                                    @if(!empty($clientStatistic) and count($clientStatistic) >= 1)
                                        <table class="table table-striped base-configuration-client">
                                            <thead>
                                            <tr>
                                                <th>Дата</th>
                                                <th>Изменение кол-ва подписчиков</th>
                                                <th>Общее кол-во подписчиков</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($clientStatistic as $v)

                                                <tr class="{{($v->growth >= 1) ? 'statistic-green' : 'statistic-red'}}" >
                                                    <td>{{$v->date}}</td>
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Тренд график клиент</h4>
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
                                    <div id="basic-line-client" class="height-400 echart-container"></div>
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




<script>


    (function() {
        document.addEventListener('DOMContentLoaded', function() {

           @if(!empty($info))

            var rtl = false;
            if ($('html').data('textdirection') == 'rtl')
                rtl = true;
            $(".knob").knob({
                rtl: rtl,
                draw: function () {
                    var ele = this.$;
                    var style = ele.attr('style');
                    var fontSize = parseInt(ele.css('font-size'), 10);
                    var updateFontSize = Math.ceil(fontSize * 1.65);
                    style = style.replace("bold", "normal");
                    style = style + "font-size: " + updateFontSize + "px;";
                    var icon = ele.attr('data-knob-icon');
                    ele.hide();
                    $('<i class="knob-center-icon ' + icon + '"></i>').insertAfter(ele).attr('style', style);

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

            @endif



            @if(!empty($statistic) and !empty($clientStatistic))
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
                    var myChartClient = ec.init(document.getElementById('basic-line-client'));

                    // Chart Options
                    // ------------------------------
                    chartOptions = {

                        color: ['#404E67','#404E67','#404E67'],
                        xAxis: {
                            type: 'category',
                            data: [
                                @foreach($statistic as $v)
                                    '{{$v->date}}',
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
                                @foreach($statistic as $v)
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


                    chartOptionsClient = {

                        color: ['#404E67','#404E67','#404E67'],
                        xAxis: {
                            type: 'category',
                            data: [
                                @foreach($clientStatistic as $v)
                                    '{{$v->date}}',
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
                                @foreach($clientStatistic as $v)
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

                    myChartClient.setOption(chartOptionsClient);


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
                })
                @endif
        })
    })();

</script>


