@extends('backend.layouts.app')
@section('title') Dashboard | Product @endsection

@section('content')

    <!--  product info  -->
    <div class="card">
        <div class="card-block">
            <div class="product_page">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product_info p-x-sm">
                            <h2 class="text-capitalize">{{ $product->name }}</h2>
                            <div class="product_status m-b-xs">
                                <span class="cel1">Status: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->status }} </span>
                            </div>
                            <div class="product_status m-b-xs">
                                <span class="cel1">Total Quantity: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->all_quantity }} </span>
                            </div>
                            <div class="product_status m-b">
                                <span class="cel1">Quantity In Store Now: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->quantity }} </span>
                            </div>
                            <div class="product_price m-b-xs">
                                <span class="cel1">Avg Unit Price: </span>
                                <span class="price p-x-sm">&pound; {{ $avg_unit_price/100 }}</span>
                            </div>
                            <div class="product_price m-b-xs">
                                <span class="cel1">Price: </span>
                                <span class="price p-x-sm">&pound; {{ $product->price/100 }}</span>
                            </div>
                            <div class="product_price m-b-xs">
                                <span class="cel1">Profit: </span>
                                <span class="price p-x-sm">&pound; {{ ($product->price-$avg_unit_price)/100 }}</span>
                            </div>
                            <div class="product_price m-b">
                                <span class="cel1">Profit Precentage: </span>
                                <span class="price p-x-sm">%{{ number_format(($product->price-$avg_unit_price) / $product->price * 100,2) }}</span>
                            </div>
                            <div class="publisher m-b-xs">
                                <span class="cel1">Published By: </span>
                                <span class="text-capitalize p-x-sm">{{ $product->published_by->name }} </span>
                            </div>
                            <div class="created m-b-xs">
                                <span class="cel1">Created At: </span>
                                <span class="p-x-sm">{{ $product->created_at->format("Y-m-d H:i a") }} </span>
                            </div>
                            <div class="updated m-b-sm">
                                <span class="cel1">Last Update: </span>
                                <span class="p-x-sm">{{ $product->updated_at->format("Y-m-d H:i a") }} </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product_images m-y-lg">
                    <div class="row">
                        <div class="col-md-4 col-sm-3 col-xs-3">
                            <h4 class="m-a-0 m-y-sm">Store History ({{ count($product_stores) }})</h4>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0">
                            <div class="row">
                                {{ Form::Open(['method' => 'GET']) }}
                                <div class="col-md-5 col-sm-6 col-xs-6 p-x-0">
                                    <div class="form-group" style="display: flex; align-items:center">
                                        <label class="m-r-sm">From:</label>
                                        <input class="form-control" name="from" type="date" value="{{ $from }}" />
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-6 p-r-0">
                                    <div class="form-group" style="display: flex; align-items:center">
                                        <label class="m-r-sm">To:</label>
                                        <input class="form-control" name="to" type="date" value="{{ $to }}" />

                                        <button type="submit" class="btn btn-info m-l-sm"><i class="ion-ios-search-strong"></i></button>
                                    </div>
                                </div>
                                {{ Form::Close() }}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3 text-right">
                            <div class="btn-group">
                                <a href="{{ route('ProductStore.add') }}" class="btn btn-success">Add New Qty</a>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-md">
                        <strong>Notice:</strong> you can't delete product quantity if user make order on product after add it.
                    </div>

                    <!--   product history table   -->
                    <table id="ProductStoreList" class="table table-striped table-vcenter js-dataTable-simple m-b-md">
                        <thead>
                            <tr>
                                <th class="text-center w-5"></th>
                                <th class="text-center">Admin</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                <th>Created At</th>
                                <th>Last Update</th>
                                <th class="text-center" style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($product_stores as $key=>$prod)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center text-capitalize">{{ $prod->admin->name }}</td>
                                    <td class="text-center">{{ $prod->quantity }}</td>
                                    <td class="text-center">&pound; {{ $prod->unit_price/100 }}</td>
                                    <td class="text-center">&pound; {{ $prod->total/100 }}</td>
                                    <td class="text-center">{{ $prod->created_at->format("Y-m-d g:i a") }}</td>
                                    <td class="text-center">{{ $prod->updated_at->format("Y-m-d g:i a") }}</td>
                                    <td class="text-center">
                                        @if(Auth::guard('admin')->user()->role == 'admin')
                                        <div class="btn-group">
                                            <a href="{{ route('ProductStore.product_history',['prod_id' => $product->id, 'prod_name' => $product->name]) }}" class="btn btn-warning"><i class="ion-ios-compose-outline"></i></a>
                                            <button class="btn btn-app" data-toggle="modal" data-target="#product{{ $product->id }}"><i class="ion-ios-trash-outline"></i></button>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="product{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-card-header">
                                                        <div class="row">
                                                            <h4 class="col-md-11 text-left">Delete Product Qty Store</h4>
                                                            <ul class="card-actions col-md-1 p-t-md">
                                                                <li>
                                                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @if(App\Order_item::isOrdersAfterQtyAdd($prod->id, $prod->created_at))
                                                        {!! App\Order_item::isOrdersAfterQtyAdd($prod->id, $prod->created_at) !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>

                    {{ $product_stores->links() }}
                </div>

            </div>

            <div class="form-group m-b-0 p-x-sm">
                <a href="{{ route('ProductStore.index') }}" class="btn btn-primary">Back</a>
            </div>

        </div>
    </div>

@endsection