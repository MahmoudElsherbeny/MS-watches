@extends('frontend.layouts.app')
@section('title') Verify @endsection

@section('content')

<!-- Start Login Register Area -->
<div class="htc__login__register bg__white pt--110 pb--180" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="register_success_icon">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Start Single Content -->
                <div class="register_success_content">
                    <p>You registered successfully !</p>
                    @if (session('resent'))
                        <p>verification link has been sent to your email .</p>
                    @else
                        <p>Please check your email to verify, enjoy with us .</p>
                    @endif
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to resend verification email') }}</button>.
                    </form>
                </div>
                <!-- End Single Content -->
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<!-- End Login Register Area -->

@endsection

@section('copyright')
    @include('frontend.layouts.copyright')
@endsection
