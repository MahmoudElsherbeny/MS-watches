<div>

    <div class="card-header">
        <div class="row">
            <div class="col-md-5">
                <h4 class="m-a-0 m-t-xs">Products (<span id="prod_count">@if($products){{ $products->total() }}@endif</span>)</h4>
            </div>
            <div class="col-md-7">
                <div class="form-group col-md-9">
                    <input wire:model="product_search" class="form-control" type="text" name="search"placeholder="Product Name Search..." />
                </div>
                <div class="form-group col-md-3">
                    <a href="{{ route('product.create') }}" class="btn btn-success">Create product</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="w-4 text-center field-sort" wire:click="sortBy('id')" data-field="id" direction="{{ ($sort_field == 'id' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span wire:ignore><i id="arrow_id" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('name')" data-field="name" direction="{{ ($sort_field == 'name' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Name</span>
                        <span wire:ignore><i id="arrow_name" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('category_id')" data-field="category_id" direction="{{ ($sort_field == 'category_id' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Category</span>
                        <span wire:ignore><i id="arrow_category_id" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('price')" data-field="price" direction="{{ ($sort_field == 'price' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Price(EGP)</span>
                        <span wire:ignore><i id="arrow_price" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort">Old Price</th>
                    <th class="text-center field-sort" wire:click="sortBy('status')" data-field="status" direction="{{ ($sort_field == 'status' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Status</span>
                        <span wire:ignore><i id="arrow_status" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('quantity')" data-field="quantity" direction="{{ ($sort_field == 'quantity' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Quantity</span>
                        <span wire:ignore><i id="arrow_quantity" class="fa fa-sort"></i></span>
                    </th>
                    <th class="hidden-xs">Added By</th>
                    <th class="text-center field-sort" wire:click="sortBy('created_at')" data-field="created_at" direction="{{ ($sort_field == 'created_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Created At</span>
                        <span wire:ignore><i id="arrow_created_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('updated_at')" data-field="updated_at" direction="{{ ($sort_field == 'updated_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Last Update</span>
                        <span wire:ignore><i id="arrow_updated_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center" style="width: 12%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $key => $product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $key }}</td>
                        <td class="text-center text-capitalize">
                            <a href="{{ route('product.info', ['id' => $product->id]) }}" style="text-decoration:underline;" target="_blank">{{ $product->name }}</a>
                        </td>
                        <td class="text-center">{{ $product->category->name }}</td>
                        <td class="text-center">&pound; {{ $product->price/100 }}</td>
                        <td class="text-center old_price">&pound; {{ $product->old_price/100 }}</td>
                        <td class="text-center text-capitalize"> 
                            <span class="status btn btn-sm btn-pill @if($product->status == 'active') btn-primary @else btn-warning @endif">{{ $product->status }}</span> 
                        </td>
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
                        <td class="text-center text-capitalize hidden-xs">{{ $product->published_by->name }}</td>
                        <td class="text-center">{{ $product->created_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">{{ $product->updated_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#SaleProduct{{ $product->id }}"><i class="ion-ios-pricetags-outline"></i></button>
                                <button class="btn btn-app" data-toggle="modal" data-target="#product{{ $product->id }}"><i class="ion-ios-trash-outline"></i></button>
                            </div>

                            <!-- Delete Modal -->
                            <div wire:ignore.self class="modal fade" id="product{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        @if(Session::has('error'))
                                            <div class="alert alert-danger text-capitalize w-75 m-x-auto" role="alert">
                                                {{Session::get('error')}}
                                            </div>
                                        @elseif(Session::has('success'))
                                            <div class="alert alert-success text-capitalize w-75 m-x-auto" role="alert">
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        <div class="card-block text-left">
                                            <p>Are you sure, you want to delete product (<span class="text-capitalize">{{ $product->name }}</span>) ?</p>
                                            <p>if you delete product you will also delete product banners and product quantity store.</p><br>
                                            <p> <b>Notice:</b> if you want to hide product, you can update it's status to not active instead of delete it.</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::Open(['wire:submit.prevent' => 'destroy('.$product->id.')', 'class' => 'DeleteFormModal']) !!}                                                
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-app" type="submit"> Delete</button>
                                            {!! Form::Close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Sale Modal -->
                            <div wire:ignore.self class="modal fade" id="SaleProduct{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Sale On Product ({{ $product->name }})</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        {!! Form::Open(['wire:submit.prevent' => 'sale('.$product->id.')', 'class' => 'DeleteFormModal']) !!}
                                        <div class="card-block text-left">
                                            <div class="form-group">
                                                <label>Price:</label>
                                                <input class="form-control" type="text" name="price" value="&pound; {{ $product->price/100 }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>New Price:</label>
                                                <input wire:model="new_price" class="form-control @error('new_price') input-error @enderror" type="text" placeholder="should be less than old price" />
                                                @error('new_price')
                                                    <div class="msg-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                            <button class="btn btn-success SubmittFormModal" type="submit"> Update</button>
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

        {{ $products->links() }}
    </div>

</div>
