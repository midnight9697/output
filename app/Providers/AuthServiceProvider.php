<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\PurchaseRequest;
use App\Models\User;
use App\Policies\PRPolicy;
use App\Policies\PurchaseRequestPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void0
     * 
     */
    public function boot() {
        $this->registerPolicies();

        // Purchase Request Permission
        Gate::define('pr-user-view', [PRPolicy::class, 'userView']);
        Gate::define('pr-update-view', [PRPolicy::class, 'updateView']);
        Gate::define('pr-delete', [PRPolicy::class, 'delete_pr']);
    }
}
