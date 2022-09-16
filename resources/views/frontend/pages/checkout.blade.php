@extends('frontend.layouts.app')
@section('title')  Checkout @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(../frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Checkout</h2>
                            <nav class="bradcaump-inner">
                              <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb-item active">Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="our-checkout-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                    <div class="ckeckout-left-sidebar">
                        <!-- Start Checkbox Area -->
                        <div class="checkout-form mb--100">
                        {!! Form::Open(['url' => route('UserOrder.store') ]) !!} 
                            <h2 class="section-title-3">Delivering Detailes</h2>
                            <div class="checkout-form-inner mb--50">
                                <div class="single-checkout-box">
                                    <p>Your info will be used automaticaly as order address, you can enter another address to deliver.</p>
                                    <p class="mb--30">All fields are required if you add new address.</p>
                                </div>
                                <div class="single-checkout-box">
                                    <input class="mb--10" name="name" type="text" placeholder="name*" value="{{ $user->name }}">
                                    @error('name')
                                        <div class="msg-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-checkout-box">
                                    <input class="mb--10" name="email" type="text" placeholder="email*" value="{{ $user->email }}" readonly>
                                </div>
                                <div class="single-checkout-box">
                                    <input class="mb--10" name="phone" type="text" placeholder="phone*" value="@if($user->user_info) {{ $user->user_info->phone }} @else {{ old('phone') }} @endif">
                                    @error('phone')
                                        <div class="msg-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-checkout-box">
                                    <select class="mb--10" name="state">
                                        <option>choose state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" @if($user->user_info && $user->user_info->state_id == $state->id) selected @endif>{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="msg-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-checkout-box">
                                    <input class="mb--10" name="city" type="text" placeholder="city*" value="@if($user->user_info) {{ $user->user_info->city }} @else {{ old('city') }} @endif">
                                    @error('city')
                                        <div class="msg-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-checkout-box mb--30">
                                    <input name="address" type="text" placeholder="address*" value="@if($user->user_info) {{ $user->user_info->address }} @else {{ old('address') }} @endif">
                                    @error('address')
                                        <div class="msg-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-checkout-box buttons text-center mt--30">
                                    <button type="submit" class="ms-btn black-btn">Confirm Order</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                        <!-- End Checkbox Area -->
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="checkout-right-sidebar">
                        <div class="table-content table-responsive mb--70">
                            <table>
                                <thead>
                                    <tr>
                                        <th><span class="nobr">Product</span></th>
                                        <th><span class="nobr">Price </span></th>
                                        <th><span class="nobr">Qty</span></th>
                                        <th class="product-price"><span class="nobr">Total</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_qty=0; ?>
                                    @foreach ($cart_items as $key => $prod)
                                        <tr>
                                            <td><a href="{{ route('product_detailes', ['id' => Auth::check() ? $prod->product_id : $prod->id]) }}">{{ $prod->name }}</a></td>
                                            <td>£ {{ $prod->price / 100 }}</td>
                                            <td>{{ $prod->qty }}</td>
                                            <td class="product-price"><span class="amount">£ {{ $prod->price*$prod->qty / 100 }}</span></td>
                                        </tr>
                                        <?php $total_qty += $prod->qty; ?>
                                    @endforeach
                                    <tr>
                                        <th colspan="4">Total</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $cart_items->count() }}</td>
                                        <td>-</td>
                                        <td>{{ $total_qty }}</td>
                                        <td class="product-price"><span class="amount">£ {{ $total / 100 + $user->user_info->state->delivery }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                        <div class="our-important-note">
                            <h2 class="section-title-3">Note :</h2>
                            <p class="note-desc">You should read this notes before confirming order:</p>
                            <ul class="important-note">
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Can't cancel order after delivering.</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Be sure from your address.</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Order won't be delivering before contact and confirm with you.</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>If you want to edit or cancel order contact with us.</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Checkout Area -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection
