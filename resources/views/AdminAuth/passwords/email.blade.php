@extends('AdminAuth.layouts.app')

@section('content')

<!-- Start forgot password Area -->
<div class="card w-40 m-y-lg m-x-auto">
    <div class="card-header">
        <h2 class="text-center" style="font-weight: 400; font-size: 36px;">Reset Password</h2>
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
        {!! Form::Open(['url' => route('AdminPassword.email')]) !!}
            <div class="form-group">
                <label>Email</label>
                <input class="form-control @error('email') input-error @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Enter email..." />
                @error('email')
                    <div class="msg-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group m-b-0 text-center">
                <button class="btn btn-app p-x-md" type="submit">Send Reset Link</button>
            </div>
        {!! Form::Close() !!}
    </div>
</div>

<!-- End forgot password Register Area -->

@endsection