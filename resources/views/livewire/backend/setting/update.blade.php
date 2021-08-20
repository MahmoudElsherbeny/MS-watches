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

    {!! Form::Open(['wire:submit.prevent' => 'update']) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model="name" />
            @error('name')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input class="form-control @error('address') input-error @enderror" type="text" name="address" wire:model="address" />
            @error('address')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input class="form-control @error('phone') input-error @enderror" type="text" name="phone" wire:model="phone" />
            @error('phone')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control @error('email') input-error @enderror" type="text" name="email" wire:model="email" />
            @error('phone')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Facebook Link:</label>
            <input class="form-control @error('facebook') input-error @enderror" type="text" name="facebook" wire:model="facebook" />
            @error('facebook')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Twitter Link:</label>
            <input class="form-control @error('twitter') input-error @enderror" type="text" name="twitter" wire:model="twitter" />
            @error('twitter')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Instagram Link:</label>
            <input class="form-control @error('instagram') input-error @enderror" type="text" name="instagram" wire:model="instagram" />
            @error('instagram')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('category.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
