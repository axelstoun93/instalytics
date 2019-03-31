<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('adminProxy') }}
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
                            <h4 class="card-title">Список прокси адресов</h4>
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
                                @if(!empty($proxy) and count($proxy) >= 1)
                                    <table class="table table-striped base-configuration">
                                        <thead>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Пароль</th>
                                            <th>ip адрес</th>
                                            <th>Порт</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($proxy as $p)
                                            <tr class="{{($p->status) ? 'bg-success' : 'bg-warning'}}">
                                                <td>{{$p->name}}</td>
                                                <td>{{$p->password}}</td>
                                                <td>{{$p->ip}}</td>
                                                <td>{{$p->port}}</td>
                                                <td>
                                                    @if($p->status)
                                                        Активен
                                                    @else
                                                        Не активен
                                                    @endif
                                                </td>
                                                <td class="center">
                                                    <button type="button" class="btn btn-blue btn-small status-button" data-url="{{route('proxy.validate',$p->id)}}"><i class="ft-refresh-cw"></i></button>
                                                    <button type="button" class="btn btn-red btn-small remove-button" data-url="{{route('adminProxy.destroy',$p->id)}}" data-id="{{$p->id}}" data-login="{{$p->name}}"><i class="ft-trash-2"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Пароль</th>
                                            <th>ip адрес</th>
                                            <th>Порт</th>
                                            <th>Статус</th>
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

    <div class="modal fade text-left" id="addForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Добавить прокси</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('adminProxy.store')}}" id="addProxyForm" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <label>Логин: </label>
                        <div class="form-group">
                            <input type="text" placeholder="2oatYXE6l5" name="name" class="form-control">
                        </div>

                        <label>Пароль: </label>
                        <div class="form-group">
                            <input type="text" placeholder="gearsxb" name="password" class="form-control">
                        </div>

                        <label>ip адрес: </label>
                        <div class="form-group">
                            <input type="text" placeholder="188.64.168.246" name="ip" class="form-control">
                        </div>


                        <label>Порт: </label>
                        <div class="form-group">
                            <input type="text" placeholder="46960" name="port" class="form-control">
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

