<!-- sidebar -->
<aside class="app-layout-drawer">

    <!-- Drawer scroll area -->
    <div class="app-layout-drawer-scroll">
        <!-- Drawer logo -->
        <div id="logo" class="drawer-header">
            <a href="{{ url('dashboard') }}"> <span class="logo1">{{ App\Setting::getSettingValue('name') }}</span><span class="logo2">Watches</span> </a>
        </div>

        <!-- Drawer navigation -->
        <nav class="drawer-main">
            <ul class="nav nav-drawer">

            <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> Slider</a>
                    <ul class="nav nav-subnav">

                        <li>
                            <a href="{{ route('slider.index') }}">All Slides</a>
                        </li>
                        <li>
                            <a href="{{ route('slider.create') }}">Create New Slide</a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-ios-calculator-outline"></i> Categories</a>
                    <ul class="nav nav-subnav">
                        <li>
                            <a href="{{ route('category.index') }}">All Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('category.create') }}">Create New Category</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-ios-compose-outline"></i> Products</a>
                    <ul class="nav nav-subnav">

                        <li>
                            <a href="{{ route('product.index') }}">All Products</a>
                        </li>
                        <li>
                            <a href="{{ route('product.create') }}">Create New Product</a>
                        </li>
                        <li>
                            <a href="{{ route('product.create') }}">Product Report</a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-ios-compose-outline"></i> Orders</a>
                    <ul class="nav nav-subnav">

                        <li>
                            <a href="{{ route('order.index') }}">All Orders</a>
                        </li>
                        <li>
                            <a href="{{ route('product.create') }}"> Report</a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> States</a>
                    <ul class="nav nav-subnav">

                        <li>
                            <a href="{{ route('state.index') }}">All States</a>
                        </li>
                        <li>
                            <a href="{{ route('state.create') }}">Create New State</a>
                        </li>

                    </ul>
                </li>

                @if(Auth::guard('admin')->user()->role == 'admin')
                    <li class="nav-item nav-item-has-subnav">
                        <a href="javascript:void(0)"><i class="ion-ios-list-outline"></i> Editors</a>
                        <ul class="nav nav-subnav">

                            <li>
                                <a href="{{ route('editor.index') }}">All Editors</a>
                            </li>
                            <li>
                                <a href="base_tables_responsive.html">h</a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item nav-item-has-subnav">
                        <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> Logs</a>
                        <ul class="nav nav-subnav">

                            <li>
                                <a href="{{ route('DashLogs.index') }}">Dashboard Logs</a>
                            </li>
                            <li>
                                <a href="base_pages_blank.html">Logs</a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item nav-item-has-subnav">
                        <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> Setting</a>
                        <ul class="nav nav-subnav">

                            <li>
                                <a href="{{ route('setting.index') }}">All Setting</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.edit') }}">Edit Setting</a>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-social-javascript-outline"></i> JS plugins</a>
                    <ul class="nav nav-subnav">

                        <li>
                            <a href="base_js_maps.html">Maps</a>
                        </li>

                        <li>
                            <a href="base_js_sliders.html">Sliders</a>
                        </li>

                        <li>
                            <a href="base_js_charts_flot.html">Charts - Flot</a>
                        </li>

                        <li>
                            <a href="base_js_charts_chartjs.html">Charts - Chart.js</a>
                        </li>

                        <li>
                            <a href="base_js_charts_sparkline.html">Charts - Sparkline</a>
                        </li>

                        <li>
                            <a href="base_js_draggable.html">Draggable</a>
                        </li>

                        <li>
                            <a href="base_js_syntax_highlight.html">Syntax highlight</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End drawer navigation -->

        <div class="drawer-footer">
            <p class="copyright">AppUI Template &copy;</p>
        </div>
    </div>
    <!-- End drawer scroll area -->
</aside>
<!-- End sidebar -->
