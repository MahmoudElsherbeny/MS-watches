@extends('backend.layouts.app')
@section('title') Dashboard | Setting @endsection

@section('content')
    
    <!-- Create Category Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update Settings</h4>
        </div>

        <div class="card-block">
            
            <!-- update category form with livewire  -->
            @livewire('backend.setting.update')

        </div>
    </div>
    <!-- End Create Category Form -->

@endsection