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

    {!! Form::Open(['wire:submit.prevent' => 'update', 'files' => true ]) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model.defer="name" />
            @error('name')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input class="form-control @error('address') input-error @enderror" type="text" name="address" wire:model.defer="address" />
            @error('address')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Location:</label>
            <input class="form-control @error('location') input-error @enderror" type="text" name="location" wire:model.defer="location" />
            @error('location')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input class="form-control @error('phone') input-error @enderror" type="text" name="phone" wire:model.defer="phone" />
            @error('phone')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control @error('email') input-error @enderror" type="text" name="email" wire:model.defer="email" />
            @error('phone')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>About US Paragraph:</label>
            <input class="form-control @error('about') input-error @enderror" type="text" name="about" wire:model.defer="about" />
            @error('about')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Facebook Link:</label>
            <input class="form-control @error('facebook') input-error @enderror" type="text" name="facebook" wire:model.defer="facebook" />
            @error('facebook')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Twitter Link:</label>
            <input class="form-control @error('twitter') input-error @enderror" type="text" name="twitter" wire:model.defer="twitter" />
            @error('twitter')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Instagram Link:</label>
            <input class="form-control @error('instagram') input-error @enderror" type="text" name="instagram" wire:model.defer="instagram" />
            @error('instagram')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Website Logo:</label>
            <input id="site_logo" class="@error('logo') input-error @enderror" type="file" name="logo" wire:model="logo" accept="image/*" />
            @error('logo')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            @if($logo)
                <img src="{{ $logo->temporaryUrl() }}" width="45px" height="45px">
            @else
                <img src="{{ asset('storage/'.App\Setting::getSettingValue('logo') ) }}" alt="image" width="45px" height="45px" />
            @endif
        </div>

        <div class="form-group">
            <label>Website Image:</label>
            <input id="site_image" class="@error('image') input-error @enderror" type="file" name="image" wire:model="image" accept="image/*" />
            @error('image')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            @if($image)
                <img src="{{ $image->temporaryUrl() }}" width="180px" height="150px">
            @else
                <img src="{{ asset('storage/'.App\Setting::getSettingValue('image') ) }}" alt="image" width="180px" height="150px" />
            @endif
        </div>

        <div class="form-group">
            <label>Website Video:</label>
            <input id="site_video" class="@error('video') input-error @enderror" type="file" name="video" wire:model="video" accept="video/*" />
            @error('video')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            @if($video)
                <video width="180" height="150" controls>
                    <source src="{{ $video->temporaryUrl() }}">
                </video>
            @else
                <video width="180" height="150" controls>
                    <source src="{{ asset('storage/'.App\Setting::getSettingValue('video') ) }}">
                </video>
            @endif
        </div>


        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('setting.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
