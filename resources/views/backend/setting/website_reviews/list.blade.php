@extends('backend.layouts.app')
@section('title') Dashboard | Website Reviews @endsection

@section('content')

    <!-- Setting Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    <h4 class="m-a-0 m-t-sm">Website Reviews (<span>{{count($reviews)}}</span>)</h4>
                </div>
                <div class="col-md-7">
                    <div class="form-group text-right">
                        <a href="{{ route('product.reviews') }}" class="btn btn-success">Add More Reviews</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <table class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Review</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 12%;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($reviews as $key=>$review)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">{{ $review->product_review->user->name }}</td>
                            <td class="text-center">{{ $review->product_review->review }}</td>
                            <td class="text-center">
                                <span class="status btn btn-sm btn-pill @if($review->status == 'active') btn-primary @else btn-warning @endif">{{ $review->status }}</span> 
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#UpdateReview{{ $review->id }}"><i class="ion-ios-compose-outline"></i></button>
                                    <button class="btn btn-app" data-toggle="modal" data-target="#Review{{ $review->id }}"><i class="ion-ios-trash-outline"></i></button>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="UpdateReview{{ $review->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-card-header">
                                                <div class="row">
                                                    <h4 class="col-md-11 text-left">Update Review Status</h4>
                                                    <ul class="card-actions col-md-1 p-t-md">
                                                        <li>
                                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            {!! Form::Open(['url' => route('setting.review_update', ['id' => $review->id]) ]) !!}
                                            <div class="card-block text-left">
                                                <div class="form-group">
                                                    <label>Status:</label>
                                                    <select class="form-control" name="status">
                                                        <option value="active" @if($review->status == 'active') selected @endif>Active</option>
                                                        <option value="not active" @if($review->status == 'not active') selected @endif>Not Active</option>
                                                    </select>
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
                                <!-- Delete Modal -->
                                <div class="modal fade" id="Review{{ $review->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-card-header">
                                                <div class="row">
                                                    <h4 class="col-md-11 text-left">Remove Review</h4>
                                                    <ul class="card-actions col-md-1 p-t-md">
                                                        <li>
                                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block text-left">
                                                <p>Are you sure, you want to remove this review as weebsite review ?</p>
                                                <p> <b>Notice:</b> if you want to hide review, you can update it's status to not active instead of remove it.</p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::Open(['url' => route('setting.review_delete', ['id' => $review->id]) ]) !!}                                                
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-app" type="submit"> Remove</button>
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
    <!-- End Setting Table -->
    
@endsection