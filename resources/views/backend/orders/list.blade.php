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