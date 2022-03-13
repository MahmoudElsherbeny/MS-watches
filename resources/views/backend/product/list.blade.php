@extends('backend.layouts.app')
@section('title') Dashboard | Products @endsection

@section('content')

@livewire('backend.product.products')
    
@endsection

@section('js_code')

    <!--  Ajax code for product live search  -->
    <script type="text/javascript">
        $('#prod_search').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url : '{{ route('product.index') }}',
                data:{'prod_search':$value},
                dataType: 'json',
                success:function(products){

                    $('tbody').html(products.data);
                    $('#prod_count').text(products.count);

                }
            });
        })
    </script>
        

    <!-- Page JS Code -->
    <script src="{{ url('backend/assets/js/pages/base_tables_datatables.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#ProductsTable').DataTable();
        } );
    </script>
@endsection