@extends('backend.layouts.app')
@section('title') Dashboard | Profile @endsection

@section('content')

<div class="card card-profile">
    <div class="card-block card-profile-block text-xs-center text-sm-left">
        <img class="img-avatar img-avatar-96" src="@if ($editor->image) {{ asset('storage/'.$editor->image) }} @else {{ asset('backend/assets/img/avatars/profile_avatar.png') }} @endif" alt="" />
        <div class="profile-info font-500">
            <span class="text-capitalize m-t-sm name">{{ $editor->name }}</span>
            <a class="m-l-sm" href="{{ route('profile.edit', ['id' => $editor->id, 'name' => $editor->name]) }}">
                <i class="fa fa-pencil"></i>
            </a>
            <div class="small text-muted text-capitalize m-t-sm">{{ $editor->role }}</div>
            <div class="small text-muted text-capitalize m-t-xs">joined at: {{ $editor->created_at->format('Y-m-d') }}</div>
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
                    <a href="#profile-orders" data-toggle="tab">Orders</a>
                </li>
                <li>
                    <a href="#profile-notifications" data-toggle="tab">Notifications</a>
                </li>
                <li>
                    <a href="#profile-tab4" data-toggle="tab">Followers</a>
                </li>
                <li>
                    <a href="#profile-tab5" data-toggle="tab">Security and privacy</a>
                </li>
            </ul>
            <!-- .nav-tabs -->
        </div>
        <!-- .card -->
    </div>
    <!-- .col-md-4 -->

    <div class="col-md-9">
        <div class="card">
            <div class="tab-content">
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

                <!-- Profile orders -->
                <div class="tab-pane fade" id="profile-orders">
                        <!--   open orders   -->
                        <div class="card-header">
                            <h4 class="m-a-0 m-t-md p-x-sm">Open Orders (<span>{{count($open_orders)}}</span>)</h4>
                        </div>
                        <div class="card-block">
                            <!--  editor's open orders list  -->
                            <table class="table table-striped table-vcenter js-dataTable-simple">
                                <thead>
                                    <tr>
                                        <th class="text-center w-5">#</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Last Update</th>
                                        <th class="text-center" style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($open_orders as $key => $order)
                                        <tr>
                                            <td class="text-center">{{ $key+1 }}</td>
                                            <td class="text-center text-capitalize">{{ $order->name }}</td>
                                            <td class="text-center">£ {{ $order->total/100 }}</td>
                                            <td class="text-center text-capitalize">
                                                <span class="btn btn-sm btn-pill @if($order->status == 'waiting') btn-warning @elseif($order->status == 'preparing') btn-info @elseif($order->status == 'delivering') btn-primary @elseif($order->status == 'completed') btn-success @else btn-danger @endif">{{ $order->status }}</span>
                                            </td>
                                            <td class="text-center">{{ $order->created_at->format("Y-m-d g:i a") }}</td>
                                            <td class="text-center">{{ $order->updated_at->format("Y-m-d g:i a") }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-primary">show</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                        </div>

                        <div style="border: 1px solid #eee; margin:34px auto; width:92%;"></div>

                        <!--   completed orders   -->
                        <div class="card-header">
                            <h4 class="m-a-0 m-t-sm p-x-sm">Completed Orders (<span>{{count($completed_orders)}}</span>)</h4>
                        </div>
                        <div class="card-block">
                            <!--  editor's completed orders list  -->
                            <table class="table table-striped table-vcenter js-dataTable-simple">
                                <thead>
                                    <tr>
                                        <th class="text-center w-5">#</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Last Update</th>
                                        <th class="text-center" style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completed_orders as $key => $order)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center text-capitalize">{{ $order->name }}</td>
                                            <td class="text-center">£ {{ $order->total/100 }}</td>
                                            <td class="text-center text-capitalize">
                                                <span class="btn btn-sm btn-pill @if($order->status == 'waiting') btn-warning @elseif($order->status == 'preparing') btn-info @elseif($order->status == 'delivering') btn-primary @elseif($order->status == 'completed') btn-success @else btn-danger @endif">{{ $order->status }}</span>
                                            </td>
                                            <td class="text-center">{{ $order->created_at->format("Y-m-d g:i a") }}</td>
                                            <td class="text-center">{{ $order->updated_at->format("Y-m-d g:i a") }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-primary">show</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                        </div>
                </div>
                <!-- End profile orders -->

                <!-- Profile notifications -->
                <div class="tab-pane fade" id="profile-notifications">
                    <div class="card-block p-a-0">
                        <ul class="profile-notifications-list">
                            @foreach(App\Admin::find(Auth::guard('admin')->user()->id)->Subnotifications as $notify)
                                <li class="notification @if(!$notify->read_at) unread @endif">
                                    <a href="{{ route('AdminNotification.read', ['id' => $notify->id]) }}" class="mark_as_read">
                                        <span class="data">
                                            <span class="title">{{ $notify->notification->data['title'] }}</span>
                                            <span class="description">{{ $notify->notification->data['description'] }}</span>
                                        </span>
                                        <span class="date">{{ $notify->notification->created_at->diffForHumans() }}</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- End profile notifications -->

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