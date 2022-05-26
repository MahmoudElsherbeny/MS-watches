@extends('backend.layouts.app')
@section('title') Dashboard | States @endsection

@section('content')
    
    <!-- Create state Form -->
    <div class="card">
        <div class="card-header">
            <h4>Create New State</h4>
        </div>

        <div class="card-block">
            <!--  create new state form   -->
            @livewire('backend.states.create')

        </div>
    </div>
    <!-- End Create stat Form -->

@endsection