@extends('frontend.layouts.app')
@section('title')  Contact Us @endsection

@section('content')

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Contact US</h2>
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                          <span class="brd-separetor">/</span>
                          <span class="breadcrumb-item active">Contact US</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="contact_container">
                    <div class="contact-title">
                        <h2 class="contact__title">Get In Touch</h2>
                    </div>
                    {!! Form::open(['url' => route('contact.send'), 'id' => 'contact-form']) !!}
                        <div class="single-contact-form">
                            <div class="contact-box">
                                <input class="@error('name') app__input__error @enderror" type="text" name="name" placeholder="Your Name*">
                                @error('name')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box">
                                <input class="@error('email') app__input__error @enderror" type="email" name="email" placeholder="Mail*">
                                @error('email')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box subject">
                                <input class="@error('subject') app__input__error @enderror" type="text" name="subject" placeholder="Subject*">
                                @error('subject')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box message">
                                <textarea class="@error('message') app__input__error @enderror" name="message"  placeholder="Massage*"></textarea>
                                @error('message')
                                    <div class="msg-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="contact-btn">
                            <button type="submit" class="fv-btn">SEND</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="contact_container">
                    <img src="{{ asset('storage/'.App\Setting::getSettingValue('image') ) }}" width="100%" height="100%" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('copyright')
    @include('frontend.layouts.copyright')
@endsection