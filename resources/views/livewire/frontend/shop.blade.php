<div>
    {{-- The Master doesn't talk, he acts. --}}

    <!-- Start Filter Menu -->
    <div class="filter__wrap">
        <div class="filter__cart">
            <div class="filter__cart__inner">
                <div class="filter__content">
                    <!-- Start Single Content -->
                    <div class="fiter__content__inner">
                        <div class="single__filter">
                            <h2>Sort By</h2>
                            <ul class="filter__list">
                                <li>
                                    <input type="checkbox" />
                                    <span>Rate</span>
                                </li>
                                <li>
                                    <input type="checkbox" />
                                    <span>Price</span>
                                </li>
                                <li>
                                    <input type="checkbox" />
                                    <span>New</span>
                                </li>
                            </ul>
                        </div>
                        <div class="single__filter">
                            <h2>Tags</h2>
                            <ul class="filter__list">
                                <li>
                                    <input type="checkbox" />
                                    <label for="price0_100">Men</label>
                                </li>
                                <li>
                                    <input type="checkbox" />
                                    <label for="price0_100">Women</label>
                                </li>
                                <li>
                                    <input type="checkbox" />
                                    <label for="price0_100">Kids</label>
                                </li>
                            </ul>
                        </div>
                        <div class="single__filter">
                            <h2>Category</h2>
                            <ul class="filter__list">
                                @foreach ($categories as $category)
                                    <li wire:key={{ $category->id }}>
                                        <input type="checkbox" id="{{ $category->name. $category->id }}" value="{{ $category->id }}" wire:model="filters.categories.{{ $category->id }}" />
                                        <label for="{{ $category->name. $category->id }}">{{ $category->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single__filter">
                            <h2>Price</h2>
                            <ul class="filter__list">
                                <li>
                                    <input type="checkbox" id="price0_100" value="100" wire:model="" />
                                    <label for="price0_100">Less Than $100</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="price100_300" wire:click="priceFilter(100,300)" />
                                    <label for="price100_300">$100 - $300</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="price300_500" />
                                    <label for="price300_500">$300 - $500</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="price500_1000" />
                                    <label for="price500_1000">$500 - $1000</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="price1000_0" />
                                    <label for="price1000_0">$1000 Or More</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Filter Menu -->

    <div class="row">
    
        <div class="product__list another-product-style">
                <!-- Start Single Product -->
                @include('frontend.product.card', ['products' => $this->products])
                <!-- End Single Product -->
                <!-- QUICKVIEW PRODUCT -->
                @include('frontend.product.quickview', ['products' => $this->products])
                <!-- END QUICKVIEW PRODUCT -->
        </div>

        <!-- Start Load More BTn -->
        @if($hasmore)
        <div class="row">
            <div class="col-md-12 mt--60">
                <div class="htc__loadmore__btn">
                    <button wire:click="loadMore({{ $this->products->last()->id }})" wire:loading.remove class="ms-btn black-btn load_products">load more</button>
                </div>
            </div>
        </div>
        @endif
        
        <div class="loading mtb--60">
            <div wire:loading>
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
        <!-- End Load More BTn -->
    
    </div>
    
</div>
    