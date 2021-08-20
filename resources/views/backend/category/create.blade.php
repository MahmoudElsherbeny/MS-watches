@extends('backend.layouts.app')
@section('title') Dashboard | Categories @endsection

@section('content')
    
    <!-- Create Category Form -->
    <div class="card">
        <div class="card-header">
            <h4>Create New Category</h4>
        </div>

        <div class="card-block">
            
            <!-- create category form with livewire  -->
            @livewire('backend.category.create')

        </div>
    </div>
    <!-- End Create Category Form -->

@endsection