<div>

    @if(Auth::check())
        @if(App\Product_review::userReviewCheck($productId,Auth::user()->id) == false)
            {!! Form::Open(['wire:submit.prevent' => 'review_store', 'method' => 'get', 'id' => 'review-form']) !!}
                <div class="rating__wrap">
                    <h2 class="rating-title">Write  A review</h2>
                    <div class="rating__stars">
                        <h4 class="rating-title-2">Your Rating:</h4>
                        <div class="rating__list">
                            <!-- Start Single List -->
                            <div class="rating">
                                <input class="star star1" id="star1" type="radio" wire:model="rate" name="rate" value="5" />
                                <label class="star star1" for="star1"></label>
                                <input class="star star2" id="star2" type="radio" wire:model="rate" name="rate" value="4" />
                                <label class="star star2" for="star2"></label>
                                <input class="star star3" id="star3" type="radio" wire:model="rate" name="rate" value="3" />
                                <label class="star star3" for="star3"></label>
                                <input class="star star4" id="star4" type="radio" wire:model="rate" name="rate" value="2" />
                                <label class="star star4" for="star4"></label>
                                <input class="star star5" id="star5" type="radio" wire:model="rate" name="rate" value="1" />
                                <label class="star star5" for="star5"></label>
                            </div>
                            <!-- End Single List -->
                        </div>
                    </div>
                </div>
                <!-- End RAting Area -->
                <div class="review__box mb--50">
                    <div class="single-review-form">
                        <div class="review-box message">
                            <textarea wire:model="review" name="review" placeholder="Write your review"></textarea>
                        </div>
                    </div>
                    <div class="review-btn">
                        <button class="fv-btn" type="submit">send</button>
                    </div>
                </div>
            {!! Form::Close() !!}
        @endif
    @else
        <div class="review__denied text-center mb--60">
            <a href="{{ route('register') }}" target="_blank">SignUp</a> or <a href="{{ route('login') }}" target="_blank">Login</a> to be able to rate this product.
        </div>
    @endif

    <div class="review__address__inner">
        @foreach($reviews as $review)
            <!-- Start Single Review -->
            <div class="pro__review mb--50">
                <div class="review__thumb">
                    <img src="{{ url('frontend/images/review/1.jpg') }}" alt="review images">
                </div>
                <div class="review__details">
                    <div class="review__info">
                        <h4><a href="#">{{ App\User::getUserName($review->user) }}</a></h4>
                        <ul class="rating">

                            @php $user_rate = $review->rate @endphp

                            @foreach (range(1,5) as $i)

                                @if($user_rate > 0) 
                                   <li><span class="zmdi zmdi-star"></span></li>
                                @else
                                    <li><span class="zmdi zmdi-star-outline"></span></li>
                                @endif
                                
                                @php $user_rate-- @endphp
                            @endforeach
                        
                        </ul>
                    </div>
                    <div class="review__date mb--5">
                        <span>{{ $review->created_at->format('d M Y g:i a') }}</span>
                    </div>
                    <p>{{ $review->review }}</p>
                </div>

                @if(Auth::check() && Auth::user()->id == $review->user)
                <div class="review__control dropdown">
                    <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="" class="review_info">Edit</a></li>
                        <li><a href="{{ route('review_delete', ['id' => $productId, 'review' => $review->id]) }}" class="review_info">Delete</a></li>
                    </ul>
                </div>
                @endif

            </div>
            <!-- End Single Review -->
        @endforeach
        
    </div>

</div>
