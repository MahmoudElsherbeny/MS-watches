<!--  start header  -->
<header id="header" class="htc-header header--3 bg__white">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-7">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <span class="logo1">{{ App\Setting::getSettingValue('name') }}</span><span class="logo2">Watches</span>
                        </a>
                    </div>
                </div>
                <!-- Start MAinmenu Ares -->
                <div class="col-md-8 col-lg-8 hidden-sm hidden-xs">
                    <nav class="mainmenu__nav hidden-xs hidden-sm">
                        <ul class="main__menu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="drop"><a href="">Categories</a>
                                <ul class="dropdown">
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('category_page', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="{{ route('aboutus') }}">About Us</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="{{ route('wishlist.index') }}">Whishlist</a></li>
                        </ul>
                    </nav>
                    <div class="mobile-menu clearfix visible-xs visible-sm">
                        <nav id="mobile_dropdown">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>
                                    <a href="">Categories</a>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('category_page', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('aboutus') }}">About Us</a> </li>
                                <li><a href="{{ route('contact.index') }}">Contact Us</a> </li>
                                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a href="{{ route('wishlist.index') }}">Whishlist</a></li>                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End MAinmenu Ares -->
                <div class="col-md-2 col-sm-6 col-xs-5">
                    <ul class="menu-extra">
                        <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                        <li class="drop">
                            @if(Auth::check())
                                <a href="#"><span class="ti-user"></span></a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('UserProfile.profile', ['id' => Auth::user()->id, 'name' => Auth::user()->name]) }}">{{ Auth::user()->name }}</a></li>
                                    <li><a href="{{ route('UserProfile.edit', ['id' => Auth::user()->id, 'name' => Auth::user()->name]) }}">Edit Profile</a></li>
                                    <li><a href="{{ route('UserProfile.change_password', ['id' => Auth::user()->id, 'name' => Auth::user()->name]) }}">Change Password</a></li>
                                    <li><a href="{{ route('UserProfile.orders', ['id' => Auth::user()->id, 'name' => Auth::user()->name]) }}">Orders</a></li>
                                    <li><a href="">Favorite Products</a></li>
                                    <li>
                                        {!! Form::Open(['url' => route('logout')]) !!}
                                            <button type="submit" class="btn">Logout</button>
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            @else
                                <a href="{{ route('login') }}"><span class="ti-user"></span></a>
                            @endif
                        </li>
                        <li class="cart__menu">
                            <span class="ti-shopping-cart"></span>
                            @livewire('frontend.cart.counter')
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
                        {{ App\Setting::getSettingValue("name") }} Watches
                    </a>
                </div>
                <p>{{ App\Setting::getSettingValue('about') }}</p>
            </div>
            <ul class="sidebar__thumd">
                @foreach ($brands as $brand)
                    <li>
                        <a href="{{ $brand->link }}" target="_blank">
                            <img src="{{ asset('storage/' . $brand->image) }}" title="{{ $brand->name }}" alt="brand images">
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="offset__sosial__share">
                <h4 class="offset__title">Follow Us On Social</h4>
                <ul class="off__soaial__link">
                    <li><a class="bg--facebook" href="{{ App\Setting::getSettingValue('facebook') }}" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                    <li><a class="bg--twitter" href="{{ App\Setting::getSettingValue('twitter') }}" target="_blank" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                    <li><a class="bg--instagram" href="{{ App\Setting::getSettingValue('instagram') }}" target="_blank" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Offset MEnu -->

    <!-- Start Cart Panel -->
    @livewire('frontend.cart.sidemenu')
    <!-- End Cart Panel -->

</div>
<!-- End Offset Wrapper -->