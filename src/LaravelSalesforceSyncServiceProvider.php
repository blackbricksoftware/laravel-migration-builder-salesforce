<?php

namespace BlackBrickSoftware\LaravelSalesforceSync;

use Illuminate\Support\ServiceProvider;

class LaravelSalesforceSyncServiceProvider extends ServiceProvider
{
  
  /**
   * Publishes configuration file.
   *
   * @return  void
   */
  public function boot()
  {
    $this->publishes([
      __DIR__ . '/../config/salesforce_sync.php' => config_path('salesforce_sync.php'),
    ], 'laravel-salesforce-sync-config');
  }

  /**
   * Make config publishment optional by merging the config from the package.
   *
   * @return  void
   */
  public function register()
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
