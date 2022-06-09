@extends('backend.layouts.app')
@section('title') Dashboard | Website Brands @endsection

@section('content')
    
    <!-- Update Website brand Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update brand {{ $brand->name }}</h4>
        </div>

        <div class="card-block">
            
            <!-- update category form with livewire  -->
            @livewire('backend.setting.website_brands.update', ['brand' => $brand])

        </div>
    </div>
    <!-- End Update Website brand Form -->

@endsection