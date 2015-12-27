<?php

namespace Seat\Notes;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Seat\Notes\Http\Middleware\NotesBouncer;

/**
 * Class NotesServiceProvider
 * @package Seat\Notes
 */
class NotesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $this->add_routes();
        $this->add_middleware($router);
        $this->add_views();
        $this->add_publications();
        $this->add_translations();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge the config with anything in the main app
        $this->mergeConfigFrom(
            __DIR__ . '/Config/notes.config.php', 'notes.config'); //TODO: Notes Config

        $this->mergeConfigFrom(
            __DIR__ . '/Config/notes.permissions.php', 'web.permissions');
    }

    public function add_translations()
    {

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'notes');
    }

    /**
     * Include the routes
     */
    public function add_routes()
    {
        if (!$this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }
    /**
     * Include the middleware needed
     *
     * @param $router
     */
    public function add_middleware($router)
    {
        // Include a custom Bouncer
        $router->middleware('notesbouncer', NotesBouncer::class); //TODO: Write Notes Bouncer
    }
    /**
     * Set the path and namespace for the views
     */
    public function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'notes');
    }
    /**
     * Set the paths for migrations and assets that
     * should be published to the main application
     */
    public function add_publications()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations'),
        ]);
    }
}
