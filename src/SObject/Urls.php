<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm
 */
class Urls extends SObjectBase
{

  protected string $compactLayouts;

  protected string $rowTemplate;

  protected string $approvalLayouts;

  protected string $uiDetailTemplate;

  protected string $uiEditTemplate;

  protected string $defaultValues;

  protected string $layout;

  protected string $listviews;

  protected string $describe;

  protected string $uiNewRecord;

  protected string $quickActions;

  protected string $layouts;

  protected string $sobject;

}
