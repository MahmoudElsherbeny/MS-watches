<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="col-md-3">
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
                                        <input type="radio" id="sort_all" name="sort_by" value="" wire:model="filters.sort" />
                                        <label for="sort_all">All</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="sort_rate" name="sort_by" value="rate" wire:model="filters.sort" />
                                        <label for="sort_rate">Rate</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="sort_price" name="sort_by" value="price" wire:model="filters.sort" />
                                        <label for="sort_price">Price</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="sort_new" name="sort_by" value="created_at" wire:model="filters.sort" />
                                        <label for="sort_new">New</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="single__filter">
                                <h2>Tags</h2>
                                <ul class="filter__list">
                                    <li>
                                        <input type="radio" id="tags_all" name="tags" value="" wire:model="filters.tags" />
                                        <label for="tags_all">All</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="tags_men" name="tags" value="men" wire:model="filters.tags" />
                                        <label for="tags_men">Men</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="tags_women" name="tags" value="women" wire:model="filters.tags" />
                                        <label for="tags_women">Women</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="tags_kids" name="tags" value="kids" wire:model="filters.tags" />
                                        <label for="tags_kids">Kids</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="single__filter">
                                <h2>Category</h2>
                                <ul class="filter__list">
                                    @foreach ($categories as $category)
                                        <li>
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
                                        <input type="radio" id="priceAll" name="prices" value="" wire:model="filters.prices" />
                                        <label for="priceAll">All</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="price0_100" name="prices" value="1,100" wire:model="filters.prices" />
                                        <label for="price0_100">Less Than $100</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="price100_300" name="prices" value="100,300" wire:model="filters.prices" />
                                        <label for="price100_300">$100 - $300</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="price300_500" name="prices" value="300,500" wire:model="filters.prices" />
                                        <label for="price300_500">$300 - $500</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="price500_1000" name="prices" value="500,1000" wire:model="filters.prices" />
                                        <label for="price500_1000">$500 - $1000</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="price1000_0" name="prices" value="1000,0" wire:model="filters.prices" />
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
    </div>

    <div class="col-md-9">
        @if(count($this->products))
            <div class="product__list another-product-style">
                <!-- Start Single Product -->
                @include('frontend.product.card', ['products' => $this->products])
                <!-- End Single Product -->
                <!-- QUICKVIEW PRODUCT -->
                @include('frontend.product.quickview', ['products' => $this->products])
                <!-- END QUICKVIEW PRODUCT -->
            </div>
        @else
            <div class="no_product">
                @if($this->filtersNotEmpty())
                    <p>No Products Matches !</p>
                @else
                    <p>No Products For Now. Wait for New <span>Collection</span> !</p>
                @endif
            </div>
        @endif

        <!-- Start Load More BTn -->
        <div class="loading_container">
            @if($this->hasMore())
                <div class="mt--60">
                    <div class="htc__loadmore__btn">
                        <button wire:click="loadMore" wire:loading.remove class="ms-btn black-btn load_products">load more</button>
                    </div>
                </div>

                <div class="loading mtb--50">
                    <div wire:loading>
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
             @endif
        </div>
        <!-- End Load More BTn -->
        
        <!-- Start Copyright Area -->
        <div class="htc__copyright__area">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="copyright__inner">
                        <div class="copyright">
                            <p>Copyright © 2020 <a href="https://freethemescloud.com/">Mahmoud Elsherbeny</a>
                            All Right Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->

    </div>
        
</div>
    