<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\Schema;

use Auth;

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
     /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot(Request $request)
     {
        Schema::defaultStringLength(191);
        if (! $this->app->runningInConsole()) {
            Blade::if('isadmin', function () {
               
                return (Auth::check() && (Auth::user()->is_admin == 1));
            });

            Blade::if('userssorted', function () {
               
                $config = Config::firstOrNew();
                return ($config->userssortedflag != "no");
            });

            Collection::macro('byDivision', function ($div) {
                return $this->filter(function ($value) use ($div) {
                    return $value->division == $div;
                });
            });


            Collection::macro('byConference', function ($div) {
                return $this->filter(function ($value) use ($div) {
                    return $value->conference == $div;
                });
            });

            Collection::macro('divByConference', function ($div) {
                return $this->filter(function ($value) use ($div) {
                    return $value->conference == $div;
                });
            });



            Blade::if('inSeason', function () {
               
                $config = Config::firstOrNew();
                return ($config->seasonlock == "no");
            });

            Blade::directive('title', function () {
                $config = Config::firstOrNew();
                
                //dd($config->welcome);

                return $config->title;
            });    


            //we need to do something special for this
            $config = Config::firstOrNew();

            config(['app.config.cq1' => $config->cq1]);
            config(['app.config.cq2' => $config->cq2]);
            config(['app.config.welcome' => $config->welcome]);
            config(['app.config.title' => $config->title]);


            $path_array = $request->segments();
            $admin_route = config('app.admin_route');

            //If URL path is having "admin" then mark the current scope as Admin
            if (in_array($admin_route, $path_array)) {
             config(['app.app_scope' => 'admin']);
            }



            $app_scope = config('app.app_scope');

            //if App scope is admin then define View/Theme folder path
            if ($app_scope == 'admin') {
             $path = resource_path('admin/views');
            } else {
             $path = resource_path('front/views');
            }

            view()->addLocation($path);
        }
     }
}
