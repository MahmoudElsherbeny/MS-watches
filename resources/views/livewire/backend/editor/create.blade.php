<div>
   
    @if(Session::has('error'))
        <div class="alert alert-danger text-capitalize w-75 m-x-auto" role="alert">
            {{Session::get('error')}}
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success text-capitalize w-75 m-x-auto" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    {!! Form::Open(['wire:submit.prevent' => 'store']) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model="name" placeholder="Enter user name..."  />
            @error('name')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control @error('email') input-error @enderror" type="text" name="email" wire:model="email" placeholder="Enter user email..." />
            @error('email')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input class="form-control @error('password') input-error @enderror" type="password" name="password" wire:model="password" placeholder="Enter password..." />
            @error('password')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select class="form-control" name="role" wire:model="role">
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select class="form-control" name="status" wire:model="status">
                <option value="active">Active</option>
                <option value="not active">Not Active</option>
            </select>
        </div>
        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Create</button>
            <a href="{{ route('editor.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
