@extends('backend.layouts.app')
@section('title') Dashboard | Banners @endsection

@section('content')
    
    <!-- edit ad banner Form -->
    <div class="card">
        <div class="card-header">
            <h4>Edit Home Page Ad</h4>
        </div>

        <div class="card-block">
            
            <!-- edit banner form with livewire  -->
            @livewire('backend.banner.update', ['banner' => $banner])

        </div>
    </div>
    <!-- End edit ad banner Form -->

@endsection
