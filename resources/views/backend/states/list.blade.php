@extends('backend.layouts.app')
@section('title') Dashboard | States @endsection

@section('content')

    <!-- States Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    <h4 class="m-a-0 m-t-sm">States (<span>{{count($states)}}</span>)</h4>
                </div>
                <div class="col-md-7">
                    <div class="text-right">
                        <a href="{{ route('state.create') }}" class="btn btn-success">Create New State</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <!--  states list and update   -->
            <table id="StatesTable" class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5"></th>
                        <th class="">State</th>
                        <th class="">Delivery</th>
                        <th class="">Created At</th>
                        <th class="">Last Update</th>
                        <th class="" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach ($states as $key=>$state)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">{{ $state->state }}</td>
                            <td class="text-center">£{{ $state->delivery }}</td>
                            <td class="text-center">{{ $state->created_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">{{ $state->updated_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#StateEdit{{ $state->id }}"><i class="ion-ios-compose-outline"></i></button>
                                    @if(Auth::guard('admin')->user()->role == 'admin')
                                        <button class="btn btn-app" data-toggle="modal" data-target="#StateDelete{{ $state->id }}"><i class="ion-ios-trash-outline"></i></button>
                                    @endif
                                </div>
                            </td>
        
                            <!-- edit Modal -->
                            <div class="modal fade" id="StateEdit{{ $state->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Edit State ({{ $state->state }})</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        {!! Form::Open(['url' => route('state.update', ['id' => $state->id]) ]) !!}
                                        <div class="card-block text-left">
                                            <div class="form-group">
                                                <label>State:</label>
                                                <input class="form-control" type="text" value="{{ $state->state }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Delivery Cost:</label>
                                                <input class="form-control" type="text" name="delivery" value="{{ old('delivery', $state->delivery) }}" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                            <button class="btn btn-success" type="submit"> Update</button>
                                        </div>
                                        {!! Form::Close() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                            @if(Auth::guard('admin')->user()->role == 'admin')
                            <!-- delete Modal -->
                            <div class="modal fade" id="StateDelete{{ $state->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Delete State</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block text-left">
                                            <p>Are you sure, you want to delete state (<span class="text-capitalize">{{ $state->state }}</span>) ?</p>
                                            <p> <b>Notice:</b>  be sure that there is no orders related to it before deleting.</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::Open(['url' => route('state.delete', ['id' => $state->id]) ]) !!}                                                
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-app" type="submit"> Delete</button>
                                            {!! Form::Close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            @endif
        
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>
        <!-- .card-block -->
    </div>
    <!-- End States Table -->
    
@endsection