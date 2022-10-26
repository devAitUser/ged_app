<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;  
use Illuminate\Support\Facades\Auth;

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
        Gate::define('permission_user', function ()
        {
            $value = false;
             if (Auth::user()->hasPermissionTo('gestion des utilisateurs'))
            {
              $value = true;
            }
            return $value;
        });
        Gate::define('permission_plan_classements', function ()
        {
            $value = false;
             if (Auth::user()->hasPermissionTo('Modifier le plan de classement'))
            {
              $value = true;
            }
            return $value;
        });
        ;
        Gate::define('Voir_plan_classement', function ()
        {
            $value = false;
             if (Auth::user()->hasPermissionTo('Voir le plan de classement'))
            {
              $value = true;
            }
            return $value;
        });
        Gate::define('permission_creer_dossier', function ()
        {
            $value = false;
             if (Auth::user()->hasPermissionTo('Créer les dossiers'))
            {
              $value = true;
            }
            return $value;
        });

        Gate::define('permission_Modifier_dossiers', function ()
        {
            $value = false;
             if (Auth::user()->hasPermissionTo('Modifier le plan de classement'))
            {
              $value = true;
            }
            return $value;
        });
        Gate::define('permission_Modifier_roles', function ()
        {
            $value = false;
             if (Auth::user()->hasPermissionTo('Modifier les roles'))
            {
              $value = true;
            }
            return $value;
        });
    }

    
}
