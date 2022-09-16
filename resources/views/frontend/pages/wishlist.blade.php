
@extends('frontend.layouts.app')
@section('title')  Wishlist @endsection

@section('content')
        
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Wishlist</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">Wishlist</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- wishlist-area start -->
    <div class="wishlist-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <!--   livewire/frontend/wishlist.blade.php   -->
                    @livewire('frontend.wishlist.page')

                </div>
            </div>
        </div>
    </div>
    <!-- wishlist-area end -->
        
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection
    