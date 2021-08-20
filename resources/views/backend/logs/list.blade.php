@extends('backend.layouts.app')
@section('title') Dashboard | Logs @endsection

@section('content')

    <!-- logs Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="m-a-0 m-t-xs">Dashboard logs (<span id="logs_count">@if($logs){{count($logs)}}@endif</span>)</h4>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="form-control" type="date" name="search" id="logs_search" value="{{ now()->toDateString() }}" />
                    </div>
                </div>
                <div class="col-md-1">
                    {!! Form::Open(['url'=>route('DashLogs.delete')]) !!}
                    <div class="form-group">
                        <button class="btn btn-app" type="submit">Clear All</button>
                    </div>
                    {!! Form::Close() !!}
                </div>
            </div>
        </div>
        <div class="card-block">
            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table id="CategoriesTable" class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">User</th>
                        <th class="text-center hidden-xs">User Role</th>
                        <th class="text-center">Log</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($logs as $key=>$log)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">{{ App\Admin::getAdminName($log->user) }}</td>
                            <td class="text-center hidden-xs">{{ App\Admin::getAdminRole($log->user) }}</td>
                            <td class="text-center">{{ $log->log }}</td>
                            <td class="text-center">{{ $log->date->format("Y-m-d g:i a") }}</td>
                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
        <!-- .card-block -->
    </div>
    <!-- End Categorie Table -->
    
@endsection

@section('js_code')

    <!--  Ajax code for category live search  -->
    <script type="text/javascript">
        $('#logs_search').on('change',function(){
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url : '{{ route('DashLogs.index') }}',
                data:{'logs_search':$value},
                dataType: 'json',
                success:function(logs){

                    $('tbody').html(logs.data);
                    $('#logs_count').text(logs.count);

                }
            });
        })
    </script>
        

    <!-- Page JS Code -->
    <script src="{{ url('backend/assets/js/pages/base_tables_datatables.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready( function () {
            $('#CategoriesTable').DataTable();
        } );
    </script>
@endsection