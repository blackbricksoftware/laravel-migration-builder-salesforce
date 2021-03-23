<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm
 */
class Urls extends SObjectBase
{

  /**
   * Set a property of this object, checking existence and type
   * Overrode to dynamically add properties since there is not a fixed list
   * 
   * @throws RuntimeException
   */
  public function setGenericProperty($property, $value): SObjectBase
  {

    $this->$property = $value;

    return $this;
  }
}
