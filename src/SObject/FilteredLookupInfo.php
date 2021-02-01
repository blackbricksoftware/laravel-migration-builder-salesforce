<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#filteredLookupInfo_topic
 */
class FilteredLookupInfo extends SObjectBase
{

  protected Strings $controllingFields;

  protected bool $dependent;

  protected bool $optionalFilter;

  public function setControllingFields(array $controllingFields): FilteredLookupInfo
  {

    $this->controllingFields = new Strings($controllingFields);

    return $this;
  }
}
