@extends('backend.layouts.app')
@section('title') Dashboard | Editors @endsection

@section('content')
    
    <!-- Create Category Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="text-capitalize">Update Editor {{ $editor->name }} Permission</h4>
        </div>

            @if(Session::has('error'))
                <div class="alert alert-danger text-capitalize w-75 m-x-auto" role="alert">
                    {{Session::get('error')}}
                </div>
            @elseif(Session::has('success'))
                <div class="alert alert-success text-capitalize w-75 m-x-auto" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif

        <div class="card-block">
            {!! Form::Open() !!}
                <div class="form-group">
                    <label>Name:</label>
                    <input class="form-control" type="text" value="{{ $editor->name }}" readonly />
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="text" value="{{ $editor->email }}" readonly />
                </div>
                <div class="form-group">
                    <label>Role:</label>
                    <select class="form-control" name="role">
                        <option value="admin" @if($editor->role == 'admin') selected @endif>Admin</option>
                        <option value="editor" @if($editor->role == 'editor') selected @endif>Editor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control" name="status">
                        <option value="active" @if($editor->status == 'active') selected @endif>Active</option>
                        <option value="not active" @if($editor->status == 'not active') selected @endif>Not Active</option>
                    </select>
                </div>
                <div class="form-group m-b-0">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('editor.index') }}" class="btn btn-app">Back</a>
                </div>
            {!! Form::Close() !!}
        </div>
    </div>
    <!-- End Create Category Form -->

@endsection