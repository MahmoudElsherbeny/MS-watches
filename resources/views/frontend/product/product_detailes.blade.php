@extends('frontend.layouts.app')
@section('title')  Product Detailes @endsection

@section('content')
    
     <!-- Start Bradcaump area -->
     <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Product Details</h2>
                            <nav class="bradcaump-inner">
                              <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb-item active">Product Details</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Product Details -->
    <section class="htc__product__details pt--120 pb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="product__details__container">
                        <!-- Start Small images -->
                        <ul class="product__small__images" role="tablist">
                            @foreach ($product_images as $key => $product_image)
                                <li role="presentation" class="pot-small-img">
                                    <a href="#prodimg-tab-{{ ($key+1) }}" role="tab" data-toggle="tab">
                                        @if (App\Product_image::isImage($product_image->image))
                                            <img src="{{ url('storage/products/'.$product_image->image) }}" alt="product-image">
                                            <div class="product-video-overlay"></div>
                                        @elseif (App\Product_image::isVideo($product_image->image))
                                            <video width="104" height="126">
                                                <source src="{{ url('storage/products/'.$product_image->image) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class="product-video-overlay"></div>
                                            <div class="product-video">
                                                <i class="zmdi zmdi-play"></i>
                                            </div>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- End Small images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                @foreach ($product_images as $key => $product_image)
                                    <div role="tabpanel" class="tab-pane fade @if($key==0) in active @endif" id="prodimg-tab-{{ ($key+1) }}">
                                        @if (App\Product_image::isImage($product_image->image))
                                            <img src="{{ url('storage/products/'.$product_image->image) }}" alt="full-image">
                                        @elseif (App\Product_image::isVideo($product_image->image))
                                            <video class="product_video" width="454" height="544" controls>
                                                <source src="{{ url('storage/products/'.$product_image->image) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                    <div class="htc__product__details__inner">
                        <div class="pro__detl__title">
                            <h2>{{ $product->name }} <span>({{ $product->tags }})</span></h2>
                        </div>
                        <div class="pro__dtl__rating mt--10">
                            <ul class="pro__rating">
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
                            <span class="rat__qun">(Based on {{ App\Product_review::getReviewsCount($product->id) }} Customers Ratings)</span>
                        </div>
                        <div class="pro__details">{{ $product->mini_description }}</div>
                        <ul class="pro__dtl__prize">
                            @if($product->old_price > 0)
                                <li class="old__prize">&pound;{{ $product->old_price/100 }}</li>
                                <li class="new__prize">&pound;{{ $product->price/100 }}</li>
                            @else
                                <li class="new__prize">&pound;{{ $product->price/100 }}</li>
                            @endif
                        </ul>
                        <div class="pro__dtl__color">
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
                        </div>
                        @if ($product->quantity > 0)
                            {!! Form::Open(['url' => route('cart.add',['id' => $product->id]), 'method' => 'GET' ]) !!}
                                <div class="product-action-wrap">
                                    <div class="prodict-statas"><span>Quantity :</span></div>
                                    <div class="product-quantity">
                                        <div class="product-quantity">
                                            <input class="cart-plus-minus-box" type="number" name="qty" min="1" value="1">
                                            @if(Session::has('error'))
                                                <div class="msg-error text-capitalize text-center">
                                                    {{Session::get('error')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <ul class="pro__dtl__btn">
                                    <li class="buy__now__btn">
                                        <button type="submit">Buy Now</a>
                                    </li>
                                    <li>
                                        <a title="Wishlist" href="{{ route('wishlist.add',['id' => $product->id]) }}"><span class="ti-heart"></span></a>
                                    </li>
                                    <li><a href="#"><span class="ti-email"></span></a></li>
                                </ul>
                            {!! Form::Close() !!}
                        @else
                            <div class="product-action-wrap">
                                <div class="prodict-statas"><span>Quantity :</span></div>
                                <div class="product-quantity">
                                    <div class="product-quantity">
                                        <input class="cart-plus-minus-box" type="number" name="qty" value="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <ul class="pro__dtl__btn">
                                <li class="buy__now__btn">
                                    <button>Out Of Stock</button>
                                </li>
                                <li>
                                    <a title="Wishlist" href="{{ route('wishlist.add',['id' => $product->id]) }}"><span class="ti-heart"></span></a>
                                </li>
                                <li><a href="#"><span class="ti-email"></span></a></li>
                            </ul>
                        @endif
                        <div class="pro__social__share">
                            <h2>Share :</h2>
                            <ul class="pro__soaial__link">
                                <li><a href="#" class="facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#" class="twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#" class="instagram"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#" class="whatsapp"><i class="zmdi zmdi-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details -->

    <!-- Start Product tab -->
    <section class="htc__product__details__tab bg__white pb--100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <ul class="product__deatils__tab mb--60" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#description" role="tab" data-toggle="tab">Description</a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product__details__tab__content">
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="description" class="product__tab__content fade in active">
                            <div class="product__description__wrap">{!! $product->description !!}</div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="reviews" class="product__tab__content fade">
                            
                            <!-- Start Rating and Reviews Area -->
                            @livewire('frontend.reviews.create', ['productId' => $product->id])
                            
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product tab -->

    <!--  Start related products Area  -->
    <section class="htc__product__area bg__white mb--80">
        <div class="container">
            <div class="product-style-tab">
                <div class="product-tab-list">
                    <a href="#TopRated" class="active"> Related Products ({{ count($related_products) }}) </a>
                </div>
                <div class="tab-content another-product-style jump">
                    <div class="tab-pane active" id="TopRated">
                        <div class="row">
                            <div class="product-slider-active owl-carousel">

                            <!--   top rated products   -->
                            @include('frontend.product.card', ['products' => $related_products])

                            </div>
                        </div>
                    </div>
                </div>

                <!--   overview of top rated products   -->
                @include('frontend.product.quickview', ['products' => $related_products])

            </div>
        </div>
    </section>
    <!--  End related products Area  -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection