@extends('frontend.layouts.app')
@section('title') Login @endsection

@section('content')

<!-- Start Login Area -->
<div class="htc__login__register bg__white ptb--70" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login__register__menu">
                    <div class="title active">Login</div>
                </div>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                        {!! Form::Open(['class'=>'login']) !!}

                            <div class="login__form__input">
                                <input class="@error('email') app__input__error @enderror" type="text" name="email" placeholder="Email">
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
                        
                            <div class="tabs__checkbox">
                                <input id="remember" name="remember" type="checkbox">
                                <label for="remember"> Remember me</label>
                                <span class="forget"><a href="{{ route('password.request') }}">Forget Pasword?</a></span>
                            </div>
                            <div class="htc__login__btn mt--30">
                                <button type="submit">Login</button>
                            </div>
                        {!! Form::Close() !!}

                        <div class="htc__social__connect">
                            <h2>Don't have account? <a href="{{ route('register') }}">SignUp</a> <!-- Or Login With --></h2>
                            <!--
                            <ul class="htc__soaial__list">
                                <li><a class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                <li><a class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                            </ul>
                        -->
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