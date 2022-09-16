@extends('backend.layouts.app')
@section('title') Dashboard | Banners @endsection

@section('content')
    
    <!-- Create ad banner Form -->
    <div class="card">
        <div class="card-header">
            <h4>Create New Home Page Banner</h4>
        </div>

        <div class="card-block">
            
            <!-- create banner form with livewire  -->
            @livewire('backend.banner.create')

        </div>
    </div>
    <!-- End Create ad banner Form -->

@endsection
