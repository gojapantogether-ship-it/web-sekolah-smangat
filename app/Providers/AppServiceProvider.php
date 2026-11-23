<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-initialize SQLite database file if missing
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && $dbPath !== ':memory:' && !file_exists($dbPath)) {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }
                @touch($dbPath);
            }
        }

        // Auto-migrate & seed if tables do not exist yet
        try {
            if (!Schema::hasTable('school_profiles')) {
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }
        } catch (\Throwable $e) {
            logger()->error('Auto-migration failed: ' . $e->getMessage());
        }

        // Ensure storage symlink exists
        if (!file_exists(public_path('storage'))) {
            try {
                Artisan::call('storage:link');
            } catch (\Throwable $e) {
                // Ignore symlink errors
            }
        }
    }
}
