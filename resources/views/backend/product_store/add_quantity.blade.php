@extends('backend.layouts.app')
@section('title') Dashboard | Products Store @endsection

@section('content')
    
    <!-- Create product Form -->
    <div class="card">
        <div class="card-header">
            <h4>Add Product New Quantity</h4>
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
            {!! Form::Open(['url' => route('ProductStore.store')]) !!}
                <div class="form-group">
                    <label>Product:</label>
                    <select class="form-control" name="product">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if(old('product') == $product->id) selected @endif>{{ $product->name }} ({{ $product->all_quantity }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantity:</label>
                    <input class="form-control @error('quantity') input-error @enderror" type="text" name="quantity" value="{{ old('quantity') }}" placeholder="Enter product quantity..." />
                    @error('quantity')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Total Price:</label>
                    <input class="form-control @error('total') input-error @enderror" type="text" name="total" value="{{ old('total') }}" placeholder="Enter total wholesale price..." />
                    @error('total')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group m-b-0 m-t-md">
                    <button class="btn btn-success" type="submit">Add</button>
                    <a href="{{ route('ProductStore.index') }}" class="btn btn-app">Back</a>
                </div>
            {!! Form::Close() !!}
        </div>
    </div>
    <!-- End Create product Form -->

@endsection
