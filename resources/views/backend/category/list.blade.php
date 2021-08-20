@extends('backend.layouts.app')
@section('title') Dashboard | Categories @endsection

@section('content')

    <!-- Categories Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-xs">Categories (<span id="cat_count">@if($categories){{count($categories)}}@endif</span>)</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="search" id="cat_search" placeholder="Category Search..." />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table id="CategoriesTable" class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center hidden-xs">Icon</th>
                        <th class="text-center hidden-xs">Order</th>
                        <th class="text-center w-15">Status</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Last Update</th>
                        <th class="text-center" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $key=>$category)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">{{ $category->name }}</td>
                            <td class="text-center hidden-xs"><i class="{{ $category->icon }} fa-lg"></i></td>
                            <td class="text-center hidden-xs">{{ $category->order }}</td>
                            <td class="text-center text-capitalize"> 
                                <span class="btn btn-sm btn-pill @if($category->status == 'active') btn-primary @else btn-warning @endif">{{ $category->status }}</span> 
                            </td>
                            <td class="text-center">{{ $category->created_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">{{ $category->updated_at->format("Y-m-d g:i a") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-app" data-toggle="modal" data-target="#category{{ $category->id }}">Delete</button>
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
                                                <p>Are you sure, you want to delete category (<span class="text-capitalize">{{ $category->name }}</span>) ?<br>
                                                    If you delete category, you will delete all category's products too.</p>
                                                <p> <b>Notice:</b> if you want to hide category, you can update it's status to not active instead of delete it.</p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::Open(['url' => route('category.delete', ['id' => $category->id]) ]) !!}                                                
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
        <!-- .card-block -->
    </div>
    <!-- End Categorie Table -->
    
@endsection

@section('js_code')

    <!--  Ajax code for category live search  -->
    <script type="text/javascript">
        $('#cat_search').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url : '{{ route('category.index') }}',
                data:{'cat_search':$value},
                dataType: 'json',
                success:function(categories){

                    $('tbody').html(categories.data);
                    $('#cat_count').text(categories.count);

                }
            });
        })
    </script>
        

    <!-- Page JS Code -->
    <script src="{{ url('backend/assets/js/pages/base_tables_datatables.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready( function () {
            $('#CategoriesTable').DataTable();
        } );
    </script>
@endsection