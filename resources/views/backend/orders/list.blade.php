@extends('backend.layouts.app')
@section('title') Dashboard | Orders @endsection

@section('content')

    <!-- Orders Table -->
    <div class="card">
        <!--  orders list table   -->
        @livewire('backend.order.orderslist')
    </div>
    <!-- End Orders Table -->

@endsection
