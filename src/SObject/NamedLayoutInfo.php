<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#namedlayoutinfo_topic
 */
class NamedLayoutInfo extends SObjectBase
{

  protected string $name;

  protected ?Urls $urls;

  public function setUrls(array $urls) {

    $this->urls = new Urls($urls);

    return $this;
  }

}
