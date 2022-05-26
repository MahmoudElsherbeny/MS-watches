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

    <!--  create state form  -->
    {!! Form::Open(['wire:submit.prevent' => 'store']) !!}
        <div class="form-group">
            <label>State:</label>
            <input class="form-control @error('state') input-error @enderror" type="text" name="state" wire:model="state" placeholder="Enter state name..." />
            @error('state')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Delivery Cost:</label>
            <input class="form-control @error('delivery') input-error @enderror" type="text" name="delivery" wire:model="delivery" placeholder="Enter delivery cost..." />
            @error('delivery')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Create</button>
            <a href="{{ route('state.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
