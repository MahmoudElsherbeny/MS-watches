@extends('backend.layouts.app')
@section('title') Dashboard | Products reviews @endsection

@section('content')

<!-- products Table -->
<div class="card">
        
        <!--  products eviews list   -->
        @livewire('backend.product.review')

</div>
<!-- End products Table -->   

@endsection