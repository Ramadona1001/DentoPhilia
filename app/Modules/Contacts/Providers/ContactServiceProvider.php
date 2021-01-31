<?php

namespace Contacts\Providers;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
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
        $ds = DIRECTORY_SEPARATOR;
        $module = 'Contacts';
        $this->loadRoutesFrom(__DIR__.$ds.'..'.$ds.'Routes'.$ds.'web.php');
        $this->loadMigrationsFrom(__DIR__.$ds.'..'.$ds.'Database'.$ds.'migrations');
        $this->loadFactoriesFrom(__DIR__.$ds.'..'.$ds.'Database'.$ds.'factories');
        $this->loadViewsFrom(__DIR__.$ds.'..'.$ds.'Resources'.$ds.'views',$module);
        $this->loadTranslationsFrom(__DIR__.$ds.'..'.$ds.'Resources'.$ds.'lang',$module);
    }
}
