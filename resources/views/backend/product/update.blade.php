@extends('backend.layouts.app')
@section('title') Dashboard | Products @endsection

@section('content')
    
    <!-- update product Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update Product {{ $product->name }}</h4>
        </div>

        <div class="card-block">
            
            <!-- update product form with livewire  -->
            @livewire('backend.product.update', ['product' => $product])

        </div>
    </div>
    <!-- End update product Form -->

@endsection