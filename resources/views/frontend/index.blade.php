@extends('frontend.layouts.app')
@section('title') {{ App\Setting::getSettingValue('name') }} Watches @endsection

@section('content')

<!-- Start Feature Product -->
<section class="categories-slider-area bg__white mb--80">
    <div class="container">
        <div class="row">
            <!-- Start Left Feature -->
            <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                <!-- Start Slider Area -->
                <div class="slider__container slider--one">
                    <div class="slider__activation__wrap owl-carousel owl-theme">

                        @foreach ($slides as $slide)
                            <!-- Start Single Slide -->
                            <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: url('{{ asset('storage/'.$slide->image) }}') no-repeat scroll center center / cover ;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-9 col-md-offset-2 col-lg-offset-3 col-sm-12 col-xs-12">
                                            <div class="slider__inner">
                                                <h1>{{ $slide->title }} <span class="text--theme">{{ $slide->sub_title }}</span></h1>
                                                <div class="slider__btn">
                                                    <a class="htc__btn" href="@if($slide->link == 0) {{ route('shop') }} @else {{ route('category_page',['id' => $slide->link]) }} @endif">shop now</a>
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
                                    <a href="{{ route('category_page', ['id' => $category->id]) }}">
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

                        @foreach ($toprate as $product)
                            <!--   top rated products   -->
                            @livewire('frontend.product.card', ['product' => $product])
                        @endforeach

                        </div>
                    </div>

                    @foreach ($toprate as $product)
                        <!--   top rated products quickview modal   -->
                        @livewire('frontend.product.quickview', ['product' => $product])
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Our Product Area Top Rated -->
<div class="only-banner ptb--60 bg__white">
    <div class="container">
        <div class="only-banner-img">
            @if($banners->first())
            <a href="{{ route('product_detailes', ['id' => $banners->first()->product_id]) }}">
                <img src="{{ asset('storage/'.$banners->first()->image) }}" alt="banner">
            </a>
            @endif
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

                        @foreach (App\Product::getSaleProducts('>','old_price',15) as $product)
                            <!--   best sale products   -->
                            @livewire('frontend.product.card', ['product' => $product])
                        @endforeach

                        </div>
                    </div>

                    @foreach (App\Product::getSaleProducts('>','old_price',15) as $product)
                        <!--   best sale products quickview modal   -->
                        @livewire('frontend.product.quickview', ['product' => $product])
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Our Product Area Best Sale -->
<div class="only-banner ptb--60 bg__white">
    <div class="container">
        <div class="only-banner-img">
            @if($banners->skip(1)->take(1)->first())
            <a href="{{ route('product_detailes', ['id' => $banners->skip(1)->take(1)->first()->product_id]) }}">
                <img src="{{ asset('storage/'.$banners->skip(1)->take(1)->first()->image) }}" alt="banner">
            </a>
            @endif
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

                        @foreach (App\Product::getSaleProducts('>','updated_at',15) as $product)
                            <!--   on sale products   -->
                            @livewire('frontend.product.card', ['product' => $product])
                        @endforeach

                        </div>
                    </div>

                    @foreach (App\Product::getSaleProducts('>','updated_at',15) as $product)
                        <!--   on sale products quickview modal   -->
                        @livewire('frontend.product.quickview', ['product' => $product])
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Our Product Area On Sale -->
<div class="only-banner ptb--60 bg__white">
    <div class="container">
        <div class="only-banner-img">
            @if($banners->skip(2)->take(1)->first())
            <a href="{{ route('product_detailes', ['id' => $banners->skip(1)->take(1)->first()->product_id]) }}">
                <img src="{{ asset('storage/'.$banners->skip(2)->take(1)->first()->image) }}" alt="banner">
            </a>
            @endif
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

                        @foreach (App\Product::getSaleProducts('<=','id',15) as $product)
                            <!--   latest products   -->
                            @livewire('frontend.product.card', ['product' => $product])
                        @endforeach

                        </div>
                    </div>

                    @foreach (App\Product::getSaleProducts('<=','id',15) as $product)
                        <!--   latest products quickview modal   -->
                        @livewire('frontend.product.quickview', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our Product Area Latest -->
<!-- Start Blog Area -->
<section class="htc__blog__area bg__white mb--70">
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
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection