@extends('layouts.site.page')
@section('menu')
    {!! $menu !!}
@endsection
@section('content')
    <div role="main" class="main">
        <div class="slider-container rev_slider_wrapper" style="height: 677px;">
            <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 800, 'gridheight': 677}">
                <ul>
                    <li data-transition="fade">
                        <img src="{{asset(config('setting.theme'))}}/img/slides/slide-1.jpg"
                             alt=""
                             data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat"
                             data-bgparallax="1"
                             class="rev-slidebg">

                        <h1 class="tp-caption custom-secondary-font font-weight-bold text-color-light banner-title"
                            data-x="['center','center','center','center']" data-hoffset="['30','30','30','30']"
                            data-y="center" data-voffset="['-120','-120','-120','-40']"
                            data-start="800"
                            data-transform_in="y:[-300%];opacity:0;s:500;">DATALYTICS</h1>

                        <div class="tp-caption custom-secondary-font font-weight-bold text-color-light banner-text"
                             data-x="['center','center','center','center']" data-hoffset="['30','30','30','30']"
                             data-y="center" data-voffset="['-20','-20','-20','2']"
                             data-start="800"
                             data-transform_in="y:[-300%];opacity:0;s:500;">Сервис для оценки эффективности рекламы, <br>проверки аудитории на ботов и массфоловеров,<br> детальной статистики притоков и оттоков<br> аудитории Instagram аккаунта </div>

                        <a href="{{route('register')}}" class="btn btn-primary tp-caption text-uppercase text-color-light custom-border-radius banner-btn"
                           data-hash-offset="85"
                           data-x="['center','center','center','center']" data-hoffset="['30','30','30','30']"
                           data-y="center" data-voffset="['90','90','90','100']"
                           data-start="1500"
                           style="padding: 15px 6px;"
                           data-transform_in="y:[-300%];opacity:0;s:500;">ПОПРОБОВАТЬ БЕСПЛАТНО</a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="home-intro " id="home-intro">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            DATALYTICS
                            <span>
                                Попробуйте наш сервис в течение тестовых 5 дней. Оцените притоки и оттоки на аккаунте, кто подписывается и отписывается от вас. Datalytics – идеальный инструмент для оценки эффективности рекламы.
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="get-started">
                            <a href="/register" class="btn btn-lg btn-primary">ПОПРОБОВАТЬ БЕСПЛАТНО</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
        <div class="container">
            <div class="row mb-xl">
                <div class="col-md-12 center">
                    <h2>Почему вам необходим Datalytics?</h2>
                </div>
                <div class="col-md-6">
                    <p class="content-text">Наш сервис уникален. Наш сервис не требует от вас вводить пароль от своего аккаунта. Ваши данные защищены. Мы собираем статистику без доступа к аккаунту. Это дает вам возможность безопасно проанализировать свой аккаунт или аккаунт блогера, который предложил вам рекламу. Теперь вы можете проанализировать аудиторию на ботов и сделать выводы. Мы разработали собственный алгоритм, который может определять ботов и массфоловеров на аккаунтах по поведенческому фактору. Мы понимаем, что не каждый массфоловер является ботом, поэтому выводим их в отдельную категорию. Боты – пользователи, зарегистрированные автоматическим путем, которые не смотрят ленту новостей, не заходят в свой аккаунт.  </p>
                </div>
                <div class="col-md-6">
                   <p class="content-text">Знакома ли вам ситуация, когда запускаете рекламу, а результат вам непонятен или его нет? Реклама идет, а цифра подписчиков стоит на месте? Дело в рекламе или в том, что у вас просто есть отток подписчиков на аккаунте? Datalytics покажет притоки и оттоки на вашем аккаунте, а также предоставит вам конкретные списки тех, кто отписался и отписался от вас. Вы сможете оценить эффективность рекламы по списку подписавшихся и оценить свой контент-менеджмент по списку отписавшихся. Вы увидите, кто эти люди и откуда они. Наш инструмент сэкономит вам массу времени, денег и нервов.</p>
                </div>
            </div>

            <div class="row mb-xl">
                <div class="col-md-12 center">
                    <h2>5 ДНЕЙ БЕСПЛАТНОГО ДОСТУПА</h2>
                </div>
                <div class="col-md-12 center">
                    <p class="content-text">Мы уверены в своем сервисе и дарим вам 5 дней бесплатного доступа сразу после регистрации. Регистрация займет всего 5 минут и сервис начнет собирать данные по instagram аккаунту. Вы увидите детальную статистику за 5 дней и уже не захотите с нами расставаться. Попробуйте! Оно того стоит!</p>
                </div>
            </div>

        </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row center mb-md">
                    <div class="col-md-12">
                        <h2 class="custom-bar _center text-color-dark ">НАШИ ПРЕИМУЩЕСТВА</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                        <div class="feature-box feature-box-style-3 reverse custom-feature-box-style-1">
                            <div class="feature-box-icon">
                                <i class="fa fa-shield"></i>
                            </div>
                            <div class="feature-box-info font-size-sm">
                                <h4 class="text-color-dark pt-xs">Полная безопасность вашего instagram-профиля</h4>
                                <p class="mb-lg">Нам не нужны данные для входа в ваш instagram аккаунт, система собирает данные без входа в ваш instagram аккаунт</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                        <div class="feature-box feature-box-style-3 custom-feature-box-style-1">
                            <div class="feature-box-icon">
                                <i class="fa fa-user-times"></i>
                            </div>
                            <div class="feature-box-info font-size-sm">
                                <h4 class="text-color-dark pt-xs">Проверка аудитории на наличие ботов</h4>
                                <p class="mb-lg">Наш сервис может проверить аудиторию вашего или чужого аккаунта на наличие ботов и массфоловеров. Мы разработали собственный алгоритм, определяющий ботов по поведенческому фактору в инстаграм. Вы будете знать точный процент живой аудитории. Теперь маркетологи и блогеры не смогут вас обмануть! Сейчас эта опция доступна для аккаунтов с аудиторией до 30.000 подписчиков. В будущем мы расширим до 100.000.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                        <div class="feature-box feature-box-style-3 reverse custom-feature-box-style-1">
                            <div class="feature-box-icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <div class="feature-box-info font-size-sm">
                                <h4 class="text-color-dark pt-xs">
                                    Сбор статистики по любому аккаунту
                                </h4>
                                <p class="mb-lg">
                                    Вы можете проверить аудиторию и получить статистику вашего и любого другого аккаунта (например, блогера). Сервис не подключается к аккаунту и собирает данные автономно.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                        <div class="feature-box feature-box-style-3 custom-feature-box-style-1">
                            <div class="feature-box-icon">
                                <i class="fa fa-gear"></i>
                            </div>
                            <div class="feature-box-info font-size-sm">
                                <h4 class="text-color-dark pt-xs">Детальный контроль подписчиков</h4>
                                <p class="mb-lg">Идеальный инструмент для оценки эффективности рекламы, проверки аккаунтов которые на вас подписываются и отписываются каждый день. Мы предоставим вам списки подписавшихся и отписавшихся по каждому дню. Эти данные помогут вам проанализировать эффективность рекламы и своей активности.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                        <div class="feature-box feature-box-style-3 reverse custom-feature-box-style-1">
                            <div class="feature-box-icon">
                                <i class="fa fa-ruble"></i>
                            </div>
                            <div class="feature-box-info font-size-sm">
                                <h4 class="text-color-dark pt-xs">Низкая стоимость</h4>
                                <p class="mb-lg">Стоимость нашего сервиса после бесплатного тестового периода составляет всего 500 руб. в месяц</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                        <div class="feature-box feature-box-style-3 custom-feature-box-style-1">
                            <div class="feature-box-icon">
                                <i class="fa fa-database"></i>
                            </div>
                            <div class="feature-box-info font-size-sm">
                                <h4 class="text-color-dark pt-xs">Быстрый алгоритм получения данных</h4>
                                <p class="mb-lg">Сервис получает данные в течение 24 часов. Вы увидите статистику уже на 2-3 день работы и сможете проанализировать аудиторию. Аудитория будет обновляться каждый последующий день. Наш сервис доступен онлайн, а это значит, что вам не нужно устанавливать программу на компьютер. Вы можете зайти в сервис с любого устройства</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <div class="container-fluid">
            <div class="col-12 p-none">
                <section>
                    <div class="row">
                        <div class="col-half-section">
                            <h2 class="heading-dark align-center">КАК ЭТО РАБОТАЕТ ?</h2>
                            <div class="content-grid content-grid-dashed mt-xlg mb-lg four-block-footer lightbox"  data-plugin-options="{'delegate': 'a.lightbox-jobs', 'type': 'image', 'gallery': {'enabled': true}}">
                                <div class="row content-grid-row">
                                    <div class="content-grid-item col-md-6 center">
                                        <p>
                                            Зарегистрируйтесь в сервисе datalytics, при регистрации укажите тот instagram аккаунт по которому хотите получать данные.
                                        </p>
                                        <a href="{{asset(config('setting.theme'))}}/img/register.jpg" class="lightbox-jobs">
                                        <img class="img-responsive" src="{{asset(config('setting.theme'))}}/img/register.jpg" data-action="zoom" style="z-index: 10000;">
                                        </a>
                                    </div>
                                    <div class="content-grid-item col-md-6 center">
                                        <p>Подождите 48 часов, система соберет все возможные данные по instagram аккаунту и будет собирать их каждый последующий день.</p>
                                        <a href="{{asset(config('setting.theme'))}}/img/clock.jpg" class="lightbox-jobs">
                                        <img class="img-responsive" src="{{asset(config('setting.theme'))}}/img/clock.jpg">
                                        </a>
                                    </div>
                                </div>
                                <div class="row content-grid-row">
                                    <div class="content-grid-item col-md-6 center">
                                        <p>Войдите в систему используя те данные которые вы указали при регистрации.</p>
                                        <a href="{{asset(config('setting.theme'))}}/img/signup.jpg" class="lightbox-jobs">
                                        <img class="img-responsive" src="{{asset(config('setting.theme'))}}/img/signup.jpg">
                                        </a>
                                    </div>
                                    <div class="content-grid-item col-md-6 center">
                                        <p>Анализируйте и делайте выводы на основе полученных данных.</p>
                                        <a href="{{asset(config('setting.theme'))}}/img/result.jpg" class="lightbox-jobs">
                                        <img class="img-responsive" src="{{asset(config('setting.theme'))}}/img/result.jpg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>
        <section class="call-to-action call-to-action-default with-button-arrow call-to-action-in-footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="call-to-action-content" style="padding-top: 0;">
                            <h3>DATALYTICS – Честный сервис статистики</h3>
                        </div>
                        <div class="call-to-action-btn">
                            <a href="{{route('register')}}" target="_blank" class="btn btn-lg btn-primary">ПОПРОБОВАТЬ БЕСПЛАТНО</a><span class="arrow hlb hidden-xs hidden-sm hidden-md" data-appear-animation="rotateInUpLeft" style="top: -12px;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footer')
    {!! $footer !!}
@endsection
