<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Data to be shared with all views
//        \Illuminate\Support\Facades\Schema::hasTable('temptable')

        $latest_dumps = null;
        if( Schema::hasTable('carts') ) {
            $latest_dumps = Models\Cart::query()
                ->orderBy('submitted', 'DESC')
                ->take( config('nescartdb.num_latest_dumps_to_show') )
                ->get();
        }
        View::share('latest_dumps', $latest_dumps);
    }
}
