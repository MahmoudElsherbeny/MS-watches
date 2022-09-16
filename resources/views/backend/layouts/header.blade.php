<!-- Header -->
<header class="app-layout-header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-page-title">Dashboard</span>
            </div>

            <div class="collapse navbar-collapse" id="header-navbar-collapse">
                <!-- Header search form -->
                <form class="navbar-form navbar-left app-search-form" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" type="search" id="search-input" placeholder="Search..." />
                            <span class="input-group-btn">
                                <button class="btn" type="button"><i class="ion-ios-search-strong"></i></button>
                            </span>
                        </div>
                    </div>
                </form>

                <!-- .navbar-left -->

                <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                    <li>
                        <!-- Opens the modal found at the bottom of the page -->
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#apps-modal"><i class="ion-grid"></i></a>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="ion-ios-bell"></i> 
                            @livewire('backend.notifications.counter')
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right notification-dropdown" id="notification-dropdown">
                            <!--  notifications menu  -->
                            @livewire('backend.notifications.menu')
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown">
                            <span class="text-capitalize m-r-sm">@if(Auth::guard('admin')->user()) {{ Auth::guard('admin')->user()->name }} @endif</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right my-profile-dropdown">
                            <li>
                                <a href="{{ route('profile.index', ['id' => Auth::guard('admin')->user()->id, 'name' => Auth::guard('admin')->user()->name]) }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit', ['id' => Auth::guard('admin')->user()->id, 'name' => Auth::guard('admin')->user()->name]) }}">Edit Profile</a>
                            </li>
                            {!! Form::Open(['url'=>route('AdminAuth.logout')]) !!}
                            <li>
                                <button type="submit">Logout</button>
                            </li>
                            {!! Form::Close() !!}
                        </ul>
                    </li>
                </ul>
                <!-- .navbar-right -->
                
            </div>
        </div>
        <!-- .container-fluid -->
    </nav>
    <!-- .navbar-default -->
</header>
<!-- End header -->