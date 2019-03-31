<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$page}}</h3>
            {{ Breadcrumbs::render('adminAllConfig') }}
        </div>
    </div>
    <div class="content-body"><!-- Basic form layout section start -->
        <section id="horizontal-form-layouts">



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="horz-layout-icons">Настройки</h4>
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
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal" id="configForm" action="{{route('adminConfig.store')}}" method="post">

                                    {{csrf_field()}}

                                    @if(!empty($config['card']['value']))

                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="timesheetinput1">Номер карты</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" class="{{$config['card']['class']}} form-control" placeholder="" name="card" value="{{$config['card']['value']}}">
                                                    <div class="form-control-position">
                                                        <i class="ft-credit-card"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endif

                                    <div class="form-actions center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i> Обновить
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- // Basic form layout section end -->
    </div>
</div>