@foreach ($editors as $key=>$editor)
    <tr>
        <td class="text-center">{{ $key+1 }}</td>
        <td class="text-center text-capitalize">{{ $editor->name }}</td>
        <td class="text-center hidden-xs">{{ $editor->email }} </td>
        <td class="text-center hidden-xs">{{ $editor->role }}</td>
        <td class="text-center text-capitalize"> 
            <span class="btn btn-sm btn-pill @if($editor->status == 'active') btn-primary @else btn-warning @endif">{{ $editor->status }}</span> 
        </td>
        <td class="text-center">{{ $editor->created_at->format("Y-m-d g:i a") }}</td>
        <td class="text-center">{{ $editor->updated_at->format("Y-m-d g:i a") }}</td>
        <td class="text-center">
            <div class="btn-group">
                <a href="{{ route('editor.edit', ['id' => $editor->id]) }}" class="btn btn-success">Edit</a>
                <button class="btn btn-app" data-toggle="modal" data-target="#{{ $editor->role.$editor->id }}">Delete</button>
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

        </td>
    </tr>
@endforeach