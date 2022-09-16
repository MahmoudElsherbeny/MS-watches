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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector('#prod_description_edit') )
        .then( editor => {
            editor.model.document.on('change:data', () => {
                let description = $('#prod_description_edit').data('prod_description_edit');
                eval(description).set('description', editor.getData())
                console.log(description);
            });
        })
        .catch( error => {
            console.error(error);
        });
    </script>
@endsection