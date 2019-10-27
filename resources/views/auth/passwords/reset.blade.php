@extends('layouts.page_login')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{asset(config('setting.theme-admin'))}}/app-assets/images/logo/stack-logo-dark.png" alt="logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>We will reset your password.</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        @if ($errors->has('email'))
                                            <div class="alert alert-warning" role="alert">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                            @if ($errors->has('password'))
                                                <div class="alert alert-warning" role="alert">
                                                 {{ $errors->first('password') }}
                                                </div>
                                            @endif

                                        <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                            {{ csrf_field() }}
                                             <input type="hidden" name="token" value="{{ $token }}">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="email" name="email" class="form-control form-control-lg" id="user-email" placeholder="Укажите свой E-mail адрес" required>
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" class="form-control form-control-lg" id="user-password" placeholder="Укажите новый пароль!" required>
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password_confirmation" class="form-control form-control-lg" id="user-password-confirm" placeholder="Повторите пароль!" required>
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-outline-primary btn-lg btn-block"><i class="ft-edit"></i>  Установить новый пароль</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer border-0 text-center">
                                    <p class="float-sm-left text-center"><a href="{{route('login')}}" class="card-link">Вход</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
