<?php

namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Modules\Blog\Events\PostViewed::class => [
            \Modules\Blog\Listeners\StoreViewData::class,
        ],
    ];
}
