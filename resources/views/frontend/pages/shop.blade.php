@extends('frontend.layouts.app')
@section('title')  Shop @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Shop</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">Shop</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Our Product Area -->
    <section class="htc__product__area shop__page pt--50 pb--50 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <!-- Start Product MEnu -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter__menu__container">
                            <div class="product__menu">
                                <button data-filter="*"  class="is-checked">All</button>
                                <button data-filter=".cat--1">Watches</button>
                            </div>
                            <div class="filter__box">
                                <button class="filter__menu">filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--   livewire/frontend/shop.blade.php   -->
                @livewire('frontend.shop')

            </div>
        </div>
    </section>
    <!-- End Our Product Area -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection