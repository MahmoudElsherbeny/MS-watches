<div>

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

        <table id="ProductsReviewsTable" class="table table-striped table-vcenter js-dataTable-simple">
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
                    {!! Form::Open(['wire:submit.prevent' => 'add_website_review('.$product->id.')']) !!}
                        <td class="text-center">{{ $products_reviews->firstItem()+$key }}</td>
                        <td class="text-center text-capitalize">
                            <a href="{{ route('product.info', ['id' => $product->product_id]) }}" style="text-decoration:underline;" target="_blank">{{ $product->product->name }}</a>
                        </td>
                        <td class="text-center">{{ $product->review }}</td>
                        <td class="text-center">{{ $product->rate }}</td>
                        <td class="text-center">
                        @if ($product->website_review)
                        <div class="btn-group">
                            <a class="btn btn-warning">Already Exist</a>
                        </div>
                        @else
                        <div class="btn-group">
                            <button class="btn btn-success" type="submit">Add As Website Review</button>
                        </div>
                        </td>
                        @endif
                    {!! Form::Close() !!}
                    </tr>
                @endforeach
            
            </tbody>
        </table>
    
        {{ $products_reviews->links() }}
    </div>
    <!-- .card-block -->

</div>
