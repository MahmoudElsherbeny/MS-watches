@extends('frontend.layouts.app')
@section('title')  {{ Auth::user()->name }} @endsection

@section('content')

<!-- Start Contact Area -->
<section class="htc__profile__area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 profile__container ptb--70 bg__white">
                <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12"></div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">

                    @if(Session::has('error'))
                        <div class="alert alert-danger text-capitalize text-center w-75 m-x-auto" role="alert">
                            {{Session::get('error')}}
                        </div>
                    @elseif(Session::has('success'))
                        <div class="alert alert-success text-capitalize text-center w-75 m-x-auto" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open() !!}
                        <div class="login__register__menu text-center">
                            <div class="title active">Change Password</div>
                        </div>
                        <div class="mt--50">
                            <div class="edit_profile_box">
                                <input type="text" name="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input type="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('current_password') app__input__error @enderror" type="password" name="current_password" value="{{ old('current_password') }}" placeholder="Current Password*">
                                @error('current_password')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('new_password') app__input__error @enderror" type="password" name="new_password" value="{{ old('new_password') }}" placeholder="New Password*">
                                @error('new_password')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('confirm_password') app__input__error @enderror" type="password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password*">
                                @error('confirm_password')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="contact-btn mt--40">
                            <button type="submit" class="fv-btn">Update Profile</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

@endsection

@section('copyright')
    @include('frontend.layouts.copyright')
@endsection