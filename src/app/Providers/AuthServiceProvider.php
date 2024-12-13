<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\RolePolicy;
use App\Models\Shop;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Shop::class => RolePolicy::class,
        User::class => RolePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', [RolePolicy::class, 'isAdmin']);
        Gate::define('shop_manager', [RolePolicy::class, 'isShopManager']);
        Gate::define('has-role', function ($user, $role) {
            $policy = new RolePolicy();
            return $policy->hasRole($user, $role);
        });
        // 店舗編集の認可
        Gate::define('update-shop', [RolePolicy::class, 'update']);
    }
}
