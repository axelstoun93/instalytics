<div class="content-wrapper">
    <section id="image-grid" class="card">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-square-controls">Оплата</h4>
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
                        <h3>Инструкция</h3>
                        <div style="font-size: 18px">
                            Сумма ежемесячного платежа составляет 500 рублей, после оплаты доступ предоставляется в течение 24 часов.
                            <br><br>
                            Ваш e-mail адрес который нужно указать при переводе - <strong>{{(!empty($client->email)) ? $client->email : 'В профиле не заполнено поле E-mail' }}</strong>
                            <br><br>
                            Как осуществить оплату сервиса?
                            <ul class="list-unstyled" style="font-size: 18px">
                                <li>1) Нажмите на кнопку "Перейти к оплате"</li>
                                <li>2) Важно: В открывшейся форме заполните все поля. В поле "комментарий" нужно вписать ваш email от учетной записи, которой нужно предоставить доступ. Мы получим этот комментарий и предоставим этому email доступ. После продления, вы увидите что счетчик оставшихся дней обновился в течение 10 часов.</li>
                                <li>3) Убедитесь в том что платеж прошел успешно! Если платежная форма выдала ошибку, необходимо повторить платеж.</li>
                            </ul>
                            <br>
                            Методы оплаты:
                            Вы можете оплатить работу сервиса любой банковской картой или яндекс деньгами. При оплате выберите нужное: "оплата из яндекс кошелька" или "банковской картой".
                            <br><br>
                        </div>


                        @if($payStatus)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card" style="text-align: center;padding: 20px 20px 0 20px">
                                        <div class="alert bg-info alert-info mb-2" role="alert">
                                        Оплата прошла успешно, доступы вашему аккаунту будут предоставлены в течение 24 часов.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="masonry-grid my-gallery mx-2" itemscope itemtype="http://schema.org/ImageGallery">
                            <!-- width of .grid-sizer used for columnWidth -->
                            <div class="grid-sizer"></div>
                            <div class="grid-item">
                                <figure class="card" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                    <a href="{{asset(config('setting.theme-admin'))}}/images/help-pay.jpg" itemprop="contentUrl" data-size="1024x576">
                                        <img class="img-thumbnail" src="{{asset(config('setting.theme-admin'))}}/images/help-pay.jpg" itemprop="thumbnail" alt="Image description" />
                                    </a>
                                </figure>
                            </div>
                            <div class="grid-item">
                                <figure class="card" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                    <a href="{{asset(config('setting.theme-admin'))}}/images/help-pay-2.jpg" itemprop="contentUrl" data-size="1024x576">
                                        <img class="img-thumbnail" src="{{asset(config('setting.theme-admin'))}}/images/help-pay-2.jpg" itemprop="thumbnail" alt="Image description" />
                                    </a>
                                </figure>
                            </div>
                            <div class="grid-item">
                                <figure class="card" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                    <a href="{{asset(config('setting.theme-admin'))}}/images/help-pay-3.jpg" itemprop="contentUrl" data-size="1024x576">
                                        <img class="img-thumbnail" src="{{asset(config('setting.theme-admin'))}}/images/help-pay-3.jpg" itemprop="thumbnail" alt="Image description" />
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-actions text-center">
                    <a href="https://money.yandex.ru/to/4100110634085823" target="_blank" class="btn btn-primary">
                        <i class="fa fa-credit-card"></i> Перейти к оплате
                    </a>
                </div>
            </div>
        </div>
    </section>



    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- Background of PhotoSwipe.
               It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>
        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">
            <!-- Container that holds slides.
                  PhotoSwipe keeps only 3 of them in the DOM to save memory.
                  Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <!--  Controls are self-explanatory. Order can be changed. -->
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader-active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>
</div>
