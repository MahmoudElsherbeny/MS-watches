<!DOCTYPE html>
<html class="app-ui">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <title>@yield('title', '{{ App\Setting::getSettingValue("name") }} Watches | Dashboard')</title>

        <meta name="description" content="MS Watches - Admin Dashboard" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ url('backend/assets/img/apple-touch-icon.png') }}" />
        <link rel="icon" href="{{ asset('storage/'.App\Setting::getSettingValue('logo') ) }}" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ url('backend/assets/js/plugins/slick/slick.min.css') }}" />
        <link rel="stylesheet" href="{{ url('backend/assets/js/plugins/slick/slick-theme.min.css') }}" />
        <link rel="stylesheet" href="{{ url('backend/assets/js/plugins/datatables/jquery.dataTables.min.css') }}" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="{{ url('backend/assets/css/font-awesome.css') }}" />
        <link rel="stylesheet" id="css-ionicons" href="{{ url('backend/assets/css/ionicons.css') }}" />
        <link rel="stylesheet" id="css-bootstrap" href="{{ url('backend/assets/css/bootstrap.css') }}" />
        <link rel="stylesheet" id="css-app" href="{{ url('backend/assets/css/app.css') }}" />
        <link rel="stylesheet" id="css-app-custom" href="{{ url('backend/assets/css/app-custom.css') }}" />
        <!-- End Stylesheets -->

        <!--  livewire  -->
        @livewireStyles
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">

        <div class="app-layout-canvas">
            <div class="app-layout-container">
                <!--   sidebar   -->
                @include('backend/layouts/sidebar')

                <!--   header   -->
                @include('backend/layouts/header')

                <main class="app-layout-content">
                    <!-- Page Content -->
                    <div class="container-fluid p-y">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
        <script src="{{ url('backend/assets/js/core/jquery.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/core/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/core/jquery.scrollLock.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/core/jquery.placeholder.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/app.js') }}"></script>
        <script src="{{ url('backend/assets/js/app-custom.js') }}"></script>

        <!-- Page Plugins -->
        <script src="{{ url('backend/assets/js/plugins/plugins.js') }}"></script>
        <script src="{{ url('backend/assets/js/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/plugins/chartjs/Chart.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/plugins/flot/jquery.flot.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/plugins/flot/jquery.flot.pie.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/plugins/flot/jquery.flot.stack.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/plugins/flot/jquery.flot.resize.min.js') }}"></script>

        <script src="{{ url('backend/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ url('backend/assets/js/pages/base_tables_datatables.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ url('backend/assets/js/pages/index.js') }}"></script>

        <script>
            $(function() {
                // Init page helpers (Slick Slider plugin)
                App.initHelpers('slick');
            });
        </script>

        <script type="text/javascript">
            $('.DeleteFormModal').submit(function() {
                $('.modal').removeClass('in');
                $('.modal').css("display", "none");
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
        </script>

        <!--  livewire  -->
        @livewireScripts

        @yield('js_code')

    </body>
</html>