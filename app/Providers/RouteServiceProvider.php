<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        /*$sld_prefix = explode('.',$_SERVER['HTTP_HOST'])[0];
        if(config('domain.admin_url') == $sld_prefix){
            $this->mapAdminRoutes();
        }elseif(config('domain.home_url') == $sld_prefix){
            $this->mapHomeRoutes();
        }elseif(config('domain.api_url') == $sld_prefix){
            $this->mapApiRoutes();
        }*/
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }

    /**
     * Home
     */
    protected function mapHomeRoutes()
    {
        Route::domain(config('domain.home_url'))
            ->middleware('web')
            ->namespace('App\Home\Http\Controllers')
            ->group(base_path('App/Home/Routes/web.php'));
    }

    /**
     * Admin
     */
    protected function mapAdminRoutes()
    {
        Route::domain(config('domain.admin_url'))
            ->middleware('web')
            ->namespace('App\Admin\Http\Controllers')
            ->group(base_path('App/Admin/Routes/web.php'));
    }

    /**
     * Api
     */
    protected function mapApiRoutes()
    {
        Route::domain(config('domain.api_url'))
            ->middleware('web')
            ->namespace('App\Api\Http\Controllers')
            ->group(base_path('App/Api/Routes/web.php'));
    }
}
