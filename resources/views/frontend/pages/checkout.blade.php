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
                <div class="col-md-8 col-lg-8">
                    <div class="ckeckout-left-sidebar">
                        <!-- Start Checkbox Area -->
                        <div class="checkout-form">
                            <h2 class="section-title-3">Billing details</h2>
                            <div class="checkout-form-inner">
                                <div class="single-checkout-box">
                                    <label>Name: </label>
                                    <span class="text-capitalize">{{ $user->name }}</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Email: </label>
                                    <span>{{ $user->email }}</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Phone: </label>
                                    <span>@if($user->user_info) {{ $user->user_info->phone }} @endif</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>State: </label>
                                    <span class="text-capitalize">@if($user->user_info) {{ $user->user_info->state->state }} @endif</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Address: </label>
                                    <span>@if($user->user_info) {{ $user->user_info->address }} @endif</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Watches: </label>
                                    <span>{{ Cart::instance('cart')->content()->count() }}</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Quantity: </label>
                                    <span>{{ Cart::instance('cart')->count() }}</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Total: </label>
                                    <span>£ {{ Cart::instance('cart')->subtotalfloat() / 100 + $user->user_info->state->delivery }}</span>
                                </div>
                                <div class="single-checkout-box buttons mt--40">
                                        <button data-toggle="modal" data-target="#ChangeAdress" class="ms-btn black-btn">Change Address</button>
                                    {!! Form::open() !!}
                                        <button type="submit" class="ms-btn black-btn">Confirm Order</button>
                                    {!! Form::close() !!}
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="ChangeAdress" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="row">
                                                    <h5 class="col-md-11 col-sm-9 col-xs-9 text-left">Change Address</h5>
                                                    <ul class="card-actions col-md-1 col-sm-3 col-xs-3 text-right">
                                                        <li>
                                                            <button data-dismiss="modal" type="button" class="close"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        {!! Form::Open(['url' => '' ]) !!} 
                                            <div class="modal-body">
                                                <div class="card-block text-left mb--20">
                                                    <p>Write a new address you want to deliver your order to.</p>
                                                    <p>Notice: if you don't add your main address we will this the main address.</p>
                                                </div>
                                                <div class="modal-checkout-box mb--20">
                                                    <label>New Phone: </label>
                                                    <input type="text" name="new_phone" value="" placeholder="write new phone">
                                                </div>
                                                <div class="modal-checkout-box mb--20">
                                                    <label>New State: </label>
                                                    <select name="new_state">
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-checkout-box mb--20">
                                                    <label>New Address: </label>
                                                    <input name="new_address" type="text" placeholder="write new address">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-success" type="submit"> Confirm</button>
                                            </div>
                                        {!! Form::Close() !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- END Modal -->

                            </div>
                        </div>
                        <!-- End Checkbox Area -->
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="checkout-right-sidebar">
                        <div class="our-important-note">
                            <h2 class="section-title-3">Note :</h2>
                            <p class="note-desc">Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut laborekf et dolore magna aliqua.</p>
                            <ul class="important-note">
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Lorem ipsum dolor sit amet, consectetur nipabali</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Lorem ipsum dolor sit amet</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Lorem ipsum dolor sit amet, consectetur nipabali</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Lorem ipsum dolor sit amet, consectetur nipabali</a></li>
                                <li><a href="#"><i class="zmdi zmdi-caret-right-circle"></i>Lorem ipsum dolor sit amet</a></li>
                            </ul>
                        </div>
                        <div class="puick-contact-area mt--60">
                            <h2 class="section-title-3">Quick Contract</h2>
                            <a href="phone:+8801722889963">+012 345 678 102 </a>
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
