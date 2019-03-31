<div class="collapse navbar-collapse" id="navbar-mobile">
    <ul class="nav navbar-nav mr-auto float-left">

    </ul>
    <ul class="nav navbar-nav float-right">
        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle dropdown-toggle-no-arrow nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-ru"></i></a>

        </li>


        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle dropdown-toggle-arrow nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="avatar avatar-online"><img src="{{asset(config('setting.theme-admin'))}}/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name">{{$userInfo->name}}</span></a>
            <div class="dropdown-menu dropdown-menu-right">
                     <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i> Выход</a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">

                {{ csrf_field() }}

            </form>
        </li>
    </ul>
</div>