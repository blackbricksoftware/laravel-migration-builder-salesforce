<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

use InvalidArgumentException;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#actionOverrideTopic
 */
class ActionOverride extends SObjectBase
{

  protected ?string $formFactor;

  public const FORM_FACTORS = [
    'SMALL',
    'LARGE',
  ];

  protected bool $isAvailableInTouch;

  protected string $name;

  protected string $pageId;

  protected ?string $url;

  public function setFormFactor(?string $formFactor): ActionOverride
  {

    if ($formFactor!==null && !in_array($formFactor, static::FORM_FACTORS))
      throw new InvalidArgumentException("Form factor {$formFactor} is not allowed");

    $this->formFactor = $formFactor;

    return $this;
  }
}
