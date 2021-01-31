<?php

namespace BlackBrickSoftware\LaravelSalesforceSync;

use BlackBrickSoftware\LaravelMigrationBuilder\Migration;

class ObjectMigration
{

  /**
   * The Migraiton instance
   * 
   * @var Migration
   */
  protected Migration $composer;

  /**
   * Object Migraiton constructor
   * 
   * @param Migration $migration
   */
  public function __construct(Migration $migration)
  {
    $this->migration = $migration;
  }
}
