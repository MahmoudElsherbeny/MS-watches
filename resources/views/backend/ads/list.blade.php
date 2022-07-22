@extends('backend.layouts.app')
@section('title') Dashboard | Ads @endsection

@section('content')

    <!-- Ads Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-sm">Home Page Ads (<span>{{count($ads)}}</span>)</h4>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <a href="{{ route('AdsBanner.create') }}" class="btn btn-success">Create New Ad</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <!--  ads list and update   -->
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
        
                    @foreach ($ads as $key => $ad)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">
                                <img src="{{ asset('storage/'.$ad->image) }}" width="100" height="50" />
                            </td>
                            <td class="text-center">
                                <a href="{{ route('product.info', ['id' => $ad->product_id]) }}" style="text-decoration:underline;" target="_blank">{{ $ad->product->name }}</a>
                            </td>
                            <td class="text-center text-capitalize">
                                <span class="status btn btn-sm btn-pill @if($ad->status == 'active') btn-primary @else btn-warning @endif">{{ $ad->status }}</span> 
                            </td>
                            <td class="text-center">{{ $ad->created_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">{{ $ad->updated_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('AdsBanner.edit', ['id' => $ad->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                    <button class="btn btn-app" data-toggle="modal" data-target="#AdDelete{{ $ad->id }}"><i class="ion-ios-trash-outline"></i></button>
                                </div>
                            </td>

                            <!-- delete Modal -->
                            <div class="modal fade" id="AdDelete{{ $ad->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            {!! Form::Open(['url' => route('AdsBanner.delete', ['id' => $ad->id]) ]) !!}                                                
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