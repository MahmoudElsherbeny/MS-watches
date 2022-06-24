@foreach ($products as $product)
   <div class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12 cat--1">
        <div class="product">
            <div class="product__inner">
                <div class="pro__thumb">
                    <a href="#">
                        <img src="{{ App\Product_image::ProductMainImage($product->id) }}" alt="product images">
                    </a>
                </div>
                <div class="product__hover__info">
                    <ul class="product__action">
                        <li><a data-toggle="modal" data-target="#watche{{ $product->id }}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                        <li><a title="Add TO Cart" href="{{ route('cart.add',['id' => $product->id]) }}"><span class="ti-shopping-cart"></span></a></li>
                        <li><a title="Wishlist" href="{{ route('wishlist.add',['id' => $product->id]) }}"><span class="ti-heart"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="product__details">
                <h2><a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name }}</a></h2>
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

@endforeach