@extends('AdminAuth.layouts.app')

@section('content')

<!-- Start Login Area -->
<div class="card w-40 m-y-lg m-x-auto">
    <div class="card-header">
        <h2 class="text-center" style="font-weight: 400; font-size: 36px;">Register</h2>
    </div>
    <div class="card-block">
        {!! Form::Open() !!}
            <div class="form-group">
                <label>Name</label>
                <input class="form-control @error('name') input-error @enderror" type="text" name="name" placeholder="Enter username..." />
                @error('name')
                    <div class="msg-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control @error('email') input-error @enderror" type="email" name="email" placeholder="Enter email..." />
                @error('email')
                    <div class="msg-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password') input-error @enderror" type="password" name="password" placeholder="Enter Password.." />
                @error('password')
                    <div class="msg-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="form-control @error('confirm_password') input-error @enderror" type="password" name="confirm_password" placeholder="Confirm Password.." />
                @error('confirm_password')
                    <div class="msg-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group m-b-0 text-center">
                <button class="btn btn-app p-x-md" type="submit">Register</button>
            </div>
            {!! Form::Close() !!}
    </div>
</div>

<!-- End Login Register Area -->

@endsection