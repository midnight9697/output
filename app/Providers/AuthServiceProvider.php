<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\PurchaseRequest;
use App\Models\User;
use App\Policies\PRPolicy;
use App\Policies\PurchaseRequestPolicy;
use App\Policies\SupplementalPolicy;
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
        Gate::define('pr-file-view', [PRPolicy::class, 'fileViewer']);
        Gate::define('pr-process-view', [PRPolicy::class, 'processView']);

        // User Management Permissions
        // Gate::define('user-view', [UserPolicy::class, 'viewAny']);
        Gate::define('user-view-page', [UserPolicy::class, 'view']);
        Gate::define('user-update-view', [UserPolicy::class, 'update']);

        // Supplemental
        Gate::define('spl-download-file', [SupplementalPolicy::class, 'supplementalDownload']);
        Gate::define('spl-view-file', [SupplementalPolicy::class, 'supplementalCreatorView']);

    }
}
