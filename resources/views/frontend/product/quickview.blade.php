@foreach ($products as $product)
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
                                        @if($product->old_price > 0)
                                            <span class="old-price">&pound;{{ $product->old_price/100 }}</span>
                                            <span class="new-price">&pound;{{ $product->price/100 }}</span>
                                        @else
                                            <span class="new-price">&pound;{{ $product->price/100 }}</span>
                                        @endif
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
                                <div class="select__quantity">
                                    <h2>Quantity :</h2>
                                    <div class="product__quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="productqty" value="1">
                                        </div>
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
                                    <a href="{{ route('cart.add', ['id' => $product->id]) }}">Add to cart</a>
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