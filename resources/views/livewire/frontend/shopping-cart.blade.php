<div>

    @if(Session::has('error'))
        <div class="alert alert-danger text-capitalize text-center w-75 m-x-auto" role="alert">
            {{Session::get('error')}}
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success text-capitalize text-center w-75 m-x-auto" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    <!--  check if cart session is empty or not  -->
    @if($cart_items->count() > 0)
        <div class="cart__products__container mb--70">
            @foreach ($cart_items as $key => $prod)
                <div class="cart__product mb--30">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <div class="product__image text-center">
                                <img src=" {{ App\Product_image::ProductMainImage($prod->id) }} " alt="product img" />
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-8">
                            <div class="product__content">
                                <div class="title ptb--10">
                                    <div class="row">
                                        <div class="col-md-11 col-sm-9 col-xs-9">
                                            <a href="{{ route('product_detailes', ['id' => $prod->id]) }}">{{ $prod->name }}</a>
                                            <div class="pro__dtl__rating">
                                                <ul class="pro__rating">
                                                    @php $rating = App\Product_review::getProductRate($prod->id); @endphp
                    
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
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-3 col-xs-3 text-right">
                                            <button class="btn btn-app" wire:click="remove('{{ $key }}')"> X</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="price ptb--10">
                                    <span>&pound;{{ $this->prod_price($prod->id)/100 }}</span>
                                    <input type="number" name="prod_qty" min="1" value="{{ $prod->qty }}" wire:model="cart_items.{{ $key }}.qty" wire:change="updateCart('{{ $key }}', $event.target.value)" />
                                </div>
                                <div class="total ptb--10">
                                    Total:
                                    <span class="">£{{ $this->prod_price($prod->id)*$prod->qty / 100 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-8 col-sm-7 col-xs-12">
                <div class="buttons-cart">
                    <button wire:click="clear">Clear All</button>
                    <a href="{{ route('shop') }}">Continue Shopping</a>
                </div>
                <div class="coupon">
                    <h3>Coupon</h3>
                    <p>Enter your coupon code if you have one.</p>
                    <input type="text" placeholder="Coupon code" />
                    <input type="submit" value="Apply Coupon" />
                </div>
            </div>
            <div class="col-md-4 col-sm-5 col-xs-12">
                <div class="cart_totals">
                    @if (Auth::user()->user_info && Auth::user()->user_info->state)
                        <table>
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal:</th>
                                    <td><span class="amount">£{{ Cart::instance('cart')->subtotalfloat() / 100 }}</span></td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>Delivery:</th>
                                    <td><span class="amount">£{{ Auth::user()->user_info->state->delivery }}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total:</th>
                                    <td>
                                        <strong><span class="amount">£{{ Cart::instance('cart')->subtotalfloat() / 100 + Auth::user()->user_info->state->delivery }}</span></strong>
                                    </td>
                                </tr>                                           
                            </tbody>
                        </table>
                    @else
                        <div class="order_total">
                            <span class="title">Subtotal:</span>
                            <span class="amount">£{{ Cart::instance('cart')->subtotalfloat() / 100 }}</span>
                        </div>
                    @endif
                    <div class="wc-proceed-to-checkout">
                        <a href="{{ route('UserOrder.checkout_page') }}">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty__cart">
            <p>your cart is empty <br>start shopping now !</p>
            @if(!Auth::check())
                <span>create account <a href="{{ route('register') }}">SIGNUP</a> OR <a href="{{ route('login') }}">LOGIN</a></span>
            @endif
        </div>
        <div class="empty__cart__button">
            <a href="{{ route('shop') }}" class="ms-btn black-btn">Shop</a>
        </div>
    @endif

</div>
