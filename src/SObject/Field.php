<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

class Field extends SObjectBase
{
  
  protected bool $aggregatable;

  protected bool $aiPredictionField;

  protected bool $autoNumber;
  
  protected int $byteLength;

  protected bool $calculated;
  
  protected ?string $calculatedFormula;

  protected bool $cascadeDelete;

  protected bool $caseSensitive;

  protected ?string $compoundFieldName;

  protected \null $controllerName; // no example, set to null type to cause find one

  protected bool $createable;

  protected bool $custom;

  protected ?bool $defaultValue; // might be mixed value

  protected ?string $defaultValueFormula;

  protected bool $defaultedOnCreate;

  protected bool $dependentPicklist;

  protected bool $deprecatedAndHidden;

  protected int $digits;

  protected bool $displayLocationInDecimal;

  protected bool $encrypted;

  protected bool $externalId;

  protected string $extraTypeInfo; // likely has list of allowed values

  protected bool $filterable;

  protected null $filteredLookupInfo; // no example, set to null type to cause find one

  protected bool $formulaTreatNullNumberAsZero;

  protected bool $groupable;

  protected bool $highScaleNumber;

  protected bool $htmlFormatted;

  protected bool $idLookup;

  protected ?string $inlineHelpText;

  protected string $label;

  protected int $length;
  
  protected null $mask; // no example, set to null type to cause find one

  protected null $maskType; // no example, set to null type to cause find one, but i think this has a small amount of allowed values
  
  protected string $name;

  protected bool $nameField;

  protected bool $namePointing;

  protected bool $nillable;

  protected bool $permissionable;

  // !!picklistValues": [],

  protected bool $polymorphicForeignKey;

  protected int $precision;
  
  protected bool $queryByDistance;
  
  protected ?string $referenceTargetField; // no example, set to null type to cause find one
  
  protected array $referenceTo; // list of objects names as strings
  
  protected ?string $relationshipName;

  protected null $relationshipOrder; // no example, set to null type to cause find one

  protected bool $restrictedDelete;
  
  protected bool $restrictedPicklist;

  protected int $scale;

  protected bool $searchPrefilterable;

  protected string $soapType;

  protected bool $sortable;
  
  protected string $type;

  protected bool $unique;

  protected bool $updateable;

  protected bool $writeRequiresMasterRead;

  public function __construct(?array $apiResponse = null)
  {
    
    if ($apiResponse!==null)
      $this->bind($apiResponse);
  }
}
