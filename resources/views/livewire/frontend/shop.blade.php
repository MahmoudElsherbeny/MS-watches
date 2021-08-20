<div>
    {{-- The Master doesn't talk, he acts. --}}
    
    <div class="product__list another-product-style">
        @foreach ($products as $product)
            <!-- Start Single Product -->
            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
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
            <!-- End Single Product -->
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

    <!-- Start Load More BTn -->
    @if($hasmore)
    <div class="row">
        <div class="col-md-12 mt--60">
            <div class="htc__loadmore__btn">
                <button wire:click="loadMore({{ $products->first()->id }})" wire:loading.remove class="load_products">load more</button>
            </div>
        </div>
    </div>
    @endif
    
    <div class="loading mtb--60">
        <div wire:loading>
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <!-- End Load More BTn -->
    
</div>
    