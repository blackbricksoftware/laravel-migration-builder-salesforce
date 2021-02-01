<?php

// https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync;

use BlackBrickSoftware\LaravelSalesforceSync\SObjectBase;

class SObject extends SObjectBase
{

  /**
   * Raw api response
   * 
   * @var array $apiResponse
   */
  protected array $apiResponse;

  /**
   * Object Migraiton constructor
   * 
   * @param arrray $apiResponse
   */
  public function __construct(array $apiResponse)
  {
    $this->apiResponse = $apiResponse;

    
  }
}
