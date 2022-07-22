<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Ad;
use App\Category;
use App\Product;
use App\Product_review;
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

        Category::observe(\App\Observers\CategoryObserver::class);
        Product::observe(\App\Observers\ProductObserver::class);
        Product_review::observe(\App\Observers\ProductReviewObserver::class);
        Setting::observe(\App\Observers\SettingObserver::class);
        Slide::observe(\App\Observers\SliderObserver::class);
        State::observe(\App\Observers\StateObserver::class);
        Website_review::observe(\App\Observers\WebsiteReviewObserver::class);
        Website_brand::observe(\App\Observers\WebsiteBrandObserver::class);
        Ad::observe(\App\Observers\AdObserver::class);
    }
}
