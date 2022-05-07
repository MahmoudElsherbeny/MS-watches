@extends('frontend.layouts.app')
@section('title')  Cart @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Cart</h2>
                            <nav class="bradcaump-inner">
                              <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb-item active">Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <!--  check if cart session is empty or not  -->
                    @if(session('cart'))
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
                                    
                                    <?php
                                        $index = 0;
                                        $total = 0;
                                    ?>
                                    @foreach (session('cart') as $key => $product)
                                        <tr>
                                            <td class="product-order">{{ ($index+1) }}</td>
                                            <td class="product-thumbnail"><img src=" {{ url('frontend/images/product/3.png') }} " alt="product img" /></td>
                                            <td class="product-name">
                                                <a href="{{ route('product_detailes', ['id' => $product['id']]) }}">{{ $product['name'] }}</a>
                                            </td>
                                            <td class="product-price"><span class="amount">£{{ $product['price'] }}</span></td>
                                            <td class="product-quantity"><input type="number" value="{{ $product['quantity'] }}" /></td>
                                            <td class="product-subtotal">£{{ $product['price'] * $product['quantity'] }}</td>
                                            <td class="product-remove">
                                                {!! Form::Open(['url' => route('cart.remove', ['id' => $product['id']]) ]) !!}
                                                    <button class="btn btn-app" type="submit"> X</button>
                                                {!! Form::Close() !!}
                                            </td>
                                        </tr>

                                        <?php
                                            $index++;
                                            $total += $product['price'] * $product['quantity'];
                                        ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <input type="submit" value="Update Cart" />
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
                                        <span class="title">Total:</span>
                                        <span class="amount">£{{ $total }}</span>
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
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection