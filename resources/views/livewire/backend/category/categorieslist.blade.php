<div>

    <div class="card-header">
        <div class="row">
            <div class="col-md-5">
                <h4 class="m-a-0 m-t-xs">Categories (<span id="cat_count">@if($categories){{count($categories)}}@endif</span>)</h4>
            </div>
            <div class="col-md-7">
                <div class="form-group col-md-9">
                    <input wire:model.debounce.1500ms="category_search" class="form-control" type="text" name="search" placeholder="Category Name Search..." />
                </div>
                <div class="form-group col-md-3">
                    <a href="{{ route('category.create') }}" class="btn btn-success">Create Category</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table class="table table-striped table-vcenter js-dataTable-simple">
            <thead>
                <tr>
                    <th class="w-5 text-center field-sort" wire:click="sortBy('id')" data-field="id" direction="{{ ($sort_field == 'id' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span wire:ignore><i id="arrow_id" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('name')" data-field="name" direction="{{ ($sort_field == 'name' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Name</span>
                        <span wire:ignore><i id="arrow_name" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center hidden-xs">Icon</th>
                    <th class="text-center field-sort" wire:click="sortBy('order')" data-field="order" direction="{{ ($sort_field == 'order' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Order</span>
                        <span wire:ignore><i id="arrow_order" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('status')" data-field="status" direction="{{ ($sort_field == 'status' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Status</span>
                        <span wire:ignore><i id="arrow_status" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('created_at')" data-field="created_at" direction="{{ ($sort_field == 'created_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Created At</span>
                        <span wire:ignore><i id="arrow_created_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center field-sort" wire:click="sortBy('updated_at')" data-field="updated_at" direction="{{ ($sort_field == 'updated_at' && $sort_dir == 'desc') ? 'asc' : 'desc' }}">
                        <span style="padding-right: 5px">Last Update</span>
                        <span wire:ignore><i id="arrow_updated_at" class="fa fa-sort"></i></span>
                    </th>
                    <th class="text-center" style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center text-capitalize">
                            <a href="{{ route('category.info', ['id' => $category->id]) }}">{{ $category->name }}</a>
                        </td>
                        <td class="text-center hidden-xs"><i class="{{ $category->icon }} fa-lg"></i></td>
                        <td class="text-center hidden-xs">{{ $category->order }}</td>
                        <td class="text-center text-capitalize"> 
                            <span class="status btn btn-sm btn-pill @if($category->status == 'active') btn-primary @else btn-warning @endif">{{ $category->status }}</span> 
                        </td>
                        <td class="text-center">{{ $category->created_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">{{ $category->updated_at->format("Y-m-d g:i a") }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-success"><i class="ion-ios-compose-outline"></i></a>
                                <button class="btn btn-app" data-toggle="modal" data-target="#category{{ $category->id }}"><i class="ion-ios-trash-outline"></i></button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="category{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-card-header">
                                            <div class="row">
                                                <h4 class="col-md-11 text-left">Delete Category</h4>
                                                <ul class="card-actions col-md-1 p-t-md">
                                                    <li>
                                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block text-left">
                                            <p>Are you sure, you want to delete category (<span class="text-capitalize">{{ $category->name }}</span>) ?</p>
                                            <p> you delete category, you will delete category slides, products, products banners and products quantity store too.</p><br>
                                            <p> <b>Notice:</b> if you want to hide category, you can update it's status to not active instead of delete it.</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::Open(['wire:submit.prevent' => 'destroy('.$category->id.')', 'class' => 'DeleteFormModal']) !!}                                                
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