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
    {!! Form::Open(['wire:submit.prevent' => 'update', 'files' => 'true']) !!}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control @error('name') input-error @enderror" type="text" name="name" wire:model.defer="name" placeholder="Enter product name..." />
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
            <textarea class="form-control" name="mini_description" wire:model.defer="mini_description" rows="4"></textarea>
            @error('mini_description')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group" wire:ignore>
            <label>Description:</label>
            <textarea wire:model="description" data-prod_description_edit="@this" class="form-control" id="prod_description_edit" name="description" rows="4"> {{  $product->description }}</textarea>
            @error('description')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input class="form-control @error('price') input-error @enderror" type="text" name="price" wire:model.defer="price" placeholder="Enter product price..." />
            @error('price')
                <div class="msg-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tags:</label>
            <select class="form-control" name="tags" wire:model="tags">
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="kids">kids</option>
                <option value="others">others</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select class="form-control" name="status" wire:model="status">
                <option value="active">Active</option>
                <option value="not active">Not Active</option>
            </select>
        </div>

        <div class="form-group m-t-md m-b-sm">
            <div class="row">
                <div class="col-md-5">
                    <label>Attribute type:</label>
                </div>
                <div class="col-md-6">
                    <label>Attribute Value:</label>
                </div>
            </div>
        </div>
        @foreach ($attr_data as $index => $attr)
            <div class="form-group" wire:key="attr_{{ $index }}">
                <div class="row">
                    <div class="col-md-5">
                        <select class="form-control" name="attribute_type" wire:model="attr_data.{{ $index }}.type">
                            <option value="">Choose Attribute</option>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input wire:model.defer="attr_data.{{ $index }}.value" class="form-control" type="text" name="attribute_value" placeholder="Enter attribute value..." />
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="#" wire:click.prevent="removeAttribute({{ $index }})">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="form-group">
            <button wire:click.prevent="addMoreAttributes" class="btn btn-primary">Add More Attributes</button>
        </div>

        <div class="form-group m-b-0">
            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('product.info', ['id' => $product->id ]) }}" class="btn btn-info">Detailes</a>
            <a href="{{ route('product.index') }}" class="btn btn-app">Back</a>
        </div>
    {!! Form::Close() !!}

</div>
