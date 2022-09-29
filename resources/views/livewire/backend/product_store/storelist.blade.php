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
        <table class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="text-center field-sort w-5" wire:click="sortBy('id')" data-field="id" direction="{{ ($sort_field == 'id' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span wire:ignore><i id="arrow_id" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('name')" data-field="name" direction="{{ ($sort_field == 'name' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Name</span>
                        <span wire:ignore><i id="arrow_name" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('all_quantity')" data-field="all_quantity" direction="{{ ($sort_field == 'all_quantity' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">All Quantity</span>
                        <span wire:ignore><i id="arrow_all_quantity" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('quantity')" data-field="quantity" direction="{{ ($sort_field == 'quantity' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Quantity Now</span>
                        <span wire:ignore><i id="arrow_quantity" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('updated_at')" data-field="updated_at" direction="{{ ($sort_field == 'updated_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Last Update</span>
                        <span wire:ignore><i id="arrow_updated_at" class="fa fa-sort"></i></span>
                    </th>
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
                            @if($product->getRemainProductQtyPercentage($product->id) > 0)
                                <span class="status btn btn-sm btn-pill 
                                    @if($product->getRemainProductQtyPercentage($product->id) < 20 || $product->quantity <= 2)
                                        btn-warning
                                    @else
                                        btn-success
                                    @endif
                                    ">
                                    {{ $product->quantity }}
                                </span>
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
