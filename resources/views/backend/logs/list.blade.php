@extends('backend.layouts.app')
@section('title') Dashboard | Logs @endsection

@section('content')

    <!-- dashboard logs Table -->
    <div class="card">
        <!--  dashboard logs list table   -->
        @livewire('backend.logs.logslist')
    </div>
    <!-- End dashboard logs Table -->
    
@endsection