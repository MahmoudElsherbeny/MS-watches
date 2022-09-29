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
                        <td>&pound; {{ $order->delivery }}</td>
                    </tr>
                    <tr>
                        <td>Total: </td>
                        <td>&pound; {{ $order->total/100 + $order->delivery }}</td>
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
                        <td class="text-center p-y-sm">-</td>
                        <td class="text-center text-capitalize p-y-sm">Delivery</td>
                        <td class="text-center p-y-sm">£ {{ $order->delivery }}</td>
                        <td class="text-center p-y-sm">£ {{ $order->delivery }}</td>
                        <td class="text-center p-y-sm">1</td>
                        <td class="text-center p-y-sm">£ {{ $order->delivery }}</td>
                    </tr>
                    <tr>
                        <td class="text-center p-y-sm">Total:</td>
                        <td class="text-center text-capitalize p-y-sm">{{ $order->order_items->count() }}</td>
                        <td class="text-center p-y-sm">-</td>
                        <td class="text-center p-y-sm">-</td>
                        <td class="text-center p-y-sm">{{ $quantity }}</td>
                        <td class="text-center p-y-sm">£ {{ $orderTotal / 100 + $order->delivery }}</td>
                    </tr>
                    
                </tbody>
            </table>

            <div class="form-group m-b-0 p-x-sm">
                <!-- show accept btn (order is created and waiting someone to accept)  -->
                @if($order->admin == null && $order->status != 'completed' && $order->status != 'cancel')
                    <button class="btn btn-success" data-toggle="modal" data-target="#accept_order{{ $order->id }}">Accept</button>
                <!-- 
                    show status btn to admin whatever who accept or what it's status
                    show status btn to editor who accept (order is accepted and status not completed and not cancel)  
                -->
                @elseif(Auth::guard('admin')->user()->role == 'admin' || $order->admin != null && $order->admin->id == Auth::guard('admin')->user()->id && $order->status != 'completed' && $order->status != 'cancel')
                    <button class="btn btn-app" data-toggle="modal" data-target="#status_order{{ $order->id }}">Status</button>
                @else
                    <button class="btn btn-secondory" style="cursor: not-allowed">Taken</button>
                @endif
                <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
            </div>

            <!--   modals   -->
            @if($order->admin == null && $order->status != 'completed' && $order->status != 'cancel')
                <!-- accept order Modal -->
                <div wire:ignore.self class="modal fade" id="accept_order{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-card-header">
                                <div class="row">
                                    <h4 class="col-md-11 text-left">Accept Order</h4>
                                    <ul class="card-actions col-md-1 p-t-md">
                                        <li>
                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block text-left">
                                @if(count($open_orders) > 2)
                                    <p>you have to finsh your open orders first</p>
                                @else
                                    <p>Are you sure, you want to accept this order ?</p>
                                    <p> <b>Notice:</b> you can't disaccept order so be sure.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                @if(count($open_orders) > 2)
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                @else
                                    {!! Form::Open(['url' => route('order.accept', ['id' => $order->id, 'editor' => Auth::guard('admin')->user()->id]), 'class' => 'DeleteFormModal']) !!}                                                
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success" type="submit"> Accept</button>
                                    {!! Form::Close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(Auth::guard('admin')->user()->role == 'admin' || $order->admin != null && $order->admin->id == Auth::guard('admin')->user()->id && $order->status != 'completed' && $order->status != 'cancel')
                @livewire('backend.order.order-status', ['order' => $order], key($order->id))
            @endif

            <div style="border: 1px solid #eee; margin:40px auto; width:92%;"></div>

            <!--  order history list   -->
            <h3 class="p-t-sm">Order History</h3>
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