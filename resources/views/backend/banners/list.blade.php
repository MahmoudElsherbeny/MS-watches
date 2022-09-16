@extends('backend.layouts.app')
@section('title') Dashboard | Banners @endsection

@section('content')

    <!-- Ads Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-sm">Home Page Banners (<span>{{ count($banners) }}</span>)</h4>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <a href="{{ route('Banner.create') }}" class="btn btn-success">Create New Banner</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <!--  banners list and update   -->
            <table id="AdsTable" class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5"></th>
                        <th class="">Banner</th>
                        <th class="">Product</th>
                        <th class="">Status</th>
                        <th class="">Created At</th>
                        <th class="">Last Update</th>
                        <th class="" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach ($banners as $banner)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center text-capitalize">
                                <img src="{{ asset('storage/'.$banner->image) }}" width="100" height="50" />
                            </td>
                            <td class="text-center">
                                <a href="{{ route('product.info', ['id' => $banner->product_id]) }}" style="text-decoration:underline;" target="_blank">{{ $banner->product->name }}</a>
                            </td>
                            <td class="text-center text-capitalize">
                                <span class="status btn btn-sm btn-pill @if($banner->status == 'active') btn-primary @else btn-warning @endif">{{ $banner->status }}</span> 
                            </td>
                            <td class="text-center">{{ $banner->created_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">{{ $banner->updated_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('Banner.edit', ['id' => $banner->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                    <button class="btn btn-app" data-toggle="modal" data-target="#AdDelete{{ $banner->id }}"><i class="ion-ios-trash-outline"></i></button>
                                </div>
                            </td>

                            <!-- delete Modal -->
                            <div class="modal fade" id="AdDelete{{ $banner->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Delete Ad</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block text-left">
                                            <p>Are you sure, you want to delete this Ad ?</p>
                                            <p> <b>Notice:</b> if you want to hide Ad, you can update it's status to not active instead of delete it. </p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::Open(['url' => route('Banner.delete', ['id' => $banner->id]) ]) !!}                                                
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-app" type="submit"> Delete</button>
                                            {!! Form::Close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
        
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>
        <!-- .card-block -->
    </div>
    <!-- End Ads Table -->
    
@endsection