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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector('#prod_description') )
        .then( editor => {
            editor.model.document.on('change:data', () => {
                let description = $('#prod_description').data('prod_description');
                eval(description).set('description', editor.getData())
            });
        })
        .catch( error => {
            console.error(error);
        });
    </script>
@endsection