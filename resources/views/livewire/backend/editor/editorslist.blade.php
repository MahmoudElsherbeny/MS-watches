<div>

    <div class="card-header">
        <div class="row">
            <div class="col-md-5">
                <h4 class="m-a-0 m-t-xs">Editors (<span id="editor_count">@if($editors){{$editors->total()}}@endif</span>)</h4>
            </div>
            <div class="col-md-7">
                <div class="form-group col-md-9">
                    <input class="form-control" type="text" name="search" wire:model="editor_search" placeholder="Editor Search..." />
                </div>
                <div class="form-group col-md-3">
                    <a href="{{ route('editor.create') }}" class="btn btn-success">Create New Editor</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <!-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="text-center field-sort w-5" wire:click="sortBy('id')" data-field="id" direction="{{ ($sort_field == 'id' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span wire:ignore><i id="arrow_id" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('name')" data-field="name" direction="{{ ($sort_field == 'name' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Name</span>
                        <span wire:ignore><i id="arrow_name" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center hidden-xs">Email</th>
                    <th class="text-center field-sort" wire:click="sortBy('role')" data-field="role" direction="{{ ($sort_field == 'role' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Role</span>
                        <span wire:ignore><i id="arrow_role" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('status')" data-field="status" direction="{{ ($sort_field == 'status' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Status</span>
                        <span wire:ignore><i id="arrow_status" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('email_verified_at')" data-field="email_verified_at" direction="{{ ($sort_field == 'email_verified_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Verification</span>
                        <span wire:ignore><i id="arrow_email_verified_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('created_at')" data-field="created_at" direction="{{ ($sort_field == 'created_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Created At</span>
                        <span wire:ignore><i id="arrow_created_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('updated_at')" data-field="updated_at" direction="{{ ($sort_field == 'updated_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Last Update</span>
                        <span wire:ignore><i id="arrow_updated_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center" style="width: 12%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($editors as $key=>$editor)
                    <tr>
                        <td class="text-center">{{ $editors->firstItem() + $key }}</td>
                        <td class="text-center text-capitalize">{{ $editor->name }}</td>
                        <td class="text-center hidden-xs">{{ $editor->email }} </td>
                        <td class="text-center hidden-xs">{{ $editor->role }}</td>
                        <td class="text-center text-capitalize"> 
                            <span class="status btn btn-sm btn-pill @if($editor->status == 'active') btn-primary @else btn-warning @endif">{{ $editor->status }}</span> 
                        </td>
                        <td class="text-center text-capitalize"> 
                            <span class="status btn btn-sm btn-pill @if($editor->email_verified_at) btn-primary @else btn-warning @endif">
                                @if($editor->email_verified_at) verified @else Not Verify @endif
                            </span> 
                        </td>
                        <td class="text-center">{{ $editor->created_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">{{ $editor->updated_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">
                        @if ($editor->name != 'admin')
                                <div class="btn-group">
                                    <a href="{{ route('editor.edit', ['id' => $editor->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                    <button class="btn btn-app" data-toggle="modal" data-target="#{{ $editor->role.$editor->id }}"><i class="ion-ios-trash-outline"></i></button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="{{ $editor->role.$editor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-card-header">
                                                <div class="row">
                                                    <h4 class="col-md-11 text-left">Delete Editor</h4>
                                                    <ul class="card-actions col-md-1 p-t-md">
                                                        <li>
                                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block text-left">
                                                <p>Are you sure, you want to delete Editor (<span class="text-capitalize">{{ $editor->name }}</span>) ?<br>
                                                    If you delete Editor, you will delete all Editor's data too.</p>
                                                <p> <b>Notice:</b> if you want to stop editor account, you can update it's status to not active instead of delete it.</p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::Open(['url' => route('editor.delete', ['id' => $editor->id]) ]) !!}                                                
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-app" type="submit"> Delete</button>
                                                {!! Form::Close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                        @endif
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>

        {{ $editors->links() }}
    </div>
    <!-- .card-block -->

</div>
