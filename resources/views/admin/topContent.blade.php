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
                            <h4 class="card-title">Топ аккаунты</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>

                            <form class="form" style="padding-top: 20px">
                                <div class="form-body" >

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="date" id="startDate" class="form-control" name="start_date" value="{{(!empty($_GET['start_date'])) ? $_GET['start_date'] : $oldDate}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="date" id="endDate" class="form-control" name="end_date" value="{{(!empty($_GET['end_date'])) ? $_GET['end_date'] : $nowDate}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="category" class="form-control" id="categorySelect">
                                                <option value="">Клиенты:</option>
                                                @foreach($category as $v)
                                                    <option value="{{$v->id}}" {{(!empty($_GET['category']) and $_GET['category'] == $v->id) ? 'selected': ''}}>{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Применить
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>

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
                                            <th>Прирост</th>
                                            <th>Дата публикации</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($accounts as $account)
                                            <tr>
                                                <td>
                                                    <a href="{{config('setting.instagram_url')}}/{{$account->login}}" target="_blank">
                                                        <img src="/{{$account->avatar}}" width="64" height="64">
                                                    </a>
                                                </td>
                                                <td>{{$account->instagram_id}}</td>
                                                <td>{{$account->login}}</td>
                                                <td class="{{($account->growth >= 1) ? 'color-green' : 'color-red'}}">{{$account->growth}}</td>
                                                <td class="td-date">{{(!empty($account->user->public_day)) ? date('d/m/Y',strtotime($account->user->public_day)) : ''}}</td>
                                                <td class="center">
                                                    <a href="{{route('instagram.show',$account->user_id)}}" target="_blank" class="btn btn-blue btn-small edit-button"><i class="ft-eye"></i></a>
                                                    <button type="button" class="btn btn-info btn-small public-day-button"  data-url="{{route('publicDay.update',$account->user_id)}}" data-public-date="{{$account->user->public_day}}"  ><i class="ft-edit-2"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Идентификатор</th>
                                            <th>Аккаунт</th>
                                            <th>Прирост</th>
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



<div class="modal fade text-left" id="publicDay" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Дата публикации</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="publicDayForm" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <label>Дата публикации: </label>
                    <div class="form-group">
                        <input type="date" id="publicDate" placeholder="Дата" name="public_day" class="date form-control">
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