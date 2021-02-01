<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#namedLayoutInfo_topic-title
 */
class NamedLayoutInfo extends SObjectBase
{

  protected string $name;

}
