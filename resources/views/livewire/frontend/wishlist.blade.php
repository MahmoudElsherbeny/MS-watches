<div>

    <!--  check if cart session is empty or not  -->
    @if($wishlist_items->count() > 0)
        <div class="wishlist-content">
            <form action="#">
                <div class="wishlist-table table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="product-remove"><span class="nobr">Remove</span></th>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name"><span class="nobr">Product Name</span></th>
                                <th class="product-price"><span class="nobr"> Unit Price </span></th>
                                <th class="product-stock-stauts"><span class="nobr"> Stock Status </span></th>
                                <th class="product-add-to-cart"><span class="nobr">Add To Cart</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist_items as $key => $prod)
                            <tr>
                                <td class="product-remove"><a href="#">×</a></td>
                                <td class="product-thumbnail"><img src="{{ url('frontend/images/product/3.png') }}" alt="" /></td>
                                <td class="product-name"><a href="{{ route('product_detailes', ['id' => $prod->id]) }}">{{ $prod->name }}</a></td>
                                <td class="product-price"><span class="amount">£{{ $prod->price / 100 }}</span></td>
                                <td class="product-stock-status"><span class="wishlist-in-stock">In Stock</span></td>
                                <td class="product-add-to-cart"><a href="{{ route('cart.add',['id' => $prod->id]) }}"> Add to Cart</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="wishlist-share">
                                        <h4 class="wishlist-share-title">Share on:</h4>
                                        <div class="social-icon">
                                            <ul>
                                                <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
                                                <li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
                                                <li><a href="#"><i class="zmdi zmdi-tumblr"></i></a></li>
                                                <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                                <li><a href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>  
            </form>
        </div>
    @else
        <div class="empty__cart">
            <p>your Wishlist is empty <br>start shopping now !</p>
            @if(!Auth::check())
                <span>create account <a href="{{ route('register') }}">SIGNUP</a> OR <a href="{{ route('login') }}">LOGIN</a></span>
            @endif
        </div>
        <div class="empty__cart__button">
            <a href="{{ route('shop') }}" class="ms-btn black-btn">Shop</a>
        </div>
    @endif

</div>
