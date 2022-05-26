@extends('frontend.layouts.app')
@section('title')  Checkout @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
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
    <section class="our-checkout-area ptb--120 bg__white">
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
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Email: </label>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Phone: </label>
                                    <span></span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Country: </label>
                                    <span></span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>State: </label>
                                    <span></span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Address: </label>
                                    <span></span>
                                </div>
                                <div class="single-checkout-box">
                                    <label>Total: </label>
                                    <span></span>
                                </div>
                                <div class="single-checkout-box checkbox">
                                    <button data-toggle="modal" data-target="#ChangeAdress" class="ms-btn black-btn">Change Address</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="ChangeAdress" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="row">
                                                    <h4 class="col-md-11 text-left">Change Address</h4>
                                                    <ul class="card-actions col-md-1 p-t-md">
                                                        <li>
                                                            <button data-dismiss="modal" type="button" class="close"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        {!! Form::Open(['url' => '' ]) !!} 
                                            <div class="modal-body">
                                                <p>Write a new address to deliver your order to.</p>
                                                <div class="single-checkout-box">
                                                    <label>your address: </label>
                                                    <input type="text" value="" readonly>
                                                </div>
                                                <div class="single-checkout-box">
                                                    <label>new address: </label>
                                                    <input type="text" placeholder="write new address">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-app" type="submit"> Confirm</button>
                                            </div>
                                        {!! Form::Close() !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- END Modal -->

                            </div>
                        </div>
                        <!-- End Checkbox Area -->
                        <!-- Start Payment Box -->
                        <div class="payment-form">
                            <h2 class="section-title-3">payment details</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur kgjhyt</p>
                            <div class="payment-form-inner">
                                <div class="single-checkout-box">
                                    <input type="text" placeholder="Name on Card*">
                                    <input type="text" placeholder="Card Number*">
                                </div>
                                <div class="single-checkout-box select-option">
                                    <select>
                                        <option>Date*</option>
                                        <option>Date</option>
                                        <option>Date</option>
                                        <option>Date</option>
                                        <option>Date</option>
                                    </select>
                                    <input type="text" placeholder="Security Code*">
                                </div>
                            </div>
                        </div>
                        <!-- End Payment Box -->
                        <!-- Start Payment Way -->
                        <div class="our-payment-sestem">
                            <h2 class="section-title-3">We  Accept :</h2>
                            <ul class="payment-menu">
                                <li><a href="#"><img src="{{ url('frontend/images/payment/1.jpg') }}" alt="payment-img"></a></li>
                                <li><a href="#"><img src="{{ url('frontend/images/payment/2.jpg') }}" alt="payment-img"></a></li>
                                <li><a href="#"><img src="{{ url('frontend/images/payment/3.jpg') }}" alt="payment-img"></a></li>
                                <li><a href="#"><img src="{{ url('frontend/images/payment/4.jpg') }}" alt="payment-img"></a></li>
                                <li><a href="#"><img src="{{ url('frontend/images/payment/5.jpg') }}" alt="payment-img"></a></li>
                            </ul>
                            <div class="checkout-btn">
                                <a class="ts-btn btn-light btn-large hover-theme" href="#">CONFIRM & BUY NOW</a>
                            </div>    
                        </div>
                        <!-- End Payment Way -->
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
