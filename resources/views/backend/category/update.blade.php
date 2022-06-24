@extends('backend.layouts.app')
@section('title') Dashboard | Categories @endsection

@section('content')
    
    <!-- update Category Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update Category {{ $category->name }}</h4>
        </div>

        <div class="card-block">
            
            <!-- update category form with livewire  -->
            @livewire('backend.category.update', ['category' => $category])

        </div>
    </div>
    <!-- End update Category Form -->

@endsection