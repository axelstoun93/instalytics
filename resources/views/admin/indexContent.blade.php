<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Требуют внимания</h4>
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
                                        <option value="{{route('admin').'?category='.$v->id}}" {{(!empty($_GET['category']) and $_GET['category'] == $v->id) ? 'selected': ''}}>{{$v->name}}</option>
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
                                    <table class="table table-striped base-configuration">
                                        <thead>
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
                                        </thead>
                                        <tbody>

                                        @foreach($accounts as $account)
                                            <tr class="{{($account->status) ? 'bg-success' : 'bg-warning'}} {{($account->bots) ? 'bg-bots' : ''}}">
                                                <td>
                                                    <a href="{{config('setting.instagram_url')}}/{{$account->login}}" target="_blank">
                                                        <img src="/{{$account->avatar}}" width="64" height="64">
                                                    </a>
                                                </td>
                                                <td>{{$account->instagram_id}}</td>
                                                <td>{{$account->login}}</td>
                                                <td>{{$account->old_login}}</td>
                                                <td>{{$account->name}}</td>
                                                <td>{{$account->follower}}</td>
                                                <td>{{$account->following }}</td>
                                                <td>{{$account->media_count}}</td>
                                                <td class="center">
                                                    <a href="{{route('instagram.show',$account->user_id)}}" target="_blank" class="btn btn-blue btn-small edit-button"><i class="ft-eye"></i></a>
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
                                        Список пуст!
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