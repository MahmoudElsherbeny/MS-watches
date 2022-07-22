@extends('backend.layouts.app')
@section('title') Dashboard | Ads @endsection

@section('content')
    
    <!-- Create ad banner Form -->
    <div class="card">
        <div class="card-header">
            <h4>Edit Home Page Ad</h4>
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
            {!! Form::Open(['url' => route('AdsBanner.update', ['id' => $ad->id]), 'files' => 'true']) !!}
                <div class="form-group">
                    <label>Product:</label>
                    <input class="form-control" type="text" value="{{ $ad->product->name }}" readonly />
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control" name="status">
                        <option value="active" @if($ad->status == 'active') selected @endif>Active</option>
                        <option value="not active" @if($ad->status == 'not active') selected @endif>Not Active</option>
                    </select>
                </div>
                <div class="form-group m-b-0">
                    <label>Ad Banner:</label>
                </div>
                <div class="form-group edit_banner_image">
                    <img src="{{ asset('storage/'.$ad->image) }}" />
                    <label for="image_input" class="image_label">
                        <i class="fa fa-pencil-square"></i>
                    </label>
                    <input id="image_input" class="image_input" type="file" name="image" accept="image/*"  />
                    @error('image')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group m-b-0 m-t-md">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('AdsBanner.index') }}" class="btn btn-app">Back</a>
                </div>
            {!! Form::Close() !!}
        </div>
    </div>
    <!-- End Create ad banner Form -->

@endsection
