@extends('frontend.layouts.app')
@section('title') Register @endsection

@section('content')

<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--70" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login__register__menu">
                    <div class="title active">Register</div>
                </div>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="htc__login__register__wrap">
                            
                    <!-- Start Single Content -->
                    <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                        {!! Form::Open(['class'=>'login']) !!}
                            
                            <div class="login__form__input">
                                <input class="@error('name') app__input__error @enderror" type="text" name="name" placeholder="Name">
                                @error('name')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="login__form__input">
                                <input class="@error('email') app__input__error @enderror" type="email" name="email" placeholder="Email">
                                @error('email')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="login__form__input">
                                <input class="@error('password') app__input__error @enderror" type="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="login__form__input">
                                <input class="@error('confirm_password') app__input__error @enderror" type="password" name="confirm_password" placeholder="Confirm Password">
                                @error('confirm_password')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="htc__login__btn">
                                <button type="submit">register</button>
                            </div>
                        {!! Form::Close() !!}
                        <div class="htc__social__connect">
                            <h2><a href="{{ route('login') }}">Login</a> Or SignUp With</h2>
                            <ul class="htc__soaial__list">
                                <li><a class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                <li><a class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<!-- End Login Register Area -->

@endsection