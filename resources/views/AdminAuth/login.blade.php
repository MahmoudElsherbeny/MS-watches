@extends('AdminAuth.layouts.app')

@section('content')

<!-- Start Login Area -->
<div class="card w-40 m-y-lg m-x-auto">
    <div class="card-header">
        <h2 class="text-center" style="font-weight: 400; font-size: 36px;">Login</h2>
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
        {!! Form::Open() !!}
            <div class="form-group">
                <label>Email</label>
                <input class="form-control @error('email') input-error @enderror" type="text" name="email" placeholder="Enter email..." />
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
                <div class="row">
                    <div class="col-md-9">
                        <label for="login_remember" class="css-input switch switch-sm switch-app">
                            <input type="checkbox" name="remember_me" id="login_remember"><span></span> Remember me
                        </label>
                    </div>
                    <div class="col-md-3">
                        <a href="" style="font-size: 12px;">Forget Password?</a>
                    </div>
                </div>
            </div>
            <div class="form-group m-b-0 text-center">
                <button class="btn btn-app p-x-md" type="submit">Login</button>
            </div>
            {!! Form::Close() !!}
    </div>
</div>

<!-- End Login Register Area -->

@endsection