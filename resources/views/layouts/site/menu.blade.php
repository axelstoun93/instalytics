<header id="header" class="header-narrow">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-logo">
                        <a href="/">
                            <img alt="DATALYTICS"  height="35" src="{{asset(config('setting.theme'))}}/img/logo.png">
                        </a>
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-nav">
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                                <nav>
                                    <ul class="nav nav-pills" id="mainNav">
                                        @if($menu)
                                            @include('layouts.site.customMenu',['items' => $menu->roots()])
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
