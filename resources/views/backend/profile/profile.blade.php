@extends('backend.layouts.app')
@section('title') Dashboard | Profile @endsection

@section('content')

<div class="card card-profile">
    <div class="card-block card-profile-block text-xs-center text-sm-left">
        <img class="img-avatar img-avatar-96" src="@if ($user->image) {{ asset('storage/'.$user->image) }} @else {{ asset('backend/assets/img/avatars/profile_avatar.png') }} @endif" alt="" />
        <div class="profile-info font-500">
            {{ $user->name }}
            <a class="m-l-sm" href="{{ route('profile.edit', ['id' => Auth::guard('admin')->user()->id, 'name' => Auth::guard('admin')->user()->name]) }}">
                <i class="fa fa-pencil"></i>
            </a>
            <div class="small text-muted text-capitalize m-t-sm">{{ $user->role }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <ul class="nav nav-tabs nav-stacked">
                <li class="active">
                    <a href="#profile-tab1" data-toggle="tab">Account</a>
                </li>
                <li>
                    <a href="#profile-tab2" data-toggle="tab">Security and privacy</a>
                </li>
                <li>
                    <a href="#profile-tab3" data-toggle="tab">Order history</a>
                </li>
                <li>
                    <a href="#profile-tab4" data-toggle="tab">Email notifications</a>
                </li>
                <li>
                    <a href="#profile-tab5" data-toggle="tab">Followers</a>
                </li>
            </ul>
            <!-- .nav-tabs -->
        </div>
        <!-- .card -->
    </div>
    <!-- .col-md-4 -->

    <div class="col-md-9">
        <div class="card">
            <div class="card-block tab-content">
                <!-- Profile tab 1 -->
                <div class="tab-pane fade in active" id="profile-tab1">
                    <!--
                    <form class="fieldset">
                        <h4 class="m-t-sm m-b">General info</h4>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="exampleInputName1">First name</label>
                                <input type="text" class="form-control" id="exampleInputName1" />
                            </div>
                            <div class="col-xs-6">
                                <label for="exampleInputName2">Last name</label>
                                <input type="text" class="form-control" id="exampleInputName2" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="exampleInputPhone1">Mobile phone</label>
                                <input type="tel" class="form-control" id="exampleInputPhone1" />
                            </div>
                            <div class="col-xs-6">
                                <label for="exampleInputPhone2">Work phone</label>
                                <input type="datetime-local" class="form-control" id="exampleInputPhone2" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" class="form-control" id="exampleInputAddress" />
                        </div>

                        <h4 class="m-t-md m-b">Change password</h4>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="exampleInputPassword1">Confirm current password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="col-xs-6">
                                <label for="exampleInputPassword2">Confirm new password</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="exampleInputPassword3">New password</label>
                                <input type="password" class="form-control" id="exampleInputPassword3" />
                            </div>
                        </div>
                        <div class="row narrow-gutter">
                            <div class="col-xs-6">
                                <button type="button" class="btn btn-default btn-block">Cancel</button>
                            </div>
                            <div class="col-xs-6">
                                <button type="button" class="btn btn-app btn-block">Save<span class="hidden-xs"> changes</span></button>
                            </div>
                        </div>
                    </form>
                    -->
                </div>
                <!-- End profile tab 1 -->

                <!-- Profile tab 2 -->
                <div class="tab-pane fade" id="profile-tab2">
                    
                </div>
                <!-- End profile tab 2 -->

                <!-- Profile tab 3 -->
                <div class="tab-pane fade" id="profile-tab3">
                    
                </div>
                <!-- End profile tab 3 -->

                <!-- Profile tab 4 -->
                <div class="tab-pane fade" id="profile-tab4">
                    
                </div>
                <!-- End profile tab 4 -->

                <!-- Profile tab 5 -->
                <div class="tab-pane fade" id="profile-tab5">
                    
                </div>
                <!-- End profile tab 5 -->

            </div>
            <!-- .card-block .tab-content -->
        </div>
        <!-- .card -->
    </div>
    <!-- .col-md-8 -->
</div>

@endsection