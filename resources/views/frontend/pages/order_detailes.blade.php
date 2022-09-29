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
                        <h2 class="bradcaump-title">Order Detailes</h2>
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
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

                <div class="order__bill text-center mb--20">
                    <div class="order__header mb--20 pb--20">
                        <h2 class="mb--40">Order Bill</h2>
                        <table>
                            <tr>
                                <td>Client: </td>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <td>Address: </td>
                                <td>{{ $order->address.' - '.$order->city.', '.$order->state->state }}</td>
                            </tr>
                            <tr>
                                <td>Phone: </td>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <td>Date: </td>
                                <td>{{ $order->created_at->format("Y-m-d") }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="order__products mb--20 pb--20">
                        <table>
                            @foreach ($order->order_items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>&pound; {{ $item->price/100 }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>&pound; {{ ($item->price*$item->quantity)/100 }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="order__footer">
                        <table>
                            <tr>
                                <td>Subtotal: </td>
                                <td>&pound; {{ $order->total/100 }}</td>
                            </tr>
                            <tr>
                                <td>Delivery: </td>
                                <td>&pound; {{ $order->delivery }}</td>
                            </tr>
                            <tr>
                                <td>Total: </td>
                                <td>&pound; {{ $order->total/100 + $order->delivery }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="order__bill_buttons text-center">
                    @if ($order->status == 'waiting' || $order->status == 'preparing')
                        {!! Form::Open() !!}
                            <button type="submit" class="btn btn-danger">Cancel Order</button>
                        {!! Form::Close() !!}
                    @elseif ($order->status == 'delivering')
                        <p>Sorry order can't edit or canceled, it's delivering now!</p>
                    @elseif ($order->status == 'completed')
                        <p>Order completed!</p>
                    @else 
                        <p>Order is canceled!</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('copyright')
    @include('frontend.layouts.copyright')
@endsection