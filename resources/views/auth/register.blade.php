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
                            <input type="text" name="name" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="Password">
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        
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