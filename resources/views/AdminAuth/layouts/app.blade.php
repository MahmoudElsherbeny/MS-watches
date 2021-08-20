<!DOCTYPE html>
<html class="app-ui">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <title>MS Watches | Dashboard</title>

        <meta name="description" content="MS Watches - Admin Dashboard" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ url('backend/assets/img/apple-touch-icon.png') }}" />
        <link rel="icon" href="{{ url('backend/assets/img/favicon.ico') }}" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="{{ url('backend/assets/css/font-awesome.css') }}" />
        <link rel="stylesheet" id="css-ionicons" href="{{ url('backend/assets/css/ionicons.css') }}" />
        <link rel="stylesheet" id="css-bootstrap" href="{{ url('backend/assets/css/bootstrap.css') }}" />
        <link rel="stylesheet" id="css-app" href="{{ url('backend/assets/css/app.css') }}" />
        <link rel="stylesheet" id="css-app-custom" href="{{ url('backend/assets/css/app-custom.css') }}" />
        <!-- End Stylesheets -->
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">

        <div class="app-layout-canvas">
            <div class="app-layout-container p-y-lg">
                <!-- Page Content -->
                @yield('content')
            </div>
        </div>

        <div class="app-ui-mask-modal"></div>

     <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
     <script src="{{ url('backend/assets/js/core/jquery.min.js') }}"></script>
     <script src="{{ url('backend/assets/js/core/bootstrap.min.js') }}"></script>
     <script src="{{ url('backend/assets/js/core/jquery.slimscroll.min.js') }}"></script>
     <script src="{{ url('backend/assets/js/core/jquery.scrollLock.min.js') }}"></script>
     <script src="{{ url('backend/assets/js/core/jquery.placeholder.min.js') }}"></script>
     <script src="{{ url('backend/assets/js/app.js') }}"></script>
     <script src="{{ url('backend/assets/js/app-custom.js') }}"></script>

     <!-- Page JS Code -->
     <script src="{{ url('backend/assets/js/pages/index.js') }}"></script>

     @yield('js_code')

 </body>
</html>