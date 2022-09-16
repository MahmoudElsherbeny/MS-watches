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

    <!--  create new category form  -->
    {!! Form::Open(['wire:submit.prevent' => 'store']) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model.defer="name" placeholder="Enter category name..." />
            @error('name')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Icon:</label>
            <select class="form-control" name="icon" wire:model="icon">
                <option value="fa fa-th-large" >&#xf009;</option>
                <option value="fa fa-th-list" >&#xf00b;</option>
                <option value="fa fa-chain-broken" >&#xf127;</option>
                <option value="fa fa-paperclip" >&#xf0c6;</option>
                <option value="fa fa-gift" >&#xf06b;</option>
                <option value="fa fa-tags" >&#xf02c;</option>
                <option value="fa fa-star-o" >&#xf006;</option>
                <option value="fa fa-clock-o">&#xf017;</option>
                <option value="ion-trophy" >&#xf356;</option>
                <option value="ion-ios-timer-outline" >&#xf4c0;</option>
                <option value="ion-ios-stopwatch-outline" >&#xf4b4;</option>
                <option value="ion-ios-alarm-outline" >&#xf3c7;</option>
                <option value="ion-android-watch" >&#xf3bd;</option>
                <option value="ion-ios-time-outline" >&#xf4be;</option>
            </select>
        </div>
        <div class="form-group">
            <label>Order:</label>
            <input class="form-control @error('order') input-error @enderror" type="text" name="order" wire:model.order="order" placeholder="Enter category order..." />
            @error('order')
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
        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Create</button>
            <a href="{{ route('category.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
