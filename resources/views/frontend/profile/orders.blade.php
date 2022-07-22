@extends('frontend.layouts.app')
@section('title')  {{ Auth::user()->name }} @endsection

@section('content')

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(../../../frontend/images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Orders</h2>
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active">Profile</span>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active">Orders</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__orders__area ptb--90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th class="date">Order Date</th>
                                <th class="date">Delivered Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                            <tr>
                                <td>
                                    <a href="{{ route('UserOrder.detailes', ['id' => $order->id, 'name' => Auth::user()->name, 'user' => Auth::user()->id]) }}">more</a>
                                </td>
                                <td class="text-capitalize">{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td class="text-capitalize">{{ $order->address.' - '.$order->city.', '.$order->state->state }}</td>
                                <td class="text-capitalize">
                                    <span class="status btn btn-sm @if($order->status == 'waiting') btn-warning @elseif($order->status == 'preparing') btn-info @elseif($order->status == 'delivering') btn-primary @elseif($order->status == 'completed') btn-success @else btn-danger @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>&pound; {{ $order->total / 100 + $order->state->delivery }}</td>
                                <td class="date">{{ $order->created_at->format("Y-m-d g:i a") }}</td>
                                <td class="date">
                                    @if ($order->status == 'completed')
                                        {{ $order->updated_at->format("Y-m-d g:i a") }}
                                    @elseif ($order->status == 'cancel')
                                        Canceled
                                    @else
                                        Delivering...
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('copyright')
    @include('frontend.layouts.copyright')
@endsection