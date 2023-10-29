<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Schema::hasTable('pages')) {
            $pages = Page::all();

            if ($pages->count()) {
                $navitems = collect();

                foreach ($pages as $page) {
                    $navitems->push($page);
                }

                View::share('navitems', $navitems);
            }
        }
    }
}
