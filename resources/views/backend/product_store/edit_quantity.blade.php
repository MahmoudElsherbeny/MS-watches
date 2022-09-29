@extends('backend.layouts.app')
@section('title') Dashboard | Products Store @endsection

@section('content')
    
    <!-- update product store Form -->
    <div class="card">
        <div class="card-header text-capitalize">
            <h4>Edit Product ({{ $product_store->product->name }}) Quantity</h4>
        </div>

        <div class="card-block">

            @livewire('backend.product_store.update', ['product_store' => $product_store])

        </div>
    </div>
    <!-- End update product store Form -->

@endsection
