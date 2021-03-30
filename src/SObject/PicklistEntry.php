<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#picklistentry_topic
 */
class PicklistEntry extends SObjectBase
{

  protected bool $active;

  protected bool $defaultValue;

  protected ?string $label;

  protected ?string $validFor; // TODO: I think this is a base64 encoded string. Do not have an example currently. https://salesforce.stackexchange.com/questions/201775/picklists-validfor-attribute

  protected string $value;

}
