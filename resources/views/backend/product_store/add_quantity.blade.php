@extends('backend.layouts.app')
@section('title') Dashboard | Products Store @endsection

@section('content')
    
    <!-- Create product Form -->
    <div class="card">
        <div class="card-header">
            <h4>Add Product New Quantity</h4>
        </div>

        <div class="card-block">
            
            @livewire('backend.product_store.create')

        </div>
    </div>
    <!-- End Create product Form -->

@endsection
