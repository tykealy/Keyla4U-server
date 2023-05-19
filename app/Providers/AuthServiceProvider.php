<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('CanAccessDashboard', function (User $user) {
            if($user->account_role_id == 0 || $user->account_role_id == 1){
                return true;
            }
            return false;
        });

        Gate::define('admin', function (User $user) {
            if($user->account_role_id == 1){
                return true;
            }
            return false;
        });

        Gate::define('superAdmin', function (User $user) {
            if($user->account_role_id == 0){
                return true;
            }
            return false;
        });
    }
}
