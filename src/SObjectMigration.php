<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync;

use BlackBrickSoftware\LaravelMigrationBuilder\Migration;

class ObjectMigration extends Base
{

  /**
   * An object representing the Salesforce Object descroption
   * 
   * @var SObject
   */
  protected SObject $sobject;

  /**
   * The Migraiton instance
   * 
   * @var Migration
   */
  protected Migration $migration;

  /**
   * Object Migraiton constructor
   * 
   * @param Migration $migration
   */
  public function __construct(SObject $sobject, Migration $migration)
  {
    $this->sobject = $sobject;
    $this->migration = $migration;
  }

  public function writeMigration($create) {

  }
}
