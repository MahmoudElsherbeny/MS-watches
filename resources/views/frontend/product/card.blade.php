@foreach ($products as $product)
   <div class="col single__pro cat--1">
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
                        <li><a title="Add TO Cart" href="{{ route('cart.add', ['id' => $product->id]) }}"><span class="ti-shopping-cart"></span></a></li>
                        <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="product__details">
                <h2><a href="{{ route('product_detailes', ['id' => $product->id]) }}">{{ $product->name.'/'.$product->category }}</a></h2>
                <ul class="product__price">
                    @if($product->sale > 0)
                        <li class="old__price">&pound; {{ $product->price }}</li>
                        <li class="new__price">&pound; {{ $product->sale }}</li>
                    @else
                        <li class="new__price">&pound; {{ $product->price }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

@endforeach