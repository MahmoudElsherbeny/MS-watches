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

    <!--  add new banner form  -->
    {!! Form::Open(['wire:submit.prevent' => 'update', 'files' => 'true']) !!}
        <div class="form-group">
            <label>Product:</label>
            <input wire:model="product" class="form-control" type="text" value="{{ $banner->product->name }}" readonly />
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select class="form-control" name="status" wire:model="status">
                <option value="active" @if($banner->status == 'active') selected @endif>Active</option>
                <option value="not active" @if($banner->status == 'not active') selected @endif>Not Active</option>
            </select>
        </div>

        <div class="form-group edit_banner_image">
            <label class="form-group">Banner Image:</label>
            <input type="file" name="image" wire:model="image" accept="image/*"  />
            @error('image')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            @if($image)
                <img src="{{ $image->temporaryUrl() }}" width="400px" height="150px">
            @else
                <img src="{{ asset('storage/'.$banner->image) }}" alt="image" width="400px" height="150px" />
            @endif
        </div>

        <div class="form-group m-b-0 m-t-md">
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('Banner.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
