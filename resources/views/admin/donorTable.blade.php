<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('adminDonor') }}
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
                            <h4 class="card-title">Список доноров</h4>
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
                                @if(!empty($donor) and count($donor) >= 1)
                                    <table class="table table-striped base-configuration">
                                        <thead>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Пароль</th>
                                            <th>Прокси</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($donor as $d)
                                            <tr class="{{($d->status) ? 'bg-success' : 'bg-warning'}}">
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->password}}</td>
                                                <td>{{($d->proxy) ? $d->proxy->ip : 'Нет'}}</td>
                                                <td>
                                                    @if($d->status)
                                                        Активен
                                                    @else
                                                        Не активен
                                                    @endif
                                                </td>
                                                <td class="center">
                                                    <button type="button" class="btn btn-info btn-small edit-button"  data-url="{{route('adminDonor.update',$d->id)}}" data-name="{{$d->name}}" data-password="{{$d->password}}" data-proxy="{{$d->proxy_id}}"><i class="ft-edit-2"></i></button>
                                                    <button type="button" class="btn btn-blue btn-small status-button" data-url="{{route('donor.validate',$d->id)}}"><i class="ft-refresh-cw"></i></button>
                                                    <button type="button" class="btn btn-red btn-small remove-button" data-url="{{route('adminDonor.destroy',$d->id)}}" data-id="{{$d->id}}" data-login="{{$d->name}}"><i class="ft-trash-2"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Пароль</th>
                                            <th>Прокси</th>
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
                                        Список доноров пуст!
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
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Добавить донора</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('adminDonor.store')}}" id="addDonorForm" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <label>Логин: </label>
                        <div class="form-group">
                            <input type="text" placeholder="nadina_9187" name="name" class="form-control">
                        </div>

                        <label>Пароль: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Pro14334100" name="password" class="form-control">
                        </div>

                        <label>Прокси: </label>
                        <div class="form-group">

                        <select name="proxy" class="form-control" id="editProxy">
                                <option value="">Нет</option>
                                @foreach($proxy as $p)
                                    <option value="{{$p->id}}">{{$p->ip}}</option>
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
                <form action="#" id="editDonorForm" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <label>Логин: </label>
                        <div class="form-group">
                            <input type="text" id="editName" placeholder="nadina_9187" name="name" class="form-control">
                        </div>

                        <label>Пароль: </label>
                        <div class="form-group">
                            <input type="text" id="editPassword" placeholder="Pro14334100" name="password" class="form-control">
                        </div>

                        <label>Прокси: </label>
                        <div class="form-group">

                            <select name="proxy" class="form-control" id="editProxy">
                                <option value="">Нет</option>
                                @foreach($proxy as $p)
                                    <option value="{{$p->id}}">{{$p->ip}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="закрыть">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="обновить">
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
                    <p>Вы уверены что хотите удалить донора <span id="remove-name"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-outline-warning remove-yes">Да</button>
                </div>
            </div>
        </div>
    </div>
</div>
