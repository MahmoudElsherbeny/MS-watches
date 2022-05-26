@extends('backend.layouts.app')
@section('title') Dashboard | Products @endsection

@section('content')

<!-- products Table -->
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-a-0 m-t-xs">Products (<span id="prod_count">@if($products){{ $products->total() }}@endif</span>)</h4>
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
                    <th class="">Category</th>
                    <th class="">Price(EGP)</th>
                    <th class="">Old Price</th>
                    <th class="text-center">Status</th>
                    <th class="hidden-xs">Publisher</th>
                    <th class="">Created At</th>
                    <th class="">Last Update</th>
                    <th class="text-center" style="width: 12%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $key=>$product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $key }}</td>
                        <td class="text-center text-capitalize">
                            <a href="{{ route('product.info', ['id' => $product->id]) }}" style="text-decoration:underline;" target="_blank">{{ $product->name }}</a>
                        </td>
                        <td class="text-center">{{ App\Category::getCategoryName($product->category) }}</td>
                        <td class="text-center">&pound; {{ $product->price/100 }}</td>
                        <td class="text-center old_price">&pound; {{ $product->old_price/100 }}</td>
                        <td class="text-center text-capitalize"> 
                            <span class="status btn btn-sm btn-pill @if($product->status == 'active') btn-primary @else btn-warning @endif">{{ $product->status }}</span> 
                        </td>
                        <td class="text-center hidden-xs">{{ App\Admin::getAdminName($product->published_by) }}</td>
                        <td class="text-center">{{ $product->created_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">{{ $product->updated_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#SaleProduct{{ $product->id }}"><i class="ion-ios-pricetags-outline"></i></button>
                                <button class="btn btn-app" data-toggle="modal" data-target="#product{{ $product->id }}"><i class="ion-ios-trash-outline"></i></button>
                            </div>

                            <!-- Delete Modal -->
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
                            <!-- Sale Modal -->
                            <div class="modal fade" id="SaleProduct{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        {!! Form::Open(['url' => route('product.sale', ['id' => $product->id]) ]) !!}
                                        <div class="card-block text-left">
                                            <div class="form-group">
                                                <label>Price:</label>
                                                <input class="form-control" type="text" name="price" value="{{ $product->price/100 }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>New Price:</label>
                                                <input class="form-control @error('new_price') input-error @enderror" type="text" name="new_price" value="{{ $product->sale }}" />
                                                @error('new_price')
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
    <!-- .card-block -->

</div>
<!-- End products Table -->   

@endsection

@section('js_code')

    <!--  Ajax code for product live search  -->
    <script type="text/javascript">

        $('#prod_search').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url : '{{ route('product.index') }}',
                data:{'prod_search':$value},
                dataType: 'json',
                success:function(products){

                    $('tbody').html(products.data);
                    $('#prod_count').text(products.count);

                }
            });
        })
    </script>

@endsection