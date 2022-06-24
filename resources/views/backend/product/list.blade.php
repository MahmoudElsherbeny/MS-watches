@extends('backend.layouts.app')
@section('title') Dashboard | Products @endsection

@section('content')

<!-- products Table -->
<div class="card">
    <!--  products list table   -->
    @livewire('backend.product.productslist')
</div>
<!-- End products Table -->   

@endsection