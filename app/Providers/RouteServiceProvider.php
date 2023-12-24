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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            //valido el archivo admin como un archivo de ruta
            //    Route::middleware('web','auth') con el 'auth' -> quito el error de un usuario no logueado, utilizar "auth"
             // si el usuario no esta logueado -> automaticamente redirijo a la pagina de registrarse/loguearse
            // si el usuario esta logueado -> continua con la pagina a mostrar
            Route::middleware('web','auth')
                // las rutas de admin, no necesitan el prefijo 'admin'
                    //ejemplo: Sin prefijo => admin/categorias
                    //ejemplo: Con prefijo=> /categorias
                ->prefix('admin')
                //->name('nombreDeRedireccionDeRuta.') para las redirect()
                    ->name('admin.')

                ->group(base_path('routes/admin.php'));
        });
    }
}
