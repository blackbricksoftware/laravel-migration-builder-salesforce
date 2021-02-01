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
      __DIR__ . '/../config/migration_builder_salesforce.php' => config_path('migration_builder_salesforce.php'),
    ], 'laravel-migration-builder-salesforce-config');
  }

  /**
   * Make config publishment optional by merging the config from the package.
   */
  public function register(): void
  {
    // config
    $this->mergeConfigFrom(
      __DIR__ . '/../config/migration_builder_salesforce.php',
      'migration_builder_salesforce'
    );
    // commands
    $this->commands([
      Commands\SObjectMigrationCommand::class,
      Commands\SObjectListCommand::class,
      Commands\SObjectDebugCommand::class,
    ]);
  }
}
