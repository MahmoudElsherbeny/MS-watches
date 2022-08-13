@extends('backend.layouts.app')
@section('title') Dashboard | Products @endsection

@section('content')
    
    <!-- update product Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update Product {{ $product->name }}</h4>
        </div>

        <div class="card-block">
            
            <!-- update product form with livewire  -->
            @livewire('backend.product.update', ['product' => $product])

        </div>
    </div>
    <!-- End update product Form -->

@endsection

@section('js_code')
    <!-- tiny text -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#prod_description_edit',
            mobile: {
                theme: "mobile",
            },
        });
    </script>
@endsection