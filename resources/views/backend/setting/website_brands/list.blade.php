@extends('backend.layouts.app')
@section('title') Dashboard | Website Brands @endsection

@section('content')

    <!-- Setting Table -->
    <div class="card">
        <!--  brands list table   -->
        @livewire('backend.setting.website_brands.brandslist')
    </div>
    <!-- End Setting Table -->
    
@endsection