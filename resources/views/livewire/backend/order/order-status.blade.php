<div>
    <!-- status Modal -->
    <div wire:ignore.self class="modal fade" id="status_order{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                {!! Form::Open(['wire:submit.prevent' => 'order_status', 'class' => 'DeleteFormModal']) !!}
                <div class="card-block text-left">
                    <p> <b>Notice:</b> </p>

                    <div class="form-group">
                        <label>Status:</label>
                        <select class="form-control" wire:model="status">
                            <option value="preparing">preparing</option>
                            <option value="delivering">delivering</option>
                            <option value="completed">completed</option>
                            <option value="cancel">cancel</option>
                        </select>
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
</div>
