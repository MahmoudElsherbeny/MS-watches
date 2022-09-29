@extends('backend.layouts.app')
@section('title') Dashboard | Profile @endsection

@section('content')
    
    <!-- Update user profile Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">{{ Auth::guard('admin')->user()->name }}</h4>
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

        <div class="card-block">
            {!! Form::Open(['files' => 'true']) !!}
                <div class="form-group edit_profile_image">
                    <img src="{{ Auth::guard('admin')->user()->image ? asset('storage/'.Auth::guard('admin')->user()->image) : asset('backend/assets/img/avatars/profile_avatar.png') }}" />
                    <label for="image_input" class="image_label">
                        <i class="fa fa-pencil-square"></i>
                    </label>
                    <input id="image_input" class="image_input" type="file" name="image" />
                    @error('image')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Name:</label>
                    <input class="form-control @error('name') input-error @enderror" type="text" name="name" value="{{ old('name', Auth::guard('admin')->user()->name) }}" max="30" />
                    @error('name')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="text" value="{{ Auth::guard('admin')->user()->email }}" readonly />
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input class="form-control @error('password') input-error @enderror" type="password" name="password" placeholder="Enter New Password..." />
                    @error('password')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password:</label>
                    <input class="form-control @error('confirm_password') input-error @enderror" type="password" name="confirm_password" placeholder="Confirm Your Password..." />
                    @error('confirm_password')
                        <div class="msg-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group m-b-0">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-app">Cancel</a>
                </div>
            {!! Form::Close() !!}
        </div>
    </div>
    <!-- End Update User profile Form -->

@endsection