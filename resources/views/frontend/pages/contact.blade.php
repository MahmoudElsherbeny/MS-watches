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
                <div class="htc__contact__container">
                    <div class="contact-title">
                        <h2 class="contact__title">Get In Touch</h2>
                    </div>
                    <form id="contact-form" action="mail.php" method="post">
                        <div class="single-contact-form">
                            <div class="contact-box name">
                                <input type="text" name="name" placeholder="Your Name*">
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box name">
                                <input type="email" name="email" placeholder="Mail*">
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box subject">
                                <input type="text" name="subject" placeholder="Subject*">
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box message">
                                <textarea name="message"  placeholder="Massage*"></textarea>
                            </div>
                        </div>
                        <div class="contact-btn">
                            <button type="submit" class="fv-btn">SEND</button>
                        </div>
                    </form>
                </div> 
                <div class="form-output">
                    <p class="form-messege"></p>
                </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div>
                    <img src="url('frontend/images/product/big-img/1.jpg')" />
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