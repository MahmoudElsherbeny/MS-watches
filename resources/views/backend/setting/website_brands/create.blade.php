@extends('backend.layouts.app')
@section('title') Dashboard | Website Brands @endsection

@section('content')
    
    <!-- Add new brand Form -->
    <div class="card">
        <div class="card-header">
            <h4>Add New Brand</h4>
        </div>

        <div class="card-block">
            <!--  Add new brand form   -->
            @livewire('backend.setting.website_brands.create')

        </div>
    </div>
    <!-- End Add new brand Form -->

@endsection