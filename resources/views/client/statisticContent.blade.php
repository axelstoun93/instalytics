<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('statisticController') }}
        </div>
    </div>
    <div class="content-body">


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
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 text-center">

                                        <div class="card pay-info">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p style="font-size: 20px">Номер карты для перевода!</p>
                                                    <fieldset class="card-pay-block">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"><i class="ft-credit-card"></i></button>
                                                            </div>
                                                            <input type="text" class="mask-card-number form-control" id="pay-card" value="{{$card->value}}" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" id="pay-copy"  data-clipboard-text="{{$card->value}}" type="button"><span class="pc">Копировать!</span><span class="mobile"><i class="fa fa-files-o"></i> </span></button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pay-text">
                                            <div class="card">
                                                <h4 class="alert-heading mb-2">Обратите внимание:</h4>
                                                <div class="text-left">
                                                Для продления работы над вашим продвижением, необходимо заранее оплатить доступы на месяц вперед, чтобы я успел продлить все необходимые для работы сервера. При отсутствии оплаты работа с аккаунтом завершается в течение 2х дней после окончания срока продвижения. Отписки от тех, на кого я подписался осуществляются всегда, если вы предупреждаете о завершении работы по окончанию срока продвижения. Если вы не выходите на связь и работа с аккаунтом будет завершена, я не смогу вам сделать отписки.
                                                <br><br>
                                                ⚠ В комментарии напишите просто свою имя и фамилию. В соответствии с новыми особенностями коммерческих переводов, не указывайте пожалуйста в комментарии, что перевод "за продвижение", "за инстаграм" и прочее. Я пойму, что это за продвижение.
                                                <br><br>
                                                ⚠ Пришлите чек после оплаты вконтакте по ссылке: <a href="https://vk.com/bazarov_photography" target="_blank">https://vk.com/bazarov_photography</a>
                                                <br><br>
                                                📝 Подтверждением вашего платежа является квитанция-чек, где указан номер карты с которой был сделан перевод и время перевода. Без квитанции о переводе я не увижу вашу оплату.
                                                <br><br>
                                                💳 Для переводов не через Сбербанк:
                                                Если вы совершаете перевод не через Сбербанк, а через сторонний банк (Тиньков, Альфа и др.), я увижу только последние 4 цифры номера карты, с которой вы оплатили, поэтому необходимо сообщить их, т.к. в чеке зачастую они не указаны. Чтобы опознать ваш платеж, мне необходим чек о переводе и последние 4 цифры номера карты, например *8765.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        @if(!empty($statistic) and count($statistic) >= config('setting.client_stats_min_day'))

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
                                @if(!empty($statistic) and count($statistic) >= config('setting.client_stats_min_day'))
                                    <table class="table table-striped base-configuration client-table-statistic">
                                        <thead>
                                        <tr>
                                            <th><span class="pc">Дата</span><span class="mobile"><i class="fa fa-calendar"></i></span></th>
                                            <th><span class="pc">Изменение кол-ва подписчиков</span><span class="mobile"><i class="fa fa-user-plus"></i></span></th>
                                            <th><span class="pc">Общее кол-во подписчиков</span><span class="mobile"><i class="fa fa-users"></i></span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                   @foreach($statistic as $v)
                                            <tr class="{{(($v->growth >= 1)) ? 'statistic-green' : 'statistic-red'}}" >
                                                <td>{{$v->date}}</td>
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
                                Система собирает базовые данные в течении первых {{config('setting.client_stats_min_day')}} дней.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
    </div>
</div>

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



<!-- 2. Include library -->

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


