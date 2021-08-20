@extends('backend.layouts.app')
@section('title') Dashboard | Slider @endsection

@section('content')
    
    <!-- Create Slide Form -->
    <div class="card">
        <div class="card-header">
            <h4>Create New Slide</h4>
        </div>
        <div class="card-block">
            
            <!-- create slide form with livewire  -->
            @livewire('backend.slider.create')

        </div>
    </div>
    <!-- End Create Slide Form -->

@endsection