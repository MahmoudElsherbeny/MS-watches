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
                    <div class="htc__contact__address">
                        <h2 class="contact__title">contact info</h2>
                        <div class="contact__address__inner">
                            <!-- Start Single Adress -->
                            <div class="single__contact__address">
                                <div class="contact__icon">
                                    <span class="ti-location-pin"></span>
                                </div>
                                <div class="contact__details">
                                    <p>Location : <br> 12, Abdallah Elnadeem st, Portfouad Egypt.</p>
                                </div>
                            </div>
                            <!-- End Single Adress -->
                        </div>
                        <div class="contact__address__inner">
                            <!-- Start Single Adress -->
                            <div class="single__contact__address">
                                <div class="contact__icon">
                                    <span class="ti-mobile"></span>
                                </div>
                                <div class="contact__details">
                                    <p> Phone : <br><a href="#">+012 875 42 932 </a></p>
                                </div>
                            </div>
                            <!-- End Single Adress -->
                            <!-- Start Single Adress -->
                            <div class="single__contact__address">
                                <div class="contact__icon">
                                    <span class="ti-email"></span>
                                </div>
                                <div class="contact__details">
                                    <p> Mail :<br><a href="#">info@example.com</a></p>
                                </div>
                            </div>
                            <!-- End Single Adress -->
                        </div>
                    </div>
                    <div class="contact-form-wrap">
                    <div class="contact-title">
                        <h2 class="contact__title">Get In Touch</h2>
                    </div>
                    <form id="contact-form" action="mail.php" method="post">
                        <div class="single-contact-form">
                            <div class="contact-box name">
                                <input type="text" name="name" placeholder="Your Nme*">
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
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                <div class="map-contacts">
                    <div id="googleMap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13642.524307751855!2d32.31806270215387!3d31.258634686949847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f99db3b4f22f63%3A0xfc27f01c3a35a48a!2z2YXYudiv2YrYqSDYqNmI2LHZgdik2KfYrw!5e0!3m2!1sar!2seg!4v1608926295419!5m2!1sar!2seg" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection