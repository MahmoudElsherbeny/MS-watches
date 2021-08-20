@extends('backend.layouts.app')
@section('title') Dashboard | Slider @endsection

@section('content')
    
    <!-- Create Category Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update Slide {{ $slide->id }}</h4>
        </div>

        <div class="card-block">
            
            <!-- update category form with livewire  -->
            @livewire('backend.slider.update', ['slide' => $slide])

        </div>
    </div>
    <!-- End Create Category Form -->

@endsection