@extends('backend.layouts.app')
@section('title') Dashboard | Category @endsection

@section('content')

    <!--  category info  -->
    <div class="card">
        <div class="card-block">
            <div class="product_page">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product_info p-x-sm">
                            <h2 class="text-capitalize">{{ $category->name }}</h2>
                            <div class="product_status m-b-xs">
                                <span class="cel1">Status: </span>
                                <span class="text-capitalize p-x-sm">{{ $category->status }} </span>
                            </div>
                            <div class="product_status m-b-xs">
                                <span class="cel1">Number Of Products: </span>
                                <span class="text-capitalize p-x-sm">{{ count($category->products) }} </span>
                            </div>
                            <div class="product_status m-b">
                                <span class="cel1">High Sales Product: </span>
                                <span class="text-capitalize p-x-sm"></span>
                            </div>
                            <div class="product_price m-b-xs">
                                <span class="cel1">Avg sales: </span>
                                <span class="price p-x-sm"></span>
                            </div>
                            <div class="created m-b-xs">
                                <span class="cel1">Created At: </span>
                                <span class="p-x-sm">{{ $category->created_at->format("Y-m-d g:i a") }} </span>
                            </div>
                            <div class="updated m-b-sm">
                                <span class="cel1">Last Update: </span>
                                <span class="p-x-sm">{{ $category->updated_at->format("Y-m-d g:i a") }} </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--   category slides   -->
                <div class="product_images m-y-lg">
                    <div class="p-y-sm">
                        <h4 class="m-a-0 m-y-sm">Slides ({{ count($category_slides) }})</h4>
                    </div>
                    <table class="table table-striped table-vcenter js-dataTable-simple m-b-md">
                        <thead>
                            <tr>
                                <th class="text-center w-5"></th>
                                <th class="text-center">Slide</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($category_slides as $slide)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center text-capitalize">
                                        <img src="{{ asset('storage/'.$slide->image) }}" width="78" height="60">
                                    </td>
                                    <td class="text-center">{{ $slide->title }}</td>
                                    <td class="text-center">{{ $slide->order }}</td>
                                    <td class="text-center">
                                        <span class="status btn btn-sm btn-pill @if($prod->status == 'active') btn-primary @else btn-warning @endif">{{ $prod->status }}</span> 
                                    </td>
                                    <td class="text-center">{{ $slide->created_at->format("Y-m-d g:i a") }}</td>
                                    <td class="text-center">{{ $slide->updated_at->format("Y-m-d g:i a") }}</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>

                </div>
                <!--   category products   -->
                <div class="product_images m-y-lg">
                    <div class="p-y-sm">
                        <h4 class="m-a-0 m-y-sm">Products ({{ count($category->products) }})</h4>
                    </div>
                    <table id="ProductStoreList" class="table table-striped table-vcenter js-dataTable-simple m-b-md">
                        <thead>
                            <tr>
                                <th class="text-center w-5"></th>
                                <th class="text-center">Name</th>
                                <th>Price(EG)</th>
                                <th>Old Price</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Created At</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($category->products as $prod)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center text-capitalize">{{ $prod->name }}</td>
                                    <td class="text-center">&pound; {{ $prod->price/100 }}</td>
                                    <td class="text-center">&pound; {{ $prod->old_price/100 }}</td>
                                    <td class="text-center">
                                        <span class="status btn btn-sm btn-pill @if($prod->status == 'active') btn-primary @else btn-warning @endif">{{ $prod->status }}</span> 
                                    </td>
                                    <td class="text-center">
                                        @if($prod->quantity > 0) 
                                            {{ $prod->quantity }}
                                        @else
                                            <span class="status btn btn-sm btn-pill btn-danger">Out Stock</span> 
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $prod->created_at->format("Y-m-d g:i a") }}</td>
                                    <td class="text-center">{{ $prod->updated_at->format("Y-m-d g:i a") }}</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection