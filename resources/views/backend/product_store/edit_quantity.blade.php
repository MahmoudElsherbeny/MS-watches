@extends('backend.layouts.app')
@section('title') Dashboard | Products Store @endsection

@section('content')
    
    <!-- Create product Form -->
    <div class="card">
        <div class="card-header text-capitalize">
            <h4>Edit Product ({{ $product_store->product->name }}) Quantity</h4>
        </div>

        <div class="card-block">
            @if(Session::has('error'))
                <div class="alert alert-danger text-capitalize w-75 m-x-auto" role="alert">
                    {{Session::get('error')}}
                </div>
            @elseif(Session::has('success'))
                <div class="alert alert-success text-capitalize w-75 m-x-auto" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif

            <!--  add new product quantity form  -->
            {!! Form::Open(['url' => route('ProductStore.update', ['prod' => $product_store->product_id, 'qty_id' => $product_store->id])]) !!}
                <div class="form-group">
                    <label>Product:</label>
                    <input class="form-control" type="text" name="product" value="{{ $product_store->product->name }}" disabled/>
                </div>
                <div class="form-group">
                    <label>Quantity:</label>
                    <input class="form-control @error('quantity') input-error @enderror" type="text" name="quantity" value="{{ old('quantity', $product_store->quantity) }}" />
                    @error('quantity')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Total Price:</label>
                    <input class="form-control @error('total') input-error @enderror" type="text" name="total" value="{{ old('total', $product_store->total / 100) }}" />
                    @error('total')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group m-b-0 m-t-md">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('ProductStore.index') }}" class="btn btn-app">Back</a>
                </div>
            {!! Form::Close() !!}
        </div>
    </div>
    <!-- End Create product Form -->

@endsection
