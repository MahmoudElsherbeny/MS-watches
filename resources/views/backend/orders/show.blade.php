@extends('backend.layouts.app')
@section('title') Dashboard | Orders @endsection

@section('content')

    <!-- States Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="m-a-0 m-t-sm">Order Detailes</h4>
                </div>
            </div>
        </div>
        <div class="card-block order__detailes">
            <div class="order__header text-center m-b-md">
                <table>
                    <tr>
                        <td>Client: </td>
                        <td class="text-capitalize">{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td class="text-capitalize">{{ $order->address.' - '.$order->city.', '.$order->state->state }}</td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <td>Statues: </td>
                        <td>
                            <span class="btn btn-sm btn-pill @if($order->status == 'waiting') btn-warning @elseif($order->status == 'preparing') btn-info @elseif($order->status == 'delivering') btn-primary @elseif($order->status == 'completed') btn-success @else btn-danger @endif">{{ $order->status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Order Date: </td>
                        <td>{{ $order->created_at->format("Y-m-d g:i a") }}</td>
                    </tr>
                    <tr>
                        <td>Delivered Date: </td>
                        <td>@if($order->status == 'completed') {{ $order->updated_at->format("Y-m-d g:i a") }} @endif</td>
                    </tr>
                    <tr>
                        <td>Subtotal: </td>
                        <td>&pound; {{ $order->total/100 }}</td>
                    </tr>
                    <tr>
                        <td>Delivery: </td>
                        <td>&pound; {{ $order->state->delivery }}</td>
                    </tr>
                    <tr>
                        <td>Total: </td>
                        <td>&pound; {{ $order->total/100 + $order->state->delivery }}</td>
                    </tr>
                </table>
            </div>
            <!--  order products list   -->
            <table id="" class="table table-striped table-vcenter js-dataTable-simple m-b-lg">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Live Price</th>
                        <th class="text-center">Order Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
        
                    <?php 
                        $livePriceTotal = $priceTotal = $quantity = $orderTotal = 0;    
                    ?>
                    @foreach ($order->order_items as $key => $item)
                        <tr>
                            <td class="text-center p-y-sm">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize p-y-sm">
                                <a href="{{ route('product.info', ['id' => $item->product_id]) }}">{{ $item->product->name }}</a>
                            </td>
                            <td class="text-center p-y-sm">£ {{ $item->product->price/100 }}</td>
                            <td class="text-center p-y-sm">£ {{ $item->price/100 }}</td>
                            <td class="text-center p-y-sm">{{ $item->quantity }}</td>
                            <td class="text-center p-y-sm">£ {{ $item->price * $item->quantity / 100 }}</td>
                        </tr>
                        <?php
                            $livePriceTotal += $item->product->price;
                            $priceTotal += $item->price;
                            $quantity += $item->quantity;
                            $orderTotal += $item->price * $item->quantity
                        ?>
                    @endforeach

                    <tr>
                        <td class="text-center p-y-sm">Total:</td>
                        <td class="text-center text-capitalize p-y-sm">{{ $order->order_items->count() }}</td>
                        <td class="text-center p-y-sm">£ {{ $livePriceTotal / 100 }}</td>
                        <td class="text-center p-y-sm">£ {{ $priceTotal / 100 }}</td>
                        <td class="text-center p-y-sm">{{ $quantity }}</td>
                        <td class="text-center p-y-sm">£ {{ $orderTotal / 100 }}</td>
                    </tr>
                    
                </tbody>
            </table>

            <!--  order history list   -->
            <h3 class="p-t-lg">Order History</h3>
            <table id="" class="table table-striped table-vcenter js-dataTable-simple m-b-sm">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">User</th>
                        <th class="text-center">User Type</th>
                        <th class="text-center">Log</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach ($order->order_logs as $key => $log)
                        <tr>
                            <td class="text-center p-y-sm">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize p-y-sm">
                                <a href="">{{ $log->user_name($log->id) }}</a>
                            </td>
                            <td class="text-center p-y-sm">{{ $log->user_type }}</td>
                            <td class="text-center p-y-sm">{{ $log->log }}</td>
                            <td class="text-center p-y-sm">{{ $log->date }}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>
        <!-- .card-block -->
    </div>
    <!-- End States Table -->
    
@endsection