<div>

    <div class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12 cat--1">
        <div class="product">
            <div class="product__inner">
                <div class="pro__thumb">
                    <a href="{{ route('product_detailes', ['id' => $product->id]) }}">
                        <img src="{{ App\Product_image::ProductMainImage($product->id) }}" alt="product images">
                    </a>
                </div>
                <div class="product__hover__info">
                    <ul class="product__action">
                        <li>
                            <button data-toggle="modal" data-target="#watche{{ $product->id }}" class="quick-view modal-view detail-link"><span class="ti-plus"></span></button>
                        </li>
                        @if($product->quantity > 0)
                            <li>
                                {!! Form::open(['wire:submit.prevent' => 'addToCart']) !!}
                                    <button type="submit"><span class="ti-shopping-cart"></span></button>
                                {!! Form::close() !!}
                            </li>
                        @else
                            <li><span class="ti-shopping-cart"></span></li>
                        @endif
                        <li>
                            {!! Form::open(['wire:submit.prevent' => 'addToWishlist']) !!}
                                <button type="submit"><span class="ti-heart"></span></button>
                            {!! Form::close() !!}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="product__details">
                <h2 class="text-capitalize">
                    <a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name }}</a>
                </h2>
                <ul class="product__price">
                    @if($product->old_price > 0)
                        <li class="old__price">&pound; {{ $product->old_price / 100 }}</li>
                        <li class="new__price">&pound; {{ $product->price / 100 }}</li>
                    @else
                        <li class="new__price">&pound; {{ $product->price / 100 }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>