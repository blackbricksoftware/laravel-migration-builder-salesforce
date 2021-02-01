<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use InvalidArgumentException;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#actionOverride
 */
class ActionOverride extends SObjectBase
{

  protected string $formFactor;

  const SUPPORTED_FORM_FACTORS = [
    'SMALL',
    'LARGE',
  ];

  protected bool $isAvailableInTouch;

  protected string $name;

  protected string $pageId;

  protected ?string $url;

  public function setFormFactor(string $formFactor): ActionOverride
  {
    if (!in_array($formFactor, static::SUPPORTED_FORM_FACTORS))
      throw new InvalidArgumentException('Form factor is not allowed');

    $this->formFactor = $formFactor;

    return $this;
  }
}
