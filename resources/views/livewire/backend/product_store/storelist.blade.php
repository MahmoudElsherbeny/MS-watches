<div>
    
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 col-sm-4 col-xs-4">
                <h4 class="m-a-0 m-t-xs">Products Store (<span>@if($products){{$products->total()}}@else 0 @endif</span>)</h4>
            </div>
            <div class="col-md-6 col-sm-8 col-xs-8">
                <div class="form-group">
                    <input wire:model="store_search" class="form-control" type="text" name="search" placeholder="product Search..." />
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table id="ProductsStoreTable" class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="text-center w-5"></th>
                    <th>Name</th>
                    <th>All Quantity</th>
                    <th>Quantity Now</th>
                    <th>Last Update</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $key => $product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $key }}</td>
                        <td class="text-center text-capitalize">
                            <a href="{{ route('product.info', ['id' => $product->id]) }}" style="text-decoration:underline;" target="_blank">{{ $product->name }}</a>
                        </td>
                        <td class="text-center">{{ $product->all_quantity }}</td>
                        <td class="text-center">
                            @if($product->quantity > 0) 
                                {{ $product->quantity }}
                            @else
                                <span class="status btn btn-sm btn-pill btn-danger">Out Stock</span> 
                            @endif
                        </td>
                        <td class="text-center">@if($product->products_stores) {{ $product->updated_at->format("Y-m-d g:i a") }} @endif</td>
                        <td class="text-center">
                            <a href="{{ route('ProductStore.product_history',['prod_id' => $product->id, 'prod_name' => $product->name]) }}" class="btn btn-info">Show History</a>
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
    <!-- .card-block -->

</div>
