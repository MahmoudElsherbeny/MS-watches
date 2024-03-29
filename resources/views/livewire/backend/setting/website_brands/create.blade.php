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

    <!--  create product form  -->
    {!! Form::Open(['files' => 'true', 'wire:submit.prevent' => 'store']) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model.defer="name" placeholder="Enter brand name..." />
            @error('name')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Link:</label>
            <input class="form-control @error('link') input-error @enderror" type="text" name="link" wire:model.defer="link" placeholder="Enter brand link..." />
            @error('link')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select class="form-control" name="status" wire:model="status">
                <option value="active">Active</option>
                <option value="not active">Not Active</option>
            </select>
        </div>
        <div class="form-group">
            <label>Brand Logo:</label>
            <input id="brand_logo" class="@error('image') input-error @enderror" type="file" name="image" wire:model="image" accept="image/*" />
            @error('image')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            @if($image)
                <img src="{{ $image->temporaryUrl() }}" width="90px" height="80px">
            @else
                <img src="{{ url('backend/assets/img/photos/upload.png') }}" alt="image" width="90px" height="80px" />
            @endif
        </div>

        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Create</button>
            <a href="{{ route('setting.brands') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
