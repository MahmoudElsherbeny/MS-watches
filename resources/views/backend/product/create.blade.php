@extends('backend.layouts.app')
@section('title') Dashboard | Products @endsection

@section('content')
    
    <!-- Create product Form -->
    <div class="card">
        <div class="card-header">
            <h4>Create New Product</h4>
        </div>

        <div class="card-block">
            <!--  create new product form   -->
            @livewire('backend.product.create')

        </div>
    </div>
    <!-- End Create product Form -->

@endsection

@section('js_code')
    <!-- tiny text -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#prod_description',
            mobile: {
                theme: "mobile",
            },
        });
    </script>
@endsection