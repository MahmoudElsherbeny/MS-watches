@extends('backend.layouts.app')
@section('title') Dashboard | Ads @endsection

@section('content')
    
    <!-- Create ad banner Form -->
    <div class="card">
        <div class="card-header">
            <h4>Create New Home Page Ad</h4>
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

            <!--  add new ad banner form  -->
            {!! Form::Open(['url' => route('AdsBanner.store'), 'files' => 'true']) !!}
                <div class="form-group">
                    <label>Product:</label>
                    <select class="form-control" name="product">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if(old('product') == $product->id) selected @endif>{{ $product->name }} ({{ $product->all_quantity }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control" name="status">
                        <option value="active" @if(old('status') == 'active') selected @endif>Active</option>
                        <option value="not active" @if(old('status') == 'not active') selected @endif>Not Active</option>
                    </select>
                </div>
                <div class="form-group edit_profile_image">
                    <label>Banner:</label>
                    <input type="file" name="image" value="{{ old('image') }}" accept="image/*" />
                    @error('image')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group m-b-0 m-t-md">
                    <button class="btn btn-success" type="submit">Add</button>
                    <a href="{{ route('AdsBanner.index') }}" class="btn btn-app">Back</a>
                </div>
            {!! Form::Close() !!}
        </div>
    </div>
    <!-- End Create ad banner Form -->

@endsection
