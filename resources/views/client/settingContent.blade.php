<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('settingAccount') }}
        </div>
    </div>
        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Настройки аккаунта</h4>
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
                                    <form class="form" action="{{route('clientSetting.store')}}" id="settingForm" method="post">
                                        {{csrf_field()}}
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> Персональные данные</h4>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput4">Номер телефона</label>
                                                        <input type="text" id="projectinput4" class="phone form-control" placeholder="7 (000) 000-00-00" name="phone" value="{{$client->phone}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Удалить номер телефона</label>
                                                    <div class="input-group">
                                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                                            <input type="radio" name="deletePhone" value="1" class="custom-control-input" id="yes">
                                                            <label class="custom-control-label" for="yes">Да</label>
                                                        </div>
                                                        <div class="d-inline-block custom-control custom-radio">
                                                            <input type="radio" name="deletePhone" value="0"  class="custom-control-input" id="no" checked>
                                                            <label class="custom-control-label" for="no">Нет</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <p></p>

                                            <hr class="form-section">

                                            <p>Нажимая кнопку "Сохранить" вы даете свое согласие на <a href="{{route('police')}}">обработку персональных данных</a>.</p>



                                        </div>

                                        <div class="form-actions text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Сохранить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
</div>
