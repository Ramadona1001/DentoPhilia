<?php

namespace App\Providers;

use Categories\Models\Category;
use Courses\Models\Course;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use MainSettings\Models\MainSetting;
use Menus\Models\Menu;
use Services\Models\Service;
use View;

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
        Schema::defaultStringLength(191);
    }
}
