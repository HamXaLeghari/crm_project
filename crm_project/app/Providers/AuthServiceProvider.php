<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Gate;
use function Symfony\Component\String\u;

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
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("verify-role",function (User $user,$roles){

            $roles = is_array($roles) ? $roles : [$roles];
           return $user->role()->whereIn("name",$roles)->exists();
            /*return $user
                ->role()
                ->where("name","=",$role)
                ->exists();*/
        });

        Gate::define("verify-access",function (User $user, string $access_control){

            return $user
                ->userAccessControls()
                ->getRelation("access_control")
                ->where("name","=",$access_control)
                ->exists();
        });

        //
    }
}
