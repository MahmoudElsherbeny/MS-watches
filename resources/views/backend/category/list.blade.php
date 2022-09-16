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

@section('js_code')
<script>
    $(".field-sort").on("click", function(){
        var field = $(this).data('field');
        var dir = $(this).attr('direction');
        if(dir === 'asc') {
            $("#arrow_"+field).attr('class', 'fa fa-sort-up');
        }
        else if(dir === 'desc') {
            $("#arrow_"+field).attr('class', 'fa fa-sort-down');
        }
        else {
            $("#arrow_"+field).attr('class', 'fa fa-sort');
        }
    });
</script>
@endsection