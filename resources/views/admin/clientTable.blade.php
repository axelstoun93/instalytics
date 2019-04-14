<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('adminClient') }}
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-primary dropdown-menu-right"  type="button" data-toggle="modal" data-target="#addForm"><i class="ft-plus icon-left"></i> Добавить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Список клиентов</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>

                            <div style="padding: 20px 0;">
                                <fieldset>
                                    <div class="d-inline-block custom-control custom-checkbox mr-1">
                                        <input type="checkbox" class="custom-control-input bg-info hiddenAccount" name="colorCheck" id="colorCheck4" checked="">
                                        <label class="custom-control-label" for="colorCheck4">Скрыть аккаунты которые не продвигаем</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-checkbox mr-1">
                                        <input type="checkbox" class="custom-control-input bg-warning hiddenData" name="colorCheck" id="colorCheck5">
                                        <label class="custom-control-label" for="colorCheck5">Скрыть прошедшую дата</label>
                                    </div>
                                </fieldset>
                            </div>

                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                @if(!empty($clients) and count($clients) >= 1)
                                <table class="table table-striped base-configuration">
                                    <thead>
                                    <tr>
                                        <th>Логин</th>
                                        <th>Аккаунт</th>
                                        <th>Аккаунт_старый</th>
                                        <th>Телефон</th>
                                        <th>Дата оплаты</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($clients as $client)
                                    <tr class="{{(time() > strtotime($client->pay_day)) ? 'bg-warning' :'btn-white'}} {{($client->account->promotion) ? 'promotion' :'no-promotion'}}">
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->account->login}}</td>
                                        <td>{{$client->account->old_login}}</td>
                                        <td class="phone">{{$client->phone}}</td>
                                        <td class="td-date">{{date('d/m/Y',strtotime($client->pay_day))}}</td>
                                        <td class="center">
                                            <button type="button" class="btn btn-success btn-small pay-button" data-url="{{route('payDay.update',$client->id)}}" data-id="{{$client->id}}" data-date="{{$client->pay_day}}"><i class="fa fa-usd"></i></button>
                                            <a href="{{route('instagram.show',$client->id)}}" target="_blank" class="btn btn-blue btn-small"><i class="ft-eye"></i></a>
                                            <button type="button" class="btn btn-info btn-small edit-button"  data-url="{{route('adminClient.update',$client->id)}}" data-login="{{$client->name}}" data-id="{{$client->id}}" data-promotion="{{$client->account->promotion}}" data-category="{{$client->account->category_id}}" data-bots="{{$client->account->bots}}"><i class="ft-edit-2"></i></button>
                                            <button type="button" class="btn btn-red btn-small remove-button" data-url="{{route('adminClient.destroy',$client->id)}}" data-login="{{$client->name}}" data-id="{{$client->id}}"><i class="ft-trash-2"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Логин</th>
                                        <th>Аккаунт</th>
                                        <th>Аккаунт_старый</th>
                                        <th>Телефон</th>
                                        <th>Дата оплаты</th>
                                        <th>Действия</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                    @else
                                    <div class="alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        Список клиентов пуст!
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

    <div class="modal fade text-left" id="addForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Добавить клиента</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('adminClient.store')}}" id="addClientForm" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <label>Логин: </label>
                        <div class="form-group">
                            <input type="text" placeholder="7t0un" name="name" class="form-control">
                        </div>

                      {{--  <label>Пароль: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Пароль" name="password" class="form-control">
                        </div>--}}

                        <label>Телефон: </label>
                        <div class="form-group">
                            <input type="tel" placeholder="" name="phone" class="phone form-control">
                        </div>

                        <label>Дата платежа: </label>
                        <div class="form-group">
                            <input type="date" placeholder="Дата" name="pay_day" class="date form-control">
                        </div>

                        <label>Боты: </label>
                        <div class="form-group">

                            <select name="bots" class="form-control" id="editBots">
                                <option value="0" selected>Нет</option>
                                <option value="1">Да</option>
                            </select>

                        </div>

                        <label>Категория: </label>
                        <div class="form-group">

                            <select name="category" class="form-control" id="categoryPromotion">
                                @foreach($category as $v)
                                     <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="закрыть">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Добавить">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Редактировать</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="editClientForm" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <label>Логин: </label>
                        <div class="form-group">
                            <input type="text" name="name" id="editLogin" value="" class="form-control" readonly>
                        </div>
                        <label>Пароль: </label>
                        <div class="form-group">
                            <input type="password" id="editPassword" placeholder="Пароль" name="password" class="form-control">
                        </div>
                        <label>Телефон: </label>
                        <div class="form-group">
                            <input type="text" id="editPhone" placeholder="+ 7 (___) ___-__-__" name="phone" class="phone form-control">
                        </div>
                        <label>Статус: </label>
                        <div class="form-group">

                        <select name="promotion" class="form-control" id="editPromotion">
                                <option value="0">Не продвигается</option>
                                <option value="1">Продвигается</option>
                        </select>

                        </div>

                        <label>Боты: </label>
                        <div class="form-group">

                            <select name="bots" class="form-control" id="editBots">
                                <option value="0">Нет</option>
                                <option value="1">Да</option>
                            </select>

                        </div>

                        <label>Категория: </label>
                        <div class="form-group">

                            <select name="category" class="form-control" id="editCategory">
                                @foreach($category as $v)
                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="закрыть">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Обновить">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade text-left" id="payForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Дата следующего платежа</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="payClientForm" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <label>Дата платежа: </label>
                        <div class="form-group">
                            <input type="date" id="payDate" placeholder="Дата" name="pay_day" class="date form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="закрыть">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Обновить">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title"><i class="ft-trash-2"></i> Удаление</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы уверены что хотите удалить аккаунт <span id="remove-name"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-outline-warning remove-yes">Да</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>