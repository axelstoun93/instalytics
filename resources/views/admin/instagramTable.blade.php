<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('instagram') }}
        </div>
    </div>
    <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title">Список аккаунтов</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>

                            <fieldset class="form-group" style="max-width: 360px;float: right;padding-top: 20px;">
                                <select name="category" class="form-control" id="categorySelect">
                                    <option value="">Клиенты:</option>
                                    @foreach($category as $v)
                                        <option value="{{route('instagram').'?category='.$v->id}}" {{(!empty($_GET['category']) and $_GET['category'] == $v->id) ? 'selected': ''}}>{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </fieldset>

                            <div style="padding-top: 20px;">
                                <fieldset>
                                    <div class="d-inline-block custom-control custom-checkbox mr-1">
                                        <input type="checkbox" class="custom-control-input bg-warning hiddenBots" name="colorCheck" id="colorCheck5">
                                        <label class="custom-control-label" for="colorCheck5">Скрыть аккаунты с ботами</label>
                                    </div>
                                </fieldset>
                            </div>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                @if(!empty($accounts) and count($accounts) >= 1)
                                    <table class="table table-striped all-instagram-account">
                                        <thead>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Логин</th>
                                            <th>Аккаунт</th>
                                            <th>Аккаунт_старый</th>
                                            <th>Имя</th>
                                            <th>Подписчики</th>
                                            <th>Подписки</th>
                                            <th>Медиа</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($accounts as $account)
                                            <tr class="{{($account->status) ? 'bg-success' : 'bg-warning'}} {{($account->bots) ? 'bg-bots' : ''}}">
                                                <td>
                                                    <a href="{{config('setting.instagram_url')}}/{{$account->login}}" target="_blank">
                                                         <img src="/{{$account->avatar}}" width="64" height="64">
                                                    </a>
                                                </td>
                                                <td>{{$account->user->name}}</td>
                                                <td>{{$account->login}}</td>
                                                <td>{{$account->old_login}}</td>
                                                <td>{{$account->name}}</td>
                                                <td>{{$account->follower}}</td>
                                                <td>{{$account->following }}</td>
                                                <td>{{$account->media_count}}</td>
                                                <td class="center">
                                                    <a href="{{route('instagram.show',$account->user_id)}}" class="btn btn-blue btn-small edit-button"><i class="ft-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Идентификатор</th>
                                            <th>Аккаунт</th>
                                            <th>Аккаунт_старый</th>
                                            <th>Имя</th>
                                            <th>Подписчики</th>
                                            <th>Подписки</th>
                                            <th>Медиа</th>
                                            <th>Действия</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        Список прокси адресов пуст!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Zero configuration table -->
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




