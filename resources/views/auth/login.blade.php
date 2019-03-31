@extends('layouts.page_login')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <div class="p-1"><img src="{{asset(config('setting.theme-admin'))}}/app-assets/images/logo/stack-logo-dark.png" alt="branding logo"></div>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login with Stack</span></h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @if(!empty($errors->has('name')) || !empty($errors->has('password')))
                                        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            {{(!empty($errors->has('name'))) ? $errors->first('name') : $errors->first('password')}}
                                        </div>
                                    @endif

                                    <form class="form-horizontal form-simple" action="{{ route('login') }}" method="post" novalidate>
                                        {{ csrf_field() }}
                                        <fieldset class="form-group position-relative has-icon-left mb-0">
                                            <input type="text" name="name" class="form-control form-control-lg" id="user-name" placeholder="Логин" value="{{old('name')}}" required>
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
