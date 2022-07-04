@extends('frontend.layouts.app')
@section('title')  {{ Auth::user()->name }} @endsection

@section('content')

<!-- Start Contact Area -->
<section class="htc__profile__area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 profile__container bg__white ptb--40">
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

                    {!! Form::open(['files' => 'true']) !!}
                        <div class="edit_profile_image text-center mb--20">
                            <div class="cover">
                                <img src="@if($user->user_info && $user->user_info->cover !=null) {{ asset('storage/'.$user->user_info->cover) }} @else {{ asset('frontend/images/avatars/cover.jpg') }} @endif" />
                                <label for="cover_input" class="image_label">
                                    <i class="fa fa-pencil"></i>
                                </label>
                                <input id="cover_input" class="image_input" type="file" name="cover" />
                                @error('cover')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="image">
                                <img src="@if($user->user_info && $user->user_info->image !=null) {{ asset('storage/'.$user->user_info->image) }} @else {{ asset('frontend/images/avatars/profile_avatar.png') }} @endif" />
                                <label for="image_input" class="image_label">
                                    <i class="fa fa-pencil"></i>
                                </label>
                                <input id="image_input" class="image_input" type="file" name="image" />
                                @error('image')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mb--10">
                            <h2 class="edit__profile__title">{{ $user->name }}</h2>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('name') app__input__error @enderror" type="text" name="name" value="{{ $user->name }}" placeholder="Your Name*">
                                @error('name')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('email') app__input__error @enderror" type="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('phone') app__input__error @enderror" type="text" name="phone" value="@if($user->user_info) {{ $user->user_info->phone }} @endif" placeholder="Phone Number*">
                                @error('phone')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <select class="@error('state') app__input__error @enderror" name="state">
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @if($user->user_info && $user->user_info->state_id == $state->id) selected @endif>{{ $state->state }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt--30">
                            <div class="edit_profile_box">
                                <input class="@error('address') app__input__error @enderror" type="text" name="address" value="@if($user->user_info) {{ $user->user_info->address }} @endif" placeholder="Address*">
                                @error('address')
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