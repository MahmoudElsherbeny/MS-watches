<!--  footer  -->
<div class="row">
    <div class="footer__container clearfix">
            <!-- Start Single Footer Widget -->
        <div class="col-md-3 col-sm-6">
            <div class="ft__widget">
                <div class="ft__logo">
                    <a href="{{ route('home') }}">
                        <span class="logo1">{{ App\Setting::getSettingValue('name') }}</span><span class="logo2">Watches</span>
                    </a>
                </div>
                <div class="footer-address">
                    <ul>
                        <li>
                            <div class="address-icon" style="width: 25px">
                                <i class="zmdi zmdi-pin"></i>
                            </div>
                            <div class="address-text">
                                <p>{{ App\Setting::getSettingValue('address') }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="address-icon">
                                <i class="zmdi zmdi-email"></i>
                            </div>
                            <div class="address-text">
                                <a href="{{ route('contact.index') }}">{{ App\Setting::getSettingValue('email') }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="address-icon">
                                <i class="zmdi zmdi-phone-in-talk"></i>
                            </div>
                            <div class="address-text">
                                <p>+{{ App\Setting::getSettingValue('phone') }} </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="social__icon">
                    <li><a href="{{ App\Setting::getSettingValue('facebook') }}" target="_blank" class="facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                    <li><a href="{{ App\Setting::getSettingValue('twitter') }}" target="_blank" class="twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                    <li><a href="{{ App\Setting::getSettingValue('instagram') }}" target="_blank" class="instagram"><i class="zmdi zmdi-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- End Single Footer Widget -->
        <!-- Start Single Footer Widget -->
        <div class="col-md-4 col-sm-6 smt-30 xmt-30">
            <div class="ft__widget">
                <h2 class="ft__title">Categories</h2>
                <div class="row">
                @foreach ($categories->split($categories->count()/5) as $row)
                    <ul class="footer-categories col-md-5 col-sm-6 col-xs-6">
                        @foreach ($row as $category)
                            <li><a href="{{ route('category_page', ['id' => $category->id]) }}" class="text-capitalize">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                @endforeach
                </div>
            </div>
        </div>
        <!-- Start Single Footer Widget -->
        <div class="col-md-2 col-sm-6 smt-30 xmt-30 ml--30">
            <div class="ft__widget">
                <h2 class="ft__title">Infomation</h2>
                <ul class="footer-categories">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>
                </ul>
            </div>
        </div>
        <!-- Start Single Footer Widget -->
        <div class="col-md-3 col-sm-6 smt-30 xmt-30">
            <div class="ft__widget">
                <h2 class="ft__title">Newsletter</h2>
                <div class="newsletter__form">
                    <p>Subscribe to our newsletter and get 10% off your first purchase .</p>
                    <div class="input__box">
                        <div id="mc_embed_signup">
                            <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                    <div class="news__input">
                                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
                                    </div>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                    <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Footer Widget -->
    </div>
</div>
