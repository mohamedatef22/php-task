<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-employee', function (User $user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('add-customer', function (User $user) {
            return ($user->role === User::ADMIN_ROLE || $user->role === User::EMPLOYEE_ROLE);
        });

        Gate::define('get-customers', function (User $user) {
            return ($user->role === User::ADMIN_ROLE || $user->role === User::EMPLOYEE_ROLE);
        });

        Gate::define('show-customer', function (User $user, User $customer) {
            return $user->role === User::ADMIN_ROLE || $customer->employee_id === $user->id;
        });

        Gate::define('update-customer', function (User $user, User $customer) {
            return $customer->employee_id === $user->id || $user->role === User::ADMIN_ROLE;
        });
        
        Gate::define('can-assign', function (User $user) {
            return $user->role === User::ADMIN_ROLE;
        });
        
        Gate::define('can-add-action', function (User $user, User $customer) {
            return $customer->employee_id === $user->id;
        });
    }
}
