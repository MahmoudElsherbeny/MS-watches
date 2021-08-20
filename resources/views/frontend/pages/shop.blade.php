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
                                <a class="filter__menu" href="#">filter</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Filter Menu -->
                <div class="filter__wrap">
                    <div class="filter__cart">
                        <div class="filter__cart__inner">
                            <div class="filter__content">
                                <!-- Start Single Content -->
                                <div class="fiter__content__inner">
                                    <div class="single__filter">
                                        <h2>Sort By</h2>
                                        <ul class="filter__list">
                                            <li>
                                                <input type="checkbox" />
                                                <span>Rate</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>Price</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>New</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="single__filter">
                                        <h2>Tags</h2>
                                        <ul class="filter__list">
                                            <li>
                                                <input type="checkbox" />
                                                <span>Men</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>Women</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>Kids</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="single__filter">
                                        <h2>Category</h2>
                                        <ul class="filter__list">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <input type="checkbox" />
                                                    <span>{{ $category->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="single__filter">
                                        <h2>Price</h2>
                                        <ul class="filter__list">
                                            <li>
                                                <input type="checkbox" />
                                                <span>Less Than $50</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>$50 - $100</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>$100 - $250</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>$250 - $500</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>$500 - $1000</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" />
                                                <span>$1000 Or More</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter Menu -->
                <!-- End Product MEnu --> 

                <div class="row">

                    <!--   livewire/frontend/shop.blade.php   -->
                    @livewire('frontend.shop')

                </div>


            </div>
        </div>
    </section>
    <!-- End Our Product Area -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection