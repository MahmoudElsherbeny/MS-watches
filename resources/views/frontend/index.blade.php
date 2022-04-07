@extends('frontend.layouts.app')
@section('title') {{ App\Setting::getSettingValue('name') }} Watches @endsection

@section('content')

<!-- Start Feature Product -->
<section class="categories-slider-area bg__white pb--90">
    <div class="container">
        <div class="row">
            <!-- Start Left Feature -->
            <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                <!-- Start Slider Area -->
                <div class="slider__container slider--one">
                    <div class="slider__activation__wrap owl-carousel owl-theme">

                        @foreach ($slides as $slide)
                            <!-- Start Single Slide -->
                            <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: url('storage/slides/{{ $slide->image }}') no-repeat scroll center center / cover ;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-9 col-md-offset-2 col-lg-offset-3 col-sm-12 col-xs-12">
                                            <div class="slider__inner">
                                                <h1>{{ $slide->title }} <span class="text--theme">{{ $slide->sub_title }}</span></h1>
                                                <div class="slider__btn">
                                                    <a class="htc__btn" href="#">shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slide -->
                        @endforeach

                    </div>
                </div>
                <!-- End Slider Area -->
            </div>
            <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                <div class="categories-menu mrg-xs">
                    <div class="category-heading">
                        <h3> Browse Categories</h3>
                    </div>
                    <div class="category-menu-list">
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#">
                                        <span class="cat-icon"><i class="{{ $category->icon }}"></i></span> {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Left Feature -->
        </div>
    </div>
</section>
<!-- End Feature Product -->

<!-- Start Our Product Area Top Rated -->
<section class="htc__product__area bg__white">
    <div class="container">
        <div class="product-style-tab">
            <div class="product-tab-list">
                <a href="#TopRated" class="active"> top rated </a>
            </div>
            <div class="tab-content another-product-style jump">
                <div class="tab-pane active" id="TopRated">
                    <div class="row">
                        <div class="product-slider-active owl-carousel">

                        <!--   top rated products   -->
                        @include('frontend.product.card', ['products' => $toprate])

                        </div>
                    </div>
                </div>
            </div>

            <!--   overview of top rated products   -->
            @include('frontend.product.quickview', ['products' => $toprate])

        </div>
    </div>
</section>
<!-- End Our Product Area Top Rated -->
<div class="only-banner ptb--90 bg__white">
    <div class="container">
        <div class="only-banner-img">
            <a href="shop-sidebar.html"><img src="{{ url('frontend/images/new-product/6.jpg') }}" alt="new product"></a>
        </div>
    </div>
</div>
<!-- Start Our Product Area Best Sale -->
<section class="htc__product__area bg__white">
    <div class="container">
        <div class="product-style-tab">
            <div class="product-tab-list">
                <a href="#BestSale" class="active"> best sale </a>
            </div>
            <div class="tab-content another-product-style jump">
                <div class="tab-pane active" id="BestSale">
                    <div class="row">
                        <div class="product-slider-active owl-carousel">

                        <!--   best sale products   -->
                        @include('frontend.product.card', ['products' => App\Product::getSaleProducts('>','sale',15)])

                        </div>
                    </div>
                </div>
            </div>

            <!--   overview of best sale products   -->
            @include('frontend.product.quickview', ['products' => App\Product::getSaleProducts('>','sale',15)])

        </div>
    </div>
</section>
<!-- End Our Product Area Best Sale -->
<div class="only-banner ptb--90 bg__white">
    <div class="container">
        <div class="only-banner-img">
            <a href="shop-sidebar.html"><img src="{{ url('frontend/images/new-product/7.jpg') }}" alt="new product"></a>
        </div>
    </div>
</div>
<!-- Start Our Product Area On Sale -->
<section class="htc__product__area bg__white">
    <div class="container">
        <div class="product-style-tab">
            <div class="product-tab-list">
                <a href="#OnSale" class="active"> on sale </a>
            </div>
            <div class="tab-content another-product-style jump">
                <div class="tab-pane active" id="OnSale">
                    <div class="row">
                        <div class="product-slider-active owl-carousel">

                        <!--   on sale products   -->
                        @include('frontend.product.card', ['products' => App\Product::getSaleProducts('>','updated_at',15)])

                        </div>
                    </div>
                </div>
            </div>

            <!--  quickview of on sale products   -->
            @include('frontend.product.quickview', ['products' => App\Product::getSaleProducts('>','updated_at',15)])

        </div>
    </div>
</section>
<!-- End Our Product Area On Sale -->
<div class="only-banner ptb--90 bg__white">
    <div class="container">
        <div class="only-banner-img">
            <a href="shop-sidebar.html"><img src="{{ url('frontend/images/new-product/7.jpg') }}" alt="new product"></a>
        </div>
    </div>
</div>
<!-- Start Our Product Area Latest -->
<section class="htc__product__area pb--90 bg__white">
    <div class="container">
        <div class="product-style-tab">
            <div class="product-tab-list">
                <a href="#Latest" class="active"> latest </a>
            </div>
            <div class="tab-content another-product-style jump">
                <div class="tab-pane active" id="Latest">
                    <div class="row">
                        <div class="product-slider-active owl-carousel">

                        <!--   latest products   -->
                        @include('frontend.product.card', ['products' => App\Product::getSaleProducts('<=','id',15)])

                        </div>
                    </div>
                </div>

                <!--   quickview of latest products   -->
                @include('frontend.product.quickview', ['products' => App\Product::getSaleProducts('<=','id',15)])

            </div>
        </div>
    </div>
</section>
<!-- End Our Product Area Latest -->
<!-- Start Blog Area -->
<section class="htc__blog__area bg__white pb--80">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="htc__loadmore__btn text-center">
                    <a href="{{ route('shop') }}" class="ms-btn black-btn load_products">Show All Products</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection