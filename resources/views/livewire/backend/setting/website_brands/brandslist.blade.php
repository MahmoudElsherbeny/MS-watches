<div>
    <div class="card-header">
        <div class="row">
            <div class="col-md-5">
                <h4 class="m-a-0 m-t-xs">Website Brands (<span>{{count($brands)}}</span>)</h4>
            </div>
            <div class="col-md-7">
                <div class="form-group col-md-9">
                    <input class="form-control" type="text" name="search" placeholder="Brand Search..." wire:model.debounce.1500ms="brand_search" />
                </div>
                <div class="form-group col-md-3">
                    <a href="{{ route('setting.brand_create') }}" class="btn btn-success">Create New Brand</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="text-center w-5">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Link</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Last Update</th>
                    <th class="text-center" style="width: 12%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($brands as $brand)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center text-capitalize">{{ $brand->name }}</td>
                        <td class="text-center text-capitalize">
                            <img src="{{ asset('storage/' . $brand->image) }}" width="70" height="64" />
                        </td>
                        <td class="text-center">
                            <a href="{{ $brand->link }}" style="text-decoration:underline;" target="_blank">{{ $brand->link }}</a>
                        </td>
                        <td class="text-center">
                            <span class="status btn btn-sm btn-pill @if($brand->status == 'active') btn-primary @else btn-warning @endif">{{ $brand->status }}</span> 
                        </td>
                        <td class="text-center text-capitalize">{{ $brand->updated_at->format('Y-m-d g:i a') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('setting.brand_edit', ['id' => $brand->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                <button class="btn btn-app" data-toggle="modal" data-target="#Brand{{ $brand->id }}"><i class="ion-ios-trash-outline"></i></button>
                            </div>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="Brand{{ $brand->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Delete Brand</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block text-left">
                                            <p>Are you sure, you want to delete brand ({{ $brand->name }}) from website brands ?</p>
                                            <p> <b>Notice:</b> if you want to hide brand, you can update it's status to not active instead of remove it.</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::Open(['wire:submit.prevent' => 'destroy('.$brand->id.')', 'class' => 'DeleteFormModal']) !!}                                                
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-app" type="submit"> Delete</button>
                                            {!! Form::Close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
</div>
