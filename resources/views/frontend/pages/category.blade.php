@extends('frontend.layouts.app')
@section('title')  {{ $category->name }} @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">{{ $category->name }}</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">{{ $category->name }}</span>
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
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list another-product-style">
                    <!-- Start Single Product -->
                    @include('frontend.product.card', ['products' => $products])
                    <!-- End Single Product -->
                    <!-- QUICKVIEW PRODUCT -->
                    @include('frontend.product.quickview', ['products' => $products])
                    <!-- END QUICKVIEW PRODUCT -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Our Product Area -->

@endsection
@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection