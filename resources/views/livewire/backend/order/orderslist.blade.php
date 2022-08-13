<div>
    <div class="card-header">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12">
                <h4 class="m-a-0 m-t-xs">Orders (<span>@if($orders){{$orders->total()}}@endif</span>)</h4>
            </div>
            <div class="col-md-6 col-sm-8 col-xs-8 p-r-0">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-6 p-x-0">
                        <div class="form-group" style="display: flex; align-items:center">
                            <label class="m-r-sm">From:</label>
                            <input wire:model="from_search" class="form-control" type="date" />
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-6 p-r-0">
                        <div class="form-group" style="display: flex; align-items:center">
                            <label class="m-r-sm">To:</label>
                            <input wire:model="to_search" class="form-control" type="date" />
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 p-r-0">
                        <div class="form-group" style="display: flex; align-items:center">
                            <select class="form-control" wire:model="status_search">
                                <option value="">all</option>
                                <option value="waiting">waiting</option>
                                <option value="preparing">preparing</option>
                                <option value="delivering">delivering</option>
                                <option value="completed">completed</option>
                                <option value="cancel">cancel</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4 p-r-0">
                <div class="form-group">
                    <input wire:model="order_search" class="form-control" type="text" name="search" placeholder="Order Search..." />
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <!-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="OrdersTable" class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="text-center w-5"></th>
                    <th>User</th>
                    <th class="text-center">Phone</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Recived By</th>
                    <th>Created At</th>
                    <th>Last Update</th>
                    <th class="text-center" style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($orders as $key=>$order)
                    <tr>
                        <td class="text-center">{{ $orders->firstItem() + $key }}</td>
                        <td class="text-center">{{ $order->name }}</td>
                        <td class="text-center">{{ $order->phone }}</td>
                        <td class="text-center">{{ $order->address.' - '.$order->city.', '.$order->state->state }}</td>
                        <td class="text-center">&pound; {{ $order->total/100 + $order->state->delivery }}</td>
                        <td class="text-center text-capitalize">
                            <span class="btn btn-sm btn-pill @if($order->status == 'waiting') btn-warning @elseif($order->status == 'preparing') btn-info @elseif($order->status == 'delivering') btn-primary @elseif($order->status == 'completed') btn-success @else btn-danger @endif">{{ $order->status }}</span>
                        </td>
                        <td class="text-center text-capitalize">@if($order->admin) {{ $order->admin->name }} @endif</td>
                        <td class="text-center">{{ $order->created_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">{{ $order->updated_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-primary">show</a>

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
                                
                            </div> 

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
                                                    <p>yoh have to finsh your open orders first</p>
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

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
    <!-- .card-block -->
</div>
