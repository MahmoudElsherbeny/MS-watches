<div>

    <div class="card-header">
        <div class="row">
            <div class="col-md-7">
                <h4 class="m-a-0 m-t-xs">Dashboard logs (<span id="logs_count">@if($logs){{ $logs->total() }}@endif</span>)</h4>
            </div>
            <div class="col-md-5">
                <div class="form-group col-md-9">
                    <input wire:model="logs_search" class="form-control" type="date" name="search" />
                </div>
                <div class="form-group col-md-3">
                    {!! Form::Open(['url'=>route('DashLogs.delete')]) !!}
                    <div class="form-group">
                        <button class="btn btn-app" type="submit">Clear All</button>
                    </div>
                    {!! Form::Close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <!-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="DashlogsTable" class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="text-center w-5"></th>
                    <th>User</th>
                    <th class="hidden-xs">User Role</th>
                    <th class="text-center">Log</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($logs as $key=>$log)
                    <tr>
                        <td class="text-center">{{ $logs->firstItem() + $key }}</td>
                        <td class="text-center text-capitalize">{{ $log->admin['name'] }}</td>
                        <td class="text-center hidden-xs">{{ $log->admin['role'] }}</td>
                        <td class="text-center">{{ $log->log }}</td>
                        <td class="text-center">{{ $log->date->format("Y-m-d g:i a") }}</td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>

        {{ $logs->links() }}
    </div>
    <!-- .card-block -->

</div>
