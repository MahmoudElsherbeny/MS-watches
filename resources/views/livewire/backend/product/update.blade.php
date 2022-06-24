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
    {!! Form::Open(['files' => 'true', 'wire:submit.prevent' => 'update']) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model="name" placeholder="Enter product name..." />
            @error('name')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Category:</label>
            <select class="form-control" name="category" wire:model="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Small Description:</label>
            <textarea class="form-control" name="mini_description" wire:model="mini_description" rows="4">Enter small product description...</textarea>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea class="form-control" id="prod_description" name="description" wire:model="description" rows="4">Enter product description...</textarea>
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input class="form-control @error('price') input-error @enderror" type="text" name="price" wire:model="price" placeholder="Enter product price..." />
            @error('price')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Body Color:</label>
            <input class="form-control @error('body_color') input-error @enderror" type="text" name="body_color" wire:model="body_color" placeholder="Enter Watche body color..." />
            @error('body_color')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Mina Color:</label>
            <input class="form-control @error('mina_color') input-error @enderror" type="text" name="mina_color" wire:model="mina_color" placeholder="Enter Watche mina color..." />
            @error('mina_color')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tags:</label>
            <select class="form-control" name="tags" wire:model="tags">
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="kids">kids</option>
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
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('product.info', ['id' => $product->id ]) }}" class="btn btn-info">Detailes</a>
            <a href="{{ route('product.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
