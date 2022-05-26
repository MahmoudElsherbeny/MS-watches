<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'MS Watches')</title>
    <meta name="description" content="selling watches">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/images/icons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="{{ url('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/owl.theme.default.min.css') }}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ url('frontend/css/core.css') }}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ url('frontend/css/shortcode/shortcodes.css') }}">
    <!-- Theme main styles -->
    <link rel="stylesheet" href="{{ url('frontend/style.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/custom.css') }}">
    <!--  icons  -->
    <link rel="stylesheet" href="{{ url('frontend/css/ionicons.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/css/font-awesome.css') }}" />
     <!--  loading spinner  -->
     <link rel="stylesheet" href="{{ url('frontend/css/loading.css') }}" />

    @livewireStyles

    <!-- Modernizr JS -->
    <script src="{{ url('frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">
        @include('frontend.layouts.header')
        
        @yield('content')

        <footer class="htc__foooter__area gray-bg">
            <div class="container">
                @yield('footer')
                @yield('copyright')
            </div>
        </footer>
    </div>
    <!-- Body main wrapper end -->

    <!--  js files  -->
    <script src="{{ url('frontend/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ url('frontend/js/plugins.js') }}"></script>
    <script src="{{ url('frontend/js/slick.min.js') }}"></script>
    <script src="{{ url('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('frontend/js/waypoints.min.js') }}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ url('frontend/js/main.js') }}"></script>

    @livewireScripts
    
    @yield('js_code')

    </body>
</html>