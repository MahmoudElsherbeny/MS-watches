@extends('backend.layouts.app')
@section('title') Dashboard | Slider @endsection

@section('content')

    <!-- Slider Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-xs">Slides (<span>{{count($slides)}}</span>)</h4>
                </div>
            </div>
        </div>
        <div class="card-block">
            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table id="CategoriesTable" class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">Slide</th>
                        <th class="text-center hidden-xs">Title</th>
                        <th class="text-center">Subtitle</th>
                        <th class="text-center">Order</th>
                        <th class="text-center w-15">Status</th>
                        <th class="text-center">Link To</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Last Update</th>
                        <th class="text-center" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($slides as $key=>$slide)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">
                                <img src="{{ url('storage/slides/'.$slide->image) }}" width="60" height="60" />
                            </td>
                            <td class="text-center hidden-xs">{{ $slide->title }}</td>
                            <td class="text-center">{{ $slide->sub_title }}</td>
                            <td class="text-center">{{ $slide->order }}</td>
                            <td class="text-center text-capitalize"> 
                                <span class="btn btn-sm btn-pill @if($slide->status == 'active') btn-primary @else btn-warning @endif">{{ $slide->status }}</span> 
                            </td>
                            <td class="text-center">{{ $slide->link }}</td>
                            <td class="text-center">{{ $slide->created_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">{{ $slide->updated_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('slider.edit', ['id' => $slide->id]) }}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-app" data-toggle="modal" data-target="#slide{{ $slide->id }}">Delete</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="slide{{ $slide->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-card-header">
                                                <div class="row">
                                                    <h4 class="col-md-11 text-left">Delete Slide</h4>
                                                    <ul class="card-actions col-md-1 p-t-md">
                                                        <li>
                                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block text-left">
                                                <p>Are you sure, you want to delete this slide ?</p>
                                                <p> <b>Notice:</b> if you want to hide slide, you can update it's status to not active instead of delete it.</p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::Open(['url' => route('slider.delete', ['id' => $slide->id]) ]) !!}                                                
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-app" type="submit"> Delete</button>
                                                {!! Form::Close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                            </td>
                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
        <!-- .card-block -->
    </div>
    <!-- End slider Table -->
    
@endsection