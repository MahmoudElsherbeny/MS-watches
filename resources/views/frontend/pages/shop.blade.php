@extends('frontend.layouts.app')
@section('title')  Shop @endsection

@section('content')

    <!-- Start Bradcaump area 
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
    End Bradcaump area -->
    <!-- Start Our Product Area -->
    <section class="htc__product__area shop__page pt--10 bg__white">
        <div class="shop_container">
            <div class="htc__product__container">
                <div class="row">

                    <!--   livewire/frontend/shop.blade.php   -->
                    @livewire('frontend.shop', ['search_for' => $search_for])

                </div>

            </div>
        </div>
    </section>
    <!-- End Our Product Area -->

@endsection