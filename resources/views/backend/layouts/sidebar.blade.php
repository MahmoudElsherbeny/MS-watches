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
                    <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> Home Ads</a>
                    <ul class="nav nav-subnav">
                        <li>
                            <a href="{{ route('Banner.index') }}">All Ads Banners</a>
                        </li>
                        <li>
                            <a href="{{ route('Banner.create') }}">Create New Ad</a>
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
                            <a href="{{ route('product.reviews') }}">Products Reviews</a>
                        </li>
                        <li>
                            <a href="{{ route('ProductStore.index') }}">Products Store</a>
                        </li>
                    @if(Auth::guard('admin')->user()->role == 'admin')
                        <li>
                            <a href="{{ route('ProductStore.add') }}">Add Product Quantity</a>
                        </li>
                    @endif
                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="ion-ios-compose-outline"></i> Orders</a>
                    <ul class="nav nav-subnav">
                        <li>
                            <a href="{{ route('order.index') }}">All Orders</a>
                        </li>
                        <li>
                            <a href=""> Report</a>
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
                                <a href="{{ route('editor.create') }}">Create New Editor</a>
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
                                <a href="">Logs</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-has-subnav">
                        <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> Setting</a>
                        <ul class="nav nav-subnav">
                            <li>
                                <a href="{{ route('setting.index') }}">Website Setting</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.edit') }}">Edit Website Setting</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.reviews') }}">Website Reviews</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.brands') }}">Website Brands</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.brand_create') }}">Add Website Brand</a>
                            </li>
                        </ul>
                    </li>
                @endif

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