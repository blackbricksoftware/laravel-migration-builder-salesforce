<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#recordtypeinfo_topic
 */
class RecordTypeInfo extends SObjectBase
{

  protected bool $active;

  protected bool $available;

  protected bool $defaultRecordTypeMapping;

  protected string $developerName;

  protected bool $master;

  protected string $name;

  protected string $recordTypeId;

  protected Urls $urls;

  public function setUrls(array $urls): RecordTypeInfo
  {

    $this->urls = new Urls($urls);

    return $this;
  }
}
