<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Banner;
use App\Category;
use App\Order;
use App\Product;
use App\Product_review;
use App\Products_store;
use App\Setting;
use App\Slide;
use App\State;
use App\Website_brand;
use App\Website_review;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Banner::observe(\App\Observers\BannerObserver::class);
        Category::observe(\App\Observers\CategoryObserver::class);
        Product::observe(\App\Observers\ProductObserver::class);
        Product_review::observe(\App\Observers\ProductReviewObserver::class);
        Products_store::observe(\App\Observers\ProductStoresObserver::class);
        Order::observe(\App\Observers\OrdersObserver::class);
        Setting::observe(\App\Observers\SettingObserver::class);
        Slide::observe(\App\Observers\SliderObserver::class);
        State::observe(\App\Observers\StateObserver::class);
        Website_review::observe(\App\Observers\WebsiteReviewObserver::class);
        Website_brand::observe(\App\Observers\WebsiteBrandObserver::class);
    }
}
