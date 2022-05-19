@extends('backend.layouts.app')
@section('title') Dashboard | Products reviews @endsection

@section('content')

<!-- products Table -->
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-a-0 m-t-xs">Products Reviews (<span id="prod_count">@if($products_reviews){{ $products_reviews->total() }}@endif</span>)</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="search" id="prod_search" placeholder="Product Search..." />
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table id="ProductsTable" class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="w-4 text-center"></th>
                    <th class="">Name</th>
                    <th class="">Review</th>
                    <th class="">Rate</th>
                    <th class="text-center" style="width: 12%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products_reviews as $key=>$product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $key }}</td>
                        <td class="text-center text-capitalize">
                            <a href="{{ route('product.info', ['id' => $product->id]) }}" style="text-decoration:underline;" target="_blank">{{ $product->product }}</a>
                        </td>
                        <td class="text-center">{{ $product->review }}</td>
                        <td class="text-center">{{ $product->rate }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-warning"><i class="ion-ios-pricetags-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
    <!-- .card-block -->

</div>
<!-- End products Table -->   

@endsection