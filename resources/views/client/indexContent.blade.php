<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        @if(!empty($info))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">

                        <div class="row">
                            <h2 style="text-align: center;padding: 20px 0;width:100%;">Сейчас</h2>
                        </div>

                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="primary">Подписчиков</h5>
                                        <h3 class="font-large-2 text-bold-200">{{$info->follower}}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($info->follower)
                                            <input type="text" value="{{round((100 / (100000 / $info->follower)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#00B5B8" data-knob-icon="ft-user-check">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="40" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#00B5B8" data-knob-icon="ft-user-check">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="danger">Подписок</h5>
                                        <h3 class="font-large-2 text-bold-200">{{$info->following}}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($info->following)
                                            <input type="text" value="{{round((100 / (7500 / $info->following)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".19" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FF7588" data-knob-icon="ft-users">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".19" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FF7588" data-knob-icon="ft-users">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="warning">Медиа</h5>
                                        <h3 class="font-large-2 text-bold-200">{{($info->media_count) ? $info->media_count : 0 }}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($info->media_count)
                                            <input type="text" value="{{round((100 / (1000 / $info->media_count)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FFA87D" data-knob-icon="ft-video">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="20" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FFA87D" data-knob-icon="ft-video">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="success">Осталось дней</h5>
                                        <h3 class="font-large-2 text-bold-200"> {{(!empty($client->pay_day) || $client->pay_day) ? $client->pay_day : '0'}}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($client->pay_day)
                                        <input type="text" value="{{round((100 / (31 / $client->pay_day)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#16D39A" data-knob-icon="ft-calendar">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#16D39A" data-knob-icon="ft-calendar">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">

                        <div class="row">
                            <h2 style="text-align: center;padding: 20px 0;width:100%;">Начало продвижения</h2>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="primary">Подписчиков</h5>
                                        <h3 class="font-large-2 text-bold-200">{{$client->account->follower}}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($client->account->follower)
                                            <input type="text" value="{{round((100 / (100000 / $client->account->follower)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#00B5B8" data-knob-icon="ft-user-check">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="40" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#00B5B8" data-knob-icon="ft-user-check">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="danger">Подписок</h5>
                                        <h3 class="font-large-2 text-bold-200">{{$client->account->following}}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($client->account->following)
                                            <input type="text" value="{{round((100 / (7500 / $client->account->following)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".19" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FF7588" data-knob-icon="ft-users">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".19" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FF7588" data-knob-icon="ft-users">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                <div class="my-1 text-center">
                                    <div class="card-header mb-2 pt-0">
                                        <h5 class="warning">Медия</h5>
                                        <h3 class="font-large-2 text-bold-200">{{($client->account->media_count) ? $client->account->media_count : 0 }}</h3>
                                    </div>
                                    <div class="card-content">
                                        @if($client->account->media_count)
                                             <input type="text" value="{{round((100 / (1000 / $client->account->media_count)),PHP_ROUND_HALF_UP) }}" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FFA87D" data-knob-icon="ft-video">
                                        @else
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="20" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#BABFC7" data-readOnly="true" data-fgColor="#FFA87D" data-knob-icon="ft-video">
                                        @endif
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