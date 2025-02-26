<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            database_path('migrations'), // Carpeta principal
            database_path('migrations/AreaDeLaMujerMigrations'),
            database_path('migrations/CiamMigrations'),
            database_path('migrations/OmapedMigrations'),
            database_path('migrations/SisfohMigrations'),
            database_path('migrations/VasoDeLecheMigrations'),
        ]);
    }
}
