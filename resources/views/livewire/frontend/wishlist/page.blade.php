<div>

    @if(Session::has('error'))
        <div class="alert alert-danger text-capitalize text-center w-75 m-x-auto" role="alert">
            {{Session::get('error')}}
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success text-capitalize text-center w-75 m-x-auto" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    <!--  check if cart session is empty or not  -->
    @if($wishlist_items->count() > 0)
        <div class="cart__products__container mb--70">
            @foreach ($wishlist_items as $item)
                <div class="cart__product mb--30">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <div class="product__image text-center">
                                <img src="{{ url(App\Product_image::ProductMainImage(Auth::check() ? $item->product_id : $item->id)) }}" alt="product img" />
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-8">
                            <div class="product__content">
                                <div class="title ptb--10">
                                    <div class="row">
                                        <div class="col-md-11 col-sm-9 col-xs-9">
                                            <a href="{{ route('product_detailes', ['id' => Auth::check() ? $item->product_id : $item->id]) }}">
                                                {{ Auth::check() ? $item->product->name : $item->name }}
                                            </a>
                                            <div class="pro__dtl__rating">
                                                <ul class="pro__rating">
                                                    @php $rating = App\Product_review::getProductRate(Auth::check() ? $item->product_id : $item->id); @endphp
                    
                                                    @foreach (range(1,5) as $i)
                                                        @if($rating > 0) 
                                                            @if($rating >= 0.7)
                                                                <li><span class="zmdi zmdi-star"></span></li>
                                                            @elseif($rating >= 0.3)
                                                                <li><span class="zmdi zmdi-star-half"></span></li>
                                                            @else
                                                                <li><span class="zmdi zmdi-star-outline"></span></li>
                                                            @endif                                        
                                                        @else
                                                            <li><span class="zmdi zmdi-star-outline"></span></li>
                                                        @endif
                                                        
                                                        @php $rating-- @endphp
                                                    @endforeach
                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-3 col-xs-3 text-right">
                                            <button class="btn btn-app" wire:click="remove('{{ Auth::check() ? $item->id : $item->rowId }}')"> X</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="price ptb--10">
                                    <span>&pound;{{ Auth::check() ? $item->product->price /100 : $item->price / 100 }}</span>
                                </div>
                                <div class="total ptb--10">
                                    @if ($this->product_quantity(Auth::check() ? $item->product_id : $item->id) > 0)
                                        {!! Form::Open(['url' => route('cart.add',['id' => Auth::check() ? $item->product_id : $item->id]), 'method' => 'GET']) !!}
                                            <ul class="pro__dtl__btn">
                                                <input type="hidden" name="qty" value="1" />
                                                <li class="buy__now__btn">
                                                    <button type="submit">Add To Cart</button>
                                                </li>
                                            </ul>
                                        {!! Form::Close() !!}
                                    @else
                                        <ul class="pro__dtl__btn">
                                            <li class="buy__now__btn">
                                                <button>Out Of Stock</button>
                                            </li>
                                        </ul>
                                    @endif
                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="empty__cart">
            <p>your wishlist is empty <br>start shopping now !</p>
            @if(!Auth::check())
                <span>create account <a href="{{ route('register') }}">SIGNUP</a> OR <a href="{{ route('login') }}">LOGIN</a></span>
            @endif
        </div>
        <div class="empty__cart__button">
            <a href="{{ route('shop') }}" class="ms-btn black-btn">Shop</a>
        </div>
    @endif

</div>
