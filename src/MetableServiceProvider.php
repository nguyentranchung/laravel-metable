<?php

namespace NguyenTranChung\Metable;

use Illuminate\Support\ServiceProvider;

class MetableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_meta_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_meta_table.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../config/metable.php' => config_path('metable.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/metable.php', 'metable');
    }
}
