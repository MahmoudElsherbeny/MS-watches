@extends('backend.layouts.app')
@section('title') Dashboard | Categories @endsection

@section('content')

    <!-- Categories Table -->
    <div class="card">
        <!--  Categories list table   -->
        @livewire('backend.category.categorieslist')
    </div>
    <!-- End Categories Table -->
    
@endsection