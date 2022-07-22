<div>
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 col-sm-4 col-xs-4">
                <h4 class="m-a-0 m-t-xs">Orders (<span>@if($orders){{$orders->total()}}@endif</span>)</h4>
            </div>
            <div class="col-md-6 col-sm-8 col-xs-8">
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
                        <td class="text-center">{{ $order->created_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">{{ $order->updated_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-primary">show</a>
                                @if(Auth::guard('admin')->user()->role == 'admin')
                                    <button class="btn btn-app" data-toggle="modal" data-target="#order{{ $order->id }}">Status</button>
                                @else
                                    @if($order->status != 'completed' && $order->status != 'cancel') 
                                        <button class="btn btn-app" data-toggle="modal" data-target="#order{{ $order->id }}">Status</button>
                                    @endif
                                @endif
                            </div>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="order{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Update Order Status</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        {!! Form::Open(['wire:submit.prevent' => 'order_status('.$order->id.')', 'class' => 'DeleteFormModal']) !!}
                                        <div class="card-block text-left">
                                            <p> <b>Notice:</b> </p>

                                            <div class="form-group">
                                                <label>Status:</label>
                                                <select class="form-control" wire:model="status">
                                                    <option value="waiting" @if($order->status == 'waiting') selected @endif>waiting</option>
                                                    <option value="preparing" @if($order->status == 'preparing') selected @endif>preparing</option>
                                                    <option value="delivering" @if($order->status == 'delivering') selected @endif>delivering</option>
                                                    <option value="completed" @if($order->status == 'completed') selected @endif>completed</option>
                                                    <option value="cancel" @if($order->status == 'cancel') selected @endif>cancel</option>
                                                </select>
                                                @error('new_price')
                                                    <div class="msg-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                            <button class="btn btn-success SubmittFormModal" type="submit"> Update</button>
                                        </div>
                                        {!! Form::Close() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
    <!-- .card-block -->
</div>
