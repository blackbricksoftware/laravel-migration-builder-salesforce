<?php

namespace BlackBrickSoftware\LaravelSalesforceSync;

class SObject extends Base
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
