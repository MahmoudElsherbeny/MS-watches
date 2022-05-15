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
                                        <img src="{{ url('storage/products/'.$product_image->image) }}" alt="product-image">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- End Small images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                @foreach ($product_images as $key => $product_image)
                                    <div role="tabpanel" class="tab-pane fade @if($key==0) in active @endif" id="prodimg-tab-{{ ($key+1) }}">
                                        <img src="{{ url('storage/products/'.$product_image->image) }}" alt="full-image">
                                    </div>
                                @endforeach

                                
                                <div role="tabpanel" class="tab-pane fade product-video-position" id="img-tab-4">
                                    <img src="{{ url('frontend/images/product-details/big-img/12.jpg') }}" alt="full-image">
                                    <div class="product-video">
                                        <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                            <i class="zmdi zmdi-videocam"></i> View Video
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                    <div class="htc__product__details__inner">
                        <div class="pro__detl__title">
                            <h2>{{ $product->name }}</h2>
                        </div>
                        <div class="pro__dtl__rating">
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
                        <div class="product-action-wrap">
                            <div class="prodict-statas"><span>Quantity :</span></div>
                            <div class="product-quantity">
                                <form id='myform' method='POST' action='#'>
                                    <div class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <ul class="pro__dtl__btn">
                            <li class="buy__now__btn"><a href="#">buy now</a></li>
                            <li><a href="#"><span class="ti-heart"></span></a></li>
                            <li><a href="#"><span class="ti-email"></span></a></li>
                        </ul>
                        <div class="pro__social__share">
                            <h2>Share :</h2>
                            <ul class="pro__soaial__link">
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details -->
    <!-- Start Product tab -->
    <section class="htc__product__details__tab bg__white pb--120">
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

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection