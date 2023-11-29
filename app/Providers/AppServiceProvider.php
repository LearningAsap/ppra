<?php

namespace App\Providers;

use App\Models\District;
use App\Policies\DistrictsPolicy;
use App\Policies\UserPolicy;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /* protected $policies = [
        User::class => UserPolicy::class,
        District::class => DistrictsPolicy::class,
    ]; */

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
        Filament::registerViteTheme('resources/css/filament.css');
    }
}
