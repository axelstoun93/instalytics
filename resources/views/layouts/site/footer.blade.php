<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-ribbon">
                <span>Get in Touch</span>
            </div>
            <div class="col-xs-12  col-sm-6 col-md-4">
                <div class="newsletter">
                    <h4>Мы обеспечим доступ к информации</h4>
                    <p>Невозможно собрать всю информацию, необходимую, чтобы принять решение. Если вся информация у вас на руках, это уже не решение, а заключение, сделанное задним числом.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <h4>DATALYTICS</h4>
                <div>
                    <ul class="contact">
                        <li><a href="/project">О проекте</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6  col-md-3">
                <div class="contact-details">
                    <h4>Информация</h4>
                    <ul class="contact">
                        <li><a href="/agreement">Пользовательское соглашение</a></li>
                        <li><a href="/confidentiality">Политика конфиденциальности</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <h4>Техподдержка</h4>
                <ul class="contact">
                    <li><a href="mailto:support@datalytics.pro">support@datalytics.pro</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="/" class="logo">
                        <img alt="DATALYTICS" class="img-responsive" src="{{asset(config('setting.theme'))}}/img/logo-footer.png">
                    </a>
                </div>
                <div class="col-md-4">
                    <p>© Copyright 2019. All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                    @if(!empty($menu))
                    <nav id="sub-menu">
                        <ul>
                            @foreach($menu->roots() as $item)
                            <li><a href="{{$item->url()}}">{{$item->title}}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
