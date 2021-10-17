<div>
    
    <table class="table table-striped table-vcenter js-dataTable-simple">
        <thead>
            <tr>
                <th class="text-center w-5">#</th>
                <th class="text-center">State</th>
                <th class="text-center">Delivery</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Last Update</th>
                <th class="text-center" style="width: 20%;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($states as $key=>$state)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center text-capitalize">{{ $state->state }}</td>
                    <td class="text-center">£{{ $state->delivery }}</td>
                    <td class="text-center">{{ $state->created_at->format("Y-m-d g:i a") }}</td>
                    <td class="text-center">{{ $state->updated_at->format("Y-m-d g:i a") }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-success" data-toggle="modal" data-target="#StateEdit{{ $state->id }}">Edit</button>
                        </div>
                    </td>

                    <!-- edit Modal -->
                        <div class="modal fade" id="StateEdit{{ $state->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-card-header">
                                    <div class="row">
                                        <h4 class="col-md-11 text-left">Edit State ({{ $state->state }})</h4>
                                        <ul class="card-actions col-md-1 p-t-md">
                                            <li>
                                                <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {!! Form::Open(['wire:submit.prevent' => 'update']) !!}
                                <div class="card-block text-left">
                                    <div class="form-group">
                                        <label>State:</label>
                                        <input class="form-control" type="text" name="state" wire:model="state" />
                                    </div>
                                    <div class="form-group">
                                        <label>Delivery Cost:</label>
                                        <input class="form-control" type="text" name="delivery" wire:model="delivery" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                    <button class="btn btn-success" type="submit"> Update</button>
                                </div>
                                {!! Form::Close() !!}
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </tr>
            @endforeach
            
        </tbody>
    </table>

</div>
