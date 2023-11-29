<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\DistrictPolicy;
use App\Policies\ProcurementPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        App\Models\User::class => UserPolicy::class,
        App\Models\District::class => DistrictPolicy::class,
        App\Models\Procurement::class => ProcurementPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
