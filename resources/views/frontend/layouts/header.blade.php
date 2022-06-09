<!--  start header  -->
<header id="header" class="htc-header header--3 bg__white">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <span class="logo1">{{ App\Setting::getSettingValue('name') }}</span><span class="logo2">Watches</span>
                        </a>
                    </div>
                </div>
                <!-- Start MAinmenu Ares -->
                <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                    <nav class="mainmenu__nav hidden-xs hidden-sm">
                        <ul class="main__menu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="{{ route('aboutus') }}">About Us</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="{{ route('wishlist.index') }}">Whishlist</a></li>
                            <li class="drop"><a href="#">pages</a>
                                <ul class="dropdown">
                                    <li><a href="cart.html">cart</a></li>
                                    <li><a href="wishlist.html">wishlist</a></li>
                                    <li><a href="checkout.html">checkout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="mobile-menu clearfix visible-xs visible-sm">
                        <nav id="mobile_dropdown">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('aboutus') }}">About Us</a> </li>
                                <li><a href="{{ route('contact.index') }}">Contact Us</a> </li>
                                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a href="{{ route('wishlist.index') }}">Whishlist</a></li>
                                <li>
                                    <a href="#">pages</a>
                                    <ul>
                                        <li><a href="cart.html">cart</a></li>
                                        <li><a href="wishlist.html">wishlist</a></li>
                                        <li><a href="checkout.html">checkout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End MAinmenu Ares -->
                <div class="col-md-2 col-sm-4 col-xs-3">
                    <ul class="menu-extra">
                        <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                        <li>
                            @if(Auth::check())
                                {!! Form::Open(['url' => route('logout')]) !!}
                                    <button type="submit" class="btn"><span class="ti-user"></span></button>
                                {!! Form::close() !!}
                            @else
                                <a href="{{ route('login') }}"><span class="ti-user"></span></a>
                            @endif
                        </li>
                        <li class="cart__menu">
                            <span class="ti-shopping-cart"></span>
                            @if (Cart::instance('cart')->count() > 0)
                                <span class="badge badge-light">{{ Cart::instance('cart')->content()->count() }}</span>
                            @endif
                        </li>
                        <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li>
                    </ul>
                </div>
            </div>
            <div class="mobile-menu-area"></div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
<!--  end header  -->

<div class="body__overlay"></div>

<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
    <!-- Start Search Popap -->
    <div class="search__area">
        <div class="container" >
            <div class="row" >
                <div class="col-md-12" >
                    <div class="search__inner">
                        {!! Form::open(['url' => route('shop'), 'method' => 'get']) !!}
                            <input type="text" name="site_search" placeholder="Search here... ">
                            <button type="submit"></button>
                        {!! Form::close() !!}
                        <div class="search__close__btn">
                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Popap -->
    <!-- Start Offset MEnu -->
    <div class="offsetmenu">
        <div class="offsetmenu__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="off__contact">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        MS Watches
                    </a>
                </div>
                <p>Lorem ipsum dolor sit amet consectetu adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
            </div>
            <ul class="sidebar__thumd">
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/1.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/2.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/3.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/4.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/5.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/6.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/7.jpg') }}" alt="sidebar images"></a></li>
                <li><a href="#"><img src="{{ url('frontend/images/sidebar-img/8.jpg') }}" alt="sidebar images"></a></li>
            </ul>
            <div class="offset__widget">
                <div class="offset__single">
                    <h4 class="offset__title">Language</h4>
                    <ul>
                        <li><a href="#"> Engish </a></li>
                        <li><a href="#"> French </a></li>
                        <li><a href="#"> German </a></li>
                    </ul>
                </div>
                <div class="offset__single">
                    <h4 class="offset__title">Currencies</h4>
                    <ul>
                        <li><a href="#"> USD : Dollar </a></li>
                        <li><a href="#"> EUR : Euro </a></li>
                        <li><a href="#"> POU : Pound </a></li>
                    </ul>
                </div>
            </div>
            <div class="offset__sosial__share">
                <h4 class="offset__title">Follow Us On Social</h4>
                <ul class="off__soaial__link">
                    <li><a class="bg--twitter" href="#"  title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>

                    <li><a class="bg--instagram" href="#" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                    <li><a class="bg--facebook" href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                    <li><a class="bg--googleplus" href="#" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                    <li><a class="bg--google" href="#" title="Google"><i class="zmdi zmdi-google"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Offset MEnu -->

    <!-- Start Cart Panel -->
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>

            @if(Cart::instance('cart')->count() > 0)
                <div class="shp__cart__wrap">

                    @foreach (Cart::instance('cart')->content() as $key => $prod)
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="{{ url('frontend/images/product/sm-img/1.jpg') }}" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2>
                                    <a href="{{ route('product_detailes', ['id' => $prod->id]) }}">{{ $prod->name }}</a>
                                </h2>
                                <span class="quantity">QTY: {{ $prod->qty }}</span>
                                <span class="shp__price">£{{ $prod->price/100 }}</span>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <ul class="shoping__total">
                    <li class="subtotal">Subtotal:</li>
                    <li class="total__price">£{{ Cart::instance('cart')->subtotal() }}</li>
                </ul>
                <ul class="shopping__btn">
                    <li><a href="{{ route('cart.index') }}" class="ms-btn transparent-btn">View Cart</a></li>
                    <li class="shp__checkout"><a href="{{ route('cart.checkout_page') }}" class="ms-btn black-btn">Checkout</a></li>
                </ul>
            @else
                <div class="shp__cart__wrap">
                        <div class="cart__empty__details">
                            <p>your cart is empty <br>start shopping now !</p>
                            @if(!Auth::check())
                                <span>create account <a href="{{ route('register') }}">SIGNUP</a> OR <a href="{{ route('login') }}">LOGIN</a></span>
                            @endif
                        </div>
                </div>
                <ul class="shopping__btn">
                    <li><a href="{{ route('shop') }}" class="ms-btn black-btn">shop</a></li>
                </ul>
            @endif
        </div>
    </div>
    <!-- End Cart Panel -->

</div>
<!-- End Offset Wrapper -->
