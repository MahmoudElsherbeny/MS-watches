@extends('frontend.layouts.app')

@section('content')
<!-- Start forget password Area -->
<div class="htc__login__register bg__white ptb--70" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login__register__menu">
                    <div class="title active">Reset Password</div>
                </div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            </div>
        </div>
        <!-- Start forget password Content -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">

                        {!! Form::Open(['url' => route('password.email'), 'class' => 'login']) !!}
                            <div class="login__form__input">
                                <input class="@error('email') app__input__error @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="htc__login__btn">
                                <button class="prl--20" type="submit">Send Reset Link</button>
                            </div>
                        {!! Form::Close() !!}

                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
        <!-- End forget password Content -->
    </div>
</div>
<!-- End forget password Area -->
        
@endsection
