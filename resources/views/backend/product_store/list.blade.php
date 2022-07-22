@extends('backend.layouts.app')
@section('title') Dashboard | Product Store @endsection

@section('content')

    <!-- products store Table -->
    <div class="card">
        <!--  orders list table   -->
        @livewire('backend.product_store.storelist')
    </div>
    <!-- End products store Table -->
    
@endsection