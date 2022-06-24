@extends('AdminAuth.layouts.app')

@section('content')

<!-- Start Login Register Area -->
<div class="verify_after_register text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="register_success_icon">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="register_success_content">
                    <p>Your account created successfully !</p>
                    <p>Please check your email to verify, enjoy with us .</p>
                </div>
                <div class="register_success_links">
                    <div class="row">
                        <div class="link col-md-6 text-right">
                            <a href="{{ route('AdminAuth.resend') }}">resend verify email</a>
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