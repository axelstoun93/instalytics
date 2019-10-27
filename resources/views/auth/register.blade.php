@extends('layouts.page_login')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body register"><section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1"><a href="{{route('site')}}"><img src="{{asset(config('setting.theme-admin'))}}/app-assets/images/logo/stack-logo-dark.png" alt="branding logo"></a></div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Register with Datalytics</span></h6>
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
                                            <div class="alert bg-info alert-info mb-2" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                             Мы не используем ваши данные для входа в инстаграм аккаунт. Данные статистики собираются без доступа к вашему аккаунту.
                                            </div>
                                        <form id="registerForm" class="form-horizontal form-simple" action="{{ route('register') }}" method="post">
                                            {{ csrf_field() }}
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" name="email" class="form-control form-control-lg" id="user-email" placeholder="Ваш E-mail адрес" value="{{old('email')}}" required>
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" name="instagram_login" class="form-control form-control-lg" id="user-instagram-login" placeholder="Логин инстаграм аккаунта" value="{{old('email')}}" required>
                                                <div class="form-control-position">
                                                    <i class="ft-instagram"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="password" name="password" value="{{old('password')}}" class="form-control form-control-lg" id="user-password" placeholder="Придумайте пароль" required>
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left" style="margin-top: -10px;">
                                                <input type="password" name="password_two" value="{{old('password_two')}}" class="form-control form-control-lg" id="user-password-two" placeholder="Повторите пароль" required>
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>

                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-edit"></i> Регистрация</button>
                                            <a href="{{route('login')}}" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Вход</a>
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
<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/all/clipboard.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/core/app-menu.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/extensions/toastr.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/js/scripts/modal/components-modal.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>

<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/all/jquery.mask.min.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/app-assets/vendors/js/charts/echarts/echarts.js"></script>
<script src="{{asset(config('setting.theme-admin'))}}/assets/js/custom/client/register.js"></script>
@endsection
