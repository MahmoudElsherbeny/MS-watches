@extends('frontend.layouts.app')

@section('content')
<!-- Start reset new password Area -->
<div class="htc__login__register bg__white ptb--70" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login__register__menu">
                    <div class="title active">Reset Password</div>
                </div>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="htc__login__register__wrap">
                            
                    <!-- Start Single Content -->
                    <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                        {!! Form::Open(['url' => route('password.update'), 'class' => 'login']) !!}
                            
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="login__form__input">
                                <input class="@error('email') app__input__error @enderror" type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Email">
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
                                <input class="@error('password_confirmation') app__input__error @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="htc__login__btn">
                                <button type="submit">Reset Password</button>
                            </div>
                        {!! Form::Close() !!}
                        
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<!-- End reset new password Area -->
                
@endsection
