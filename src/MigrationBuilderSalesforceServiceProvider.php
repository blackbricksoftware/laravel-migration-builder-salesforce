<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce;

use Illuminate\Support\ServiceProvider;

class MigrationBuilderSalesforceServiceProvider extends ServiceProvider
{
  
  /**
   * Publishes configuration file.
   */
  public function boot(): void
  {
    $this->publishes([
      __DIR__ . '/../config/salesforce_sync.php' => config_path('salesforce_sync.php'),
    ], 'laravel-salesforce-sync-config');
  }

  /**
   * Make config publishment optional by merging the config from the package.
   */
  public function register(): void
  {
    // config
    $this->mergeConfigFrom(
      __DIR__ . '/../config/salesforce_sync.php',
      'salesforce_sync'
    );
    // commands
    $this->commands([
      Commands\SObjectMigrationCommand::class,
      Commands\SObjectDebugCommand::class,
    ]);
  }
}
