@extends('backend.layouts.app')
@section('title') Dashboard | Editors @endsection

@section('content')

    <!-- Editors Table -->
    <div class="card">
        <!--  Editors list table   -->
        @livewire('backend.editor.editorslist')
    </div>
    <!-- End Editors Table -->
    
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