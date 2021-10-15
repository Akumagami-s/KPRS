<?php

namespace App\Providers;
use App\Observers\ItemObserver;
use App\sandboxAcc;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    // sandboxAcc::observe(ItemObserver::class);
    // HeadingRowFormatter::extend('custom', function($value, $key) {
    //     return 'column-' . $value;
    // HeadingRowFormatter::default('custom');
        // And you can use heading column index.
        // return 'column-' . $key;
    // });
    }
}
