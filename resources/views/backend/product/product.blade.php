@extends('backend.layouts.app')
@section('title') Dashboard | Product @endsection

@section('content')

    <!--  product info  -->
    <div class="card">
        <div class="card-block">
            <div class="product_page">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product_images">
                            <div class="row">
                                @foreach ($product->product_images as $image)
                                    <div class="col-md-6 m-b prod_image">
                                    @if (App\Product_image::isImage($image->image))
                                        <img src="{{ asset('storage/' . $image->image) }}" width="100%" height="230px" />
                                    @elseif (App\Product_image::isVideo($image->image))
                                        <video class="product_video" width="100%" height="230">
                                            <source src="{{ url('storage/products/'.$image->image) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="product-video-overlay"></div>
                                        <div class="product-video">
                                            <a class="video-popup" href="{{ url('storage/products/'.$image->image) }}">
                                                <i class="ion-ios-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product_info p-x-xs">
                            <h2 class="text-capitalize">{{ $product->name }}</h2>
                            <div class="product_price">
                                @if ($product->old_price > 0)
                                    <span class="old_price p-r-sm">&pound; {{ $product->old_price/100 }}</span>
                                    <span class="price">&pound; {{ $product->price/100 }}</span>
                                @else
                                    <span class="price">&pound; {{ $product->price/100 }}</span>
                                @endif
                            </div>
                            <div class="product_category m-y-sm">
                                <span class="cel1">Category: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->category->name }}</span>
                            </div>
                            <div class="mini_description m-y">{{ $product->mini_description }}</div>
                            <div class="product_color m-b">
                                @foreach ($product->attributes as $attr)
                                    <div class="body_color m-b-xs">
                                        <span class="cel1 text-capitalize">{{ $attr['type'] }}: </span>
                                        <span class="text-capitalize p-x-sm">{{ $attr['value'] }} </span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product_status">
                                <span class="cel1">Status: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->status }} </span>
                            </div>
                            <div class="product_status m-b">
                                <span class="cel1">Quantity: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->quantity }} </span>
                            </div>
                            <div class="publisher m-y">
                                <span class="cel1">Published By: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->published_by->name }} </span>
                            </div>
                            <div class="product_date m-y-sm">
                                <div class="created m-b-xs">
                                    <span class="cel1">Created At: </span>
                                    <span class="p-x-sm">{{ $product->created_at->format("Y-m-d H:i a") }} </span>
                                </div>
                                <div class="updated">
                                    <span class="cel1">Last Update: </span>
                                    <span class="p-x-sm">{{ $product->updated_at->format("Y-m-d H:i a") }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product_description m-y">
                    <h2>Description</h2>
                    <div class="m-y-sm">{!! $product->description !!}</div>
                </div>

                <div class="product_images m-y-lg">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h4 class="m-a-0 m-t-sm">Product Images ({{ count($product->product_images) }})</h4>
                        </div>
                        <div class="text-right col-md-6 col-sm-6">
                            <button class="btn btn-success" data-toggle="modal" data-target="#AddNewImage">Add New Image</button>
                            <!-- Modal -->
                            <div class="modal fade" id="AddNewImage" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Add New Product Image</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        {!! Form::Open(['url' => route('product.image_add', ['id' => $product->id]), 'files' => true ]) !!}
                                        <div class="card-block text-left">
                                            <label>Image:</label>
                                            <input class="form-control @error('image') input-error @enderror" type="file" name="image" accept="image/*, video/*" />
                                            @error('image')
                                                <div class="msg-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-success" type="submit"> Add</button>
                                        </div>
                                        {!! Form::Close() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>

                    <!--  product images table  -->
                    <table class="table table-striped table-vcenter js-dataTable-simple m-b-lg">
                        <thead>
                            <tr>
                                <th class="text-center w-5">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Order</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Last Update</th>
                                <th class="text-center" style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($product->product_images as $key=>$image)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $image->image }}</td>
                                    <td class="text-center">{{ $image->order }}</td>
                                    <td class="text-center">{{ $image->created_at->format("Y-m-d g:i a") }}</td>
                                    <td class="text-center">{{ $image->updated_at->format("Y-m-d g:i a") }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#EditImage{{ $image->id }}">Edit</button>
                                            <button class="btn btn-app" data-toggle="modal" data-target="#image{{ $image->id }}">Delete</button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="image{{ $image->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-card-header">
                                                        <div class="row">
                                                            <h4 class="col-md-11 text-left">Delete Product Image</h4>
                                                            <ul class="card-actions col-md-1 p-t-md">
                                                                <li>
                                                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block text-left">
                                                        <p>Are you sure, you want to delete product (<span class="text-capitalize">{{ $product->name }}</span>) image ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::Open(['url' => route('product.image_delete', ['id' => $product->id, 'image' => $image->id]) ]) !!}                                                
                                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                            <button class="btn btn-app" type="submit"> Delete</button>
                                                        {!! Form::Close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="EditImage{{ $image->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-card-header">
                                                        <div class="row">
                                                            <h4 class="col-md-11 text-left">Edit Product Image </h4>
                                                            <ul class="card-actions col-md-1 p-t-md">
                                                                <li>
                                                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    {!! Form::Open(['url' => route('product.image_edit', ['id' => $product->id,'image' => $image->id]) ]) !!}
                                                    <div class="card-block text-left">
                                                        <div class="form-group">
                                                            <label>Order:</label>
                                                            <input class="form-control @error('order') input-error @enderror" type="text" name="order" value="{{ $image->order }}" />
                                                            @error('order')
                                                                <div class="msg-error">{{ $message }}</div>
                                                            @enderror
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

                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                    
                </div>

            </div>

            <div class="form-group m-b-0 p-x-sm">
                <a href="{{ route('product.edit',['id' => $product->id]) }}" class="btn btn-success">Edit</a>
                <button class="btn btn-app" data-toggle="modal" data-target="#product{{ $product->id }}">Delete</button>
                <a href="{{ route('ProductStore.product_history',['prod_id' => $product->id, 'prod_name' => $product->name]) }}" class="btn btn-info">Show Store History</a>
                <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="product{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-card-header">
                            <div class="row">
                                <h4 class="col-md-11 text-left">Delete Product</h4>
                                <ul class="card-actions col-md-1 p-t-md">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block text-left">
                            <p>Are you sure, you want to delete product (<span class="text-capitalize">{{ $product->name }}</span>) ?</p>
                            <p> <b>Notice:</b> if you want to hide product, you can update it's status to not active instead of delete it.</p>
                        </div>
                        <div class="modal-footer">
                            {!! Form::Open(['url' => route('product.delete', ['id' => $product->id]) ]) !!}                                                
                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-app" type="submit"> Delete</button>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

        </div>
    </div>

@endsection