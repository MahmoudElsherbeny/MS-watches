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

    {!! Form::Open(['files' => 'true', 'wire:submit.prevent' => 'update']) !!}
        <div class="form-group">
            <label>Title:</label>
            <input class="form-control @error('title') input-error @enderror" type="text" name="title" wire:model="title" />
            @error('title')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Subtitle:</label>
            <input class="form-control @error('subtitle') input-error @enderror" type="text" name="subtitle" wire:model="subtitle" />
            @error('subtitle')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Order:</label>
            <input class="form-control @error('order') input-error @enderror" type="text" name="order" wire:model="order" />
            @error('order')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select class="form-control" name="status" wire:model="status">
                <option value="active" >Active</option>
                <option value="not active" >Not Active</option>
            </select>
        </div>
        <div class="form-group">
            <label>Slide Link:</label>
            <select class="form-control" name="link" wire:model="link">
                <option value="shop">shop</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <img src="{{ url('storage/slides/'.$slide->image) }}" width="450px" height="280px" />
        </div>
        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('category.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>