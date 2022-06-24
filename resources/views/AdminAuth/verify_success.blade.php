@extends('AdminAuth.layouts.app')

@section('content')

<!-- Start Login Register Area -->
<div class="verify_after_register text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="@if(Session::has('success')) register_success_icon @else register_error_icon @endif">
                @if(Session::has('success'))
                    <i class="fa fa-check-circle"></i>
                @elseif(Session::has('error'))
                    <i class="fa fa-times-circle"></i>
                @endif
                </div>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="register_success_content">
                @if(Session::has('success'))
                    <p>{{ Session::get('success') }}</p>
                @elseif(Session::has('error'))
                    <p>{{ Session::get('error') }}</p>
                @endif
                    <p>{{ $msg }}</p>
                </div>
                <div class="register_success_links">
                    <div class="row">
                        <div class="link col-md-6 text-right">
                            @if ($route = 'AdminAuth.resend')
                                {!! Form::open(['url' => route($route)]) !!}
                                    <button type="submit">resend verify email</button>
                                {!! Form::close() !!}
                            @else
                                <a href="{{ route($route) }}">{{ $link }}</a>
                            @endif
                        </div>
                        <div class="link col-md-6 text-left">
                            {!! Form::Open(['url'=>route('AdminAuth.logout')]) !!}
                                <button type="submit">logout</button>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<!-- End Login Register Area -->

@endsection