<div>

    <!--  check if cart session is empty or not  -->
    @if($cart_items->count() > 0)
        <div class="table-content table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="product-order">#</th>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $index = 1 ?>
                    @foreach ($cart_items as $key => $prod)
                        <tr>
                            <td class="product-order">{{ ($index++) }}</td>
                            <td class="product-thumbnail"><img src=" {{ url('frontend/images/product/3.png') }} " alt="product img" /></td>
                            <td class="product-name">
                                <a href="{{ route('product_detailes', ['id' => $prod->id]) }}">{{ $prod->name }}</a>
                            </td>
                            <td class="product-price"><span class="amount">£{{ $this->prod_price($prod->id)/100 }}</span></td>
                            <td class="product-quantity">
                                <input type="number" name="prod_qty" min="1" value="{{ $prod->qty }}" wire:model="cart_items.{{ $key }}.qty" wire:change="updateCart('{{ $key }}', $event.target.value)" />
                            </td>
                            <td class="product-subtotal">£{{ $this->prod_price($prod->id)*$prod->qty / 100 }}</td>
                            <td class="product-remove">
                                <button class="btn btn-app" wire:click="remove('{{ $key }}')"> X</button>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-9 col-sm-7 col-xs-12">
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
            <div class="col-md-3 col-sm-5 col-xs-12">
                <div class="cart_totals">
                    <div class="order_total">
                        <span class="title">Subtotal:</span>
                        <span class="amount">£{{ Cart::instance('cart')->subtotal() }}</span>
                    </div>
                    <div class="wc-proceed-to-checkout">
                        <a href="{{ route('cart.checkout_page') }}">Proceed to Checkout</a>
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
