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
        <div class="row">
            <div class="col-md-12">
                <div class="product-style-tab">
                    <div class="product-tab-list">
                        <a href="#TopRated" class="active"> top rated </a>
                    </div>
                    <div class="tab-content another-product-style jump">
                        <div class="tab-pane active" id="TopRated">
                            <div class="row">
                                <div class="product-slider-active owl-carousel">
                                    
                                <!--   top rated products   -->
                                @foreach ($toprate as $product)
                                    <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                        <div class="product">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="#">
                                                        <img src="{{ url(App\Product_image::ProductMainImage($product->id)) }}" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a data-toggle="modal" data-target="#topratewatche{{ $product->id }}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                        <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                        <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name }}</a></h2>
                                                <ul class="product__price">
                                                    @if($product->sale > 0)
                                                        <li class="old__price">&pound; {{ $product->price }}</li>
                                                        <li class="new__price">&pound; {{ $product->price-$product->sale }}</li>
                                                    @else
                                                        <li class="new__price">&pound; {{ $product->price }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--   overview of top rated products   -->
                    @foreach ($toprate as $product)
                        <!-- QUICKVIEW PRODUCT -->
                        <div id="quickview-wrapper">
                            <!-- Modal -->
                            <div class="modal fade" id="topratewatche{{ $product->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal__container" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-product">
                                                <!-- Start product images -->
                                                <div class="product-images">
                                                    <div class="main-image images">
                                                        <img alt="big images" src="{{ url(App\Product_image::ProductMainImage($product->id)) }}">
                                                    </div>
                                                </div>
                                                <!-- end product images -->
                                                <div class="product-info">
                                                    <h1>{{ $product->name }}</h1>
                                                    <div class="rating__and__review">
                                                        <ul class="rating">

                                                            @php $rating = App\Product_review::getProductRate($product->id); @endphp

                                                            @foreach (range(1,5) as $i)

                                                                @if($rating > 0) 
                                                                    @if($rating >= 0.7)
                                                                        <li><span class="zmdi zmdi-star"></span></li>
                                                                    @elseif($rating >= 0.3)
                                                                        <li><span class="zmdi zmdi-star-half"></span></li>
                                                                    @else
                                                                        <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                    @endif                                        
                                                                @else
                                                                    <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                @endif
                                                                
                                                                @php $rating-- @endphp
                                                            @endforeach

                                                        </ul>
                                                        <div class="review">
                                                            <span>{{ App\Product_review::getReviewsCount($product->id) }} customer reviews</span>
                                                        </div>
                                                    </div>
                                                    <div class="price-box-3">
                                                        <div class="s-price-box">
                                                            <span class="new-price">&pound;{{ $product->price }}</span>
                                                            <!-- <span class="old-price">$45.00</span>  -->
                                                        </div>
                                                    </div>
                                                    <div class="quick-desc">{{ $product->mini_description }}</div>
                                                    <div class="select__color mb--10">
                                                        <h2>Body color</h2>
                                                        <div class="color__list">
                                                            <div class="prod__color" style="background-color: {{ $product->body_color }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="select__color">
                                                        <h2>Mina color</h2>
                                                        <div class="color__list">
                                                            <div class="prod__color" style="background-color: {{ $product->mina_color }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="social-sharing">
                                                        <div class="widget widget_socialsharing_widget">
                                                            <h3 class="widget-title-modal">Share this product</h3>
                                                            <ul class="social-icons mt--20">
                                                                <li><a target="_blank" title="facebook" href="#" class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a></li>
                                                                <li><a target="_blank" title="twitter" href="#" class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a></li>
                                                                <li><a target="_blank" title="instagram" href="#" class="instagram social-icon"><i class="zmdi zmdi-instagram"></i></a></li>
                                                                <li><a target="_blank" title="whatsapp" href="#" class="whatsapp social-icon"><i class="zmdi zmdi-whatsapp"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="addtocart-btn">
                                                        <a href="#">Add to cart</a>
                                                    </div>
                                                </div><!-- .product-info -->
                                            </div><!-- .modal-product -->
                                        </div><!-- .modal-body -->
                                    </div><!-- .modal-content -->
                                </div><!-- .modal-dialog -->
                            </div>
                            <!-- END Modal -->
                        </div>
                        <!-- END QUICKVIEW PRODUCT -->
                    @endforeach

                </div>
            </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="product-style-tab">
                    <div class="product-tab-list">
                        <a href="#BestSale" class="active"> best sale </a>
                    </div>
                    <div class="tab-content another-product-style jump">
                        <div class="tab-pane active" id="BestSale">
                            <div class="row">
                                <div class="product-slider-active owl-carousel">
                                    
                                <!--   best sale products   -->
                                @foreach ($bestsale as $product)
                                    <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                        <div class="product">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="#">
                                                        <img src="{{ url(App\Product_image::ProductMainImage($product->id)) }}" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a data-toggle="modal" data-target="#bestsalewatche{{ $product->id }}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                        <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                        <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name }}</a></h2>
                                                <ul class="product__price">
                                                    @if($product->sale > 0)
                                                        <li class="old__price">&pound; {{ $product->price }}</li>
                                                        <li class="new__price">&pound; {{ $product->price-$product->sale }}</li>
                                                    @else
                                                        <li class="new__price">&pound; {{ $product->price }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--   overview of best sale products   -->
                    @foreach ($bestsale as $product)
                        <!-- QUICKVIEW PRODUCT -->
                        <div id="quickview-wrapper">
                            <!-- Modal -->
                            <div class="modal fade" id="bestsalewatche{{ $product->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal__container" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-product">
                                                <!-- Start product images -->
                                                <div class="product-images">
                                                    <div class="main-image images">
                                                        <img alt="big images" src="{{ url(App\Product_image::ProductMainImage($product->id)) }}">
                                                    </div>
                                                </div>
                                                <!-- end product images -->
                                                <div class="product-info">
                                                    <h1>{{ $product->name }}</h1>
                                                    <div class="rating__and__review">
                                                        <ul class="rating">

                                                            @php $rating = App\Product_review::getProductRate($product->id); @endphp

                                                            @foreach (range(1,5) as $i)

                                                                @if($rating > 0) 
                                                                    @if($rating >= 0.7)
                                                                        <li><span class="zmdi zmdi-star"></span></li>
                                                                    @elseif($rating >= 0.3)
                                                                        <li><span class="zmdi zmdi-star-half"></span></li>
                                                                    @else
                                                                        <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                    @endif                                        
                                                                @else
                                                                    <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                @endif
                                                                
                                                                @php $rating-- @endphp
                                                            @endforeach

                                                        </ul>
                                                        <div class="review">
                                                            <span>{{ App\Product_review::getReviewsCount($product->id) }} customer reviews</span>
                                                        </div>
                                                    </div>
                                                    <div class="price-box-3">
                                                        <div class="s-price-box">
                                                            <span class="new-price">&pound;{{ $product->price }}</span>
                                                            <!-- <span class="old-price">$45.00</span>  -->
                                                        </div>
                                                    </div>
                                                    <div class="quick-desc">{{ $product->mini_description }}</div>
                                                    <div class="select__color mb--10">
                                                        <h2>Body color</h2>
                                                        <div class="color__list">
                                                            <div class="prod__color" style="background-color: {{ $product->body_color }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="select__color">
                                                        <h2>Mina color</h2>
                                                        <div class="color__list">
                                                            <div class="prod__color" style="background-color: {{ $product->mina_color }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="social-sharing">
                                                        <div class="widget widget_socialsharing_widget">
                                                            <h3 class="widget-title-modal">Share this product</h3>
                                                            <ul class="social-icons mt--20">
                                                                <li><a target="_blank" title="facebook" href="#" class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a></li>
                                                                <li><a target="_blank" title="twitter" href="#" class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a></li>
                                                                <li><a target="_blank" title="instagram" href="#" class="instagram social-icon"><i class="zmdi zmdi-instagram"></i></a></li>
                                                                <li><a target="_blank" title="whatsapp" href="#" class="whatsapp social-icon"><i class="zmdi zmdi-whatsapp"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="addtocart-btn">
                                                        <a href="#">Add to cart</a>
                                                    </div>
                                                </div><!-- .product-info -->
                                            </div><!-- .modal-product -->
                                        </div><!-- .modal-body -->
                                    </div><!-- .modal-content -->
                                </div><!-- .modal-dialog -->
                            </div>
                            <!-- END Modal -->
                        </div>
                        <!-- END QUICKVIEW PRODUCT -->
                    @endforeach

                </div>
            </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="product-style-tab">
                    <div class="product-tab-list">
                        <a href="#OnSale" class="active"> on sale </a>
                    </div>
                    <div class="tab-content another-product-style jump">
                        <div class="tab-pane active" id="OnSale">
                            <div class="row">
                                <div class="product-slider-active owl-carousel">

                                <!--   on sale products   -->
                                @foreach ($onsale as $product)
                                    <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                        <div class="product">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="#">
                                                        <img src="{{ url(url(App\Product_image::ProductMainImage($product->id))) }}" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a data-toggle="modal" data-target="#salewatche{{ $product->id }}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                        <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                        <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name }}</a></h2>
                                                <ul class="product__price">
                                                    @if($product->sale > 0)
                                                        <li class="old__price">&pound; {{ $product->price }}</li>
                                                        <li class="new__price">&pound; {{ $product->price-$product->sale }}</li>
                                                    @else
                                                        <li class="new__price">&pound; {{ $product->price }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  quickview of on sale products   -->
                    @foreach ($onsale as $product)
                        <!-- QUICKVIEW PRODUCT -->
                        <div id="quickview-wrapper">
                            <!-- Modal -->
                            <div class="modal fade" id="salewatche{{ $product->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal__container" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-product">
                                                <!-- Start product images -->
                                                <div class="product-images">
                                                    <div class="main-image images">
                                                        <img alt="big images" src="{{ url(App\Product_image::ProductMainImage($product->id)) }}">
                                                    </div>
                                                </div>
                                                <!-- end product images -->
                                                <div class="product-info">
                                                    <h1>{{ $product->name }}</h1>
                                                    <div class="rating__and__review">
                                                        <ul class="rating">

                                                            @php $rating = App\Product_review::getProductRate($product->id); @endphp

                                                            @foreach (range(1,5) as $i)

                                                                @if($rating > 0) 
                                                                    @if($rating >= 0.7)
                                                                        <li><span class="zmdi zmdi-star"></span></li>
                                                                    @elseif($rating >= 0.3)
                                                                        <li><span class="zmdi zmdi-star-half"></span></li>
                                                                    @else
                                                                        <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                    @endif                                        
                                                                @else
                                                                    <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                @endif
                                                                
                                                                @php $rating-- @endphp
                                                            @endforeach

                                                        </ul>
                                                        <div class="review">
                                                            <span>{{ App\Product_review::getReviewsCount($product->id) }} customer reviews</span>
                                                        </div>
                                                    </div>
                                                    <div class="price-box-3">
                                                        <div class="s-price-box">
                                                            <span class="new-price">&pound;{{ $product->price }}</span>
                                                            <!-- <span class="old-price">$45.00</span>  -->
                                                        </div>
                                                    </div>
                                                    <div class="quick-desc">{{ $product->mini_description }}</div>
                                                    <div class="select__color mb--10">
                                                        <h2>Body color</h2>
                                                        <div class="color__list">
                                                            <div class="prod__color" style="background-color: {{ $product->body_color }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="select__color">
                                                        <h2>Mina color</h2>
                                                        <div class="color__list">
                                                            <div class="prod__color" style="background-color: {{ $product->mina_color }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="social-sharing">
                                                        <div class="widget widget_socialsharing_widget">
                                                            <h3 class="widget-title-modal">Share this product</h3>
                                                            <ul class="social-icons mt--20">
                                                                <li><a target="_blank" title="facebook" href="#" class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a></li>
                                                                <li><a target="_blank" title="twitter" href="#" class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a></li>
                                                                <li><a target="_blank" title="instagram" href="#" class="instagram social-icon"><i class="zmdi zmdi-instagram"></i></a></li>
                                                                <li><a target="_blank" title="whatsapp" href="#" class="whatsapp social-icon"><i class="zmdi zmdi-whatsapp"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="addtocart-btn">
                                                        <a href="#">Add to cart</a>
                                                    </div>
                                                </div><!-- .product-info -->
                                            </div><!-- .modal-product -->
                                        </div><!-- .modal-body -->
                                    </div><!-- .modal-content -->
                                </div><!-- .modal-dialog -->
                            </div>
                            <!-- END Modal -->
                        </div>
                        <!-- END QUICKVIEW PRODUCT -->
                    @endforeach

                </div>
            </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="product-style-tab">
                    <div class="product-tab-list">
                        <a href="#Latest" class="active"> latest </a>
                    </div>
                    <div class="tab-content another-product-style jump">
                        <div class="tab-pane active" id="Latest">
                            <div class="row">
                                <div class="product-slider-active owl-carousel">

                                <!--   latest products   -->
                                @foreach ($latest as $product)
                                    <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                        <div class="product">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="#">
                                                        <img src="{{ url(App\Product_image::ProductMainImage($product->id)) }}" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a data-toggle="modal" data-target="#watche{{ $product->id }}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                        <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                        <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name }}</a></h2>
                                                <ul class="product__price">
                                                    @if($product->sale > 0)
                                                        <li class="old__price">&pound; {{ $product->price }}</li>
                                                        <li class="new__price">&pound; {{ $product->price-$product->sale }}</li>
                                                    @else
                                                        <li class="new__price">&pound; {{ $product->price }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                            </div>
                        </div>

                        <!--   quickview of latest products   -->
                        @foreach ($latest as $product)
                            <!-- QUICKVIEW PRODUCT -->
                            <div id="quickview-wrapper">
                                <!-- Modal -->
                                <div class="modal fade" id="watche{{ $product->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal__container" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-product">
                                                    <!-- Start product images -->
                                                    <div class="product-images">
                                                        <div class="main-image images">
                                                            <img alt="big images" src="{{ url(App\Product_image::ProductMainImage($product->id)) }}">
                                                        </div>
                                                    </div>
                                                    <!-- end product images -->
                                                    <div class="product-info">
                                                        <h1>{{ $product->name }}</h1>
                                                        <div class="rating__and__review">
                                                            <ul class="rating">

                                                                @php $rating = App\Product_review::getProductRate($product->id); @endphp

                                                                @foreach (range(1,5) as $i)

                                                                    @if($rating > 0) 
                                                                        @if($rating >= 0.7)
                                                                            <li><span class="zmdi zmdi-star"></span></li>
                                                                        @elseif($rating >= 0.3)
                                                                            <li><span class="zmdi zmdi-star-half"></span></li>
                                                                        @else
                                                                            <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                        @endif                                        
                                                                    @else
                                                                        <li><span class="zmdi zmdi-star-outline"></span></li>
                                                                    @endif
                                                                    
                                                                    @php $rating-- @endphp
                                                                @endforeach

                                                            </ul>
                                                            <div class="review">
                                                                <span>{{ App\Product_review::getReviewsCount($product->id) }} customer reviews</span>
                                                            </div>
                                                        </div>
                                                        <div class="price-box-3">
                                                            <div class="s-price-box">
                                                                <span class="new-price">&pound;{{ $product->price }}</span>
                                                                <!-- <span class="old-price">$45.00</span>  -->
                                                            </div>
                                                        </div>
                                                        <div class="quick-desc">{{ $product->mini_description }}</div>
                                                        <div class="select__color mb--10">
                                                            <h2>Body color</h2>
                                                            <div class="color__list">
                                                                <div class="prod__color" style="background-color: {{ $product->body_color }}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select__color">
                                                            <h2>Mina color</h2>
                                                            <div class="color__list">
                                                                <div class="prod__color" style="background-color: {{ $product->mina_color }}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="social-sharing">
                                                            <div class="widget widget_socialsharing_widget">
                                                                <h3 class="widget-title-modal">Share this product</h3>
                                                                <ul class="social-icons mt--20">
                                                                    <li><a target="_blank" title="facebook" href="#" class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a></li>
                                                                    <li><a target="_blank" title="twitter" href="#" class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a></li>
                                                                    <li><a target="_blank" title="instagram" href="#" class="instagram social-icon"><i class="zmdi zmdi-instagram"></i></a></li>
                                                                    <li><a target="_blank" title="whatsapp" href="#" class="whatsapp social-icon"><i class="zmdi zmdi-whatsapp"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="addtocart-btn">
                                                            <a href="#">Add to cart</a>
                                                        </div>
                                                    </div><!-- .product-info -->
                                                </div><!-- .modal-product -->
                                            </div><!-- .modal-body -->
                                        </div><!-- .modal-content -->
                                    </div><!-- .modal-dialog -->
                                </div>
                                <!-- END Modal -->
                            </div>
                            <!-- END QUICKVIEW PRODUCT -->
                        @endforeach

                    </div>
                </div>
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
                    <a href="{{ route('shop') }}" class="load_products">Show All Products</a>
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
