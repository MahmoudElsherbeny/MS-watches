@extends('frontend.layouts.app')
@section('title')  About Us @endsection

@section('content')
        
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">About Us</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">About Us</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area --> 
    <!-- Start Our Store Area -->
    <section class="htc__store__area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section__title section__title--2 text-center">
                        <h2 class="title__line">Welcome To {{ App\Setting::getSettingValue('name') }} Watches Store</h2>
                        <p>{{ App\Setting::getSettingValue('about') }}</p>
                    </div>
                    <div class="store__btn">
                        <a href="{{ route('contact.index') }}">contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Our Store Area -->
    <!-- Start Choose Us Area -->
    <section class="htc__choose__us__ares bg__white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="video__wrap" data--black__overlay="5" style="background: rgba(0, 0, 0, 0) url({{ asset('storage/'.App\Setting::getSettingValue('image')) }}) no-repeat scroll center center / cover;">
                        <div class="video__inner">
                            @if (App\Setting::getSettingValue('video'))
                                <a class="video__trigger video-popup" href="{{ asset('storage/'.App\Setting::getSettingValue('video') ) }}">
                                    <i class="zmdi zmdi-play"></i>
                                </a> 
                            @endif                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="htc__choose__wrap bg__cat--4">
                        <h2 class="choose__title">Why Choose Us?</h2>
                        <div class="choose__container">
                            <div class="single__chooose">
                                <div class="choose__us">
                                    <div class="choose__icon">
                                        <span class="ti-heart"></span>
                                    </div>
                                    <div class="choose__details">
                                        <h4>Free Gift Box</h4>
                                        <p>You will recive our box and our bag for gift. </p>
                                    </div>
                                </div>
                                <div class="choose__us">
                                    <div class="choose__icon">
                                        <span class="ti-truck"></span>
                                    </div>
                                    <div class="choose__details">
                                        <h4>Fast Delivery</h4>
                                        <p>We deliverd your order in 24 hours and 3 days at more for far places . </p>
                                    </div>
                                </div>
                            </div>
                            <div class="single__chooose">
                                <div class="choose__us">
                                    <div class="choose__icon">
                                        <span class="ti-reload"></span>
                                    </div>
                                    <div class="choose__details">
                                        <h4>Money Back</h4>
                                        <p>You can retrival your order back in 24 hour if there any problem. </p>
                                    </div>
                                </div>
                                <div class="choose__us">
                                    <div class="choose__icon">
                                        <span class="ti-time"></span>
                                    </div>
                                    <div class="choose__details">
                                        <h4>Support 24</h4>
                                        <p>We are in your service for 24 hours per day. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Choose Us Area -->
    <!-- Start our location Area -->
    <section class="htc__contact__area bg__white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="htc__contact__container">
                        <div class="htc__contact__address">
                            <h2 class="contact__title">Our Location</h2>
                            <div class="contact__address__inner">
                                <!-- Start Single Adress -->
                                <div class="single__contact__address">
                                    <div class="contact__icon">
                                        <span class="ti-location-pin"></span>
                                    </div>
                                    <div class="contact__details">
                                        <p>Location : <br> {{ App\Setting::getSettingValue('address') }}</p>
                                    </div>
                                </div>
                                <!-- End Single Adress -->
                            </div>
                            <div class="contact__address__inner">
                                <!-- Start Single Adress -->
                                <div class="single__contact__address">
                                    <div class="contact__icon">
                                        <span class="ti-mobile"></span>
                                    </div>
                                    <div class="contact__details">
                                        <p> Phone : <br>{{ App\Setting::getSettingValue('phone') }} </p>
                                    </div>
                                </div>
                                <!-- End Single Adress -->
                            </div>
                            <div class="contact__address__inner">
                                <!-- Start Single Adress -->
                                <div class="single__contact__address">
                                    <div class="contact__icon">
                                        <span class="ti-email"></span>
                                    </div>
                                    <div class="contact__details">
                                        <p> Mail :<br><a href="">{{ App\Setting::getSettingValue('email') }}</a></p>
                                    </div>
                                </div>
                                <!-- End Single Adress -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                    <div class="map-contacts">
                        <div id="googleMap">
                            <iframe src="{{ App\Setting::getSettingValue('location') }}" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Testimonial Area -->
    <div class="htc__testimonial__area ptb--120" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;" data--black__overlay="6">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="testimonial__wrap owl-carousel owl-theme clearfix">
                    @foreach ($reviews as $review)
                        <!-- Start Single Testimonial -->
                        <div class="testimonial">
                            <div class="testimonial__thumb">
                                <img src="{{ url('frontend/images/test/client/1.png') }}" alt="testimonial images">
                            </div>
                            <div class="testimonial__details">
                                <p>{{ $review->product_review->review }}</p>
                                <div class="test__info">
                                    <span><a href="#">{{ $review->product_review->user->name }}</a></span>
                                    <span> - </span>
                                    <span>Customer</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Testimonial -->
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Area -->
    <!-- Start brand Area -->
    <div class="htc__brand__area bg__white ptb--120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="brand__list">
                    @foreach ($brands as $brand)
                        <li>
                            <a href="{{ $brand->link }}" target="_blank">
                                <img src="{{ asset('storage/' . $brand->image) }}" title="{{ $brand->name }}" alt="brand images">
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End brand Area -->
        
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection