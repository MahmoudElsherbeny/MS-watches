<div>
    
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>

            @if($cart_items->count() > 0)
                <div class="shp__cart__wrap">

                    @foreach ($cart_items as $key => $item)
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="{{ route('product_detailes', ['id' => Auth::check() ? $item->product_id : $item->id]) }}">
                                    <img src="{{ url($item->options['image']) }}" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2>
                                    <a href="{{ route('product_detailes', ['id' => Auth::check() ? $item->product_id : $item->id]) }}">{{ $item->name }}</a>
                                </h2>
                                <span class="quantity">QTY: {{ $item->qty }}</span>
                                <span class="shp__price">£{{ $item->price/100 }}</span>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <ul class="shoping__total">
                    <li class="subtotal">Subtotal:</li>
                    <li class="total__price">£{{ $cart_total / 100 }}</li>
                </ul>
                <ul class="shopping__btn">
                    <li><a href="{{ route('cart.index') }}" class="ms-btn transparent-btn">View Cart</a></li>
                    <li class="shp__checkout"><a href="{{ route('UserOrder.checkout_page') }}" class="ms-btn black-btn">Checkout</a></li>
                </ul>
            @else
                <div class="shp__cart__wrap">
                        <div class="cart__empty__details">
                            <p>your cart is empty <br>start shopping now !</p>
                            @if(!Auth::check())
                                <span>create account <a href="{{ route('register') }}">SIGNUP</a> OR <a href="{{ route('login') }}">LOGIN</a></span>
                            @endif
                        </div>
                </div>
                <ul class="shopping__btn">
                    <li><a href="{{ route('shop') }}" class="ms-btn black-btn">shop</a></li>
                </ul>
            @endif
        </div>
    </div>

</div>
