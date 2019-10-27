@extends('layouts.page_login')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body login"><section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <div class="p-1"><a href="{{route('site')}}"><img src="{{asset(config('setting.theme-admin'))}}/app-assets/images/logo/stack-logo-dark.png" alt="logo"></a></div>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login with Datalytics</span></h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @if(!empty($errors->has('name')) || !empty($errors->has('password')) || !empty($errors->has('email')) )
                                        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            @if(!empty($errors->has('name')))
                                                      {{$errors->first('name')}}
                                            @endif
                                            @if(!empty($errors->has('password')))
                                                {{$errors->first('password')}}
                                            @endif
                                            @if(!empty($errors->has('email')))
                                                {{$errors->first('email')}}
                                            @endif
                                        </div>
                                    @endif

                                    <form class="form-horizontal form-simple" action="{{ route('login') }}" method="post" novalidate>
                                        {{ csrf_field() }}
                                        <fieldset class="form-group position-relative has-icon-left mb-0">
                                            <input type="text" name="name" class="form-control form-control-lg" id="user-name" placeholder="E-mail адрес" value="{{old('name')}}" required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password" value="{{old('password')}}" class="form-control form-control-lg" id="user-password" placeholder="Пароль" required>
                                            <div class="form-control-position">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">

                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Вход</button>
                                        <a href="{{route('register')}}" class="btn btn-primary btn-lg btn-block"><i class="ft-edit"></i> Регистрация</a>
                                        <div class="mb-1 text-center" style="padding: 20px 0 0 0;">
                                            <a href="{{route('password.request')}}">Забыли пароль?</a>
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
</div>
@endsection

@section('script')
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app.js"></script>
@endsection
