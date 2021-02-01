<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce;

use BlackBrickSoftware\MigrationBuilderSalesforce\SObjects;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\SObjectBase;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm
 */
class SObjectList extends SObjectBase
{

  protected string $encoding;

  protected int $maxBatchSize;

  protected SObjects $sobjects;

  public function setSobjects(array $sobjects): SObjectList
  {

    $this->sobjects = new SObjects($sobjects);

    return $this;
  }
}
