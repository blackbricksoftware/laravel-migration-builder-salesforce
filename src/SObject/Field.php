<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

use InvalidArgumentException;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#field_topic
 */
class Field extends SObjectBase
{

  protected bool $aggregatable;

  protected bool $aiPredictionField; // not seen in docs

  protected bool $autoNumber; // not seen in docs

  protected int $byteLength;

  protected bool $calculated;

  protected ?string $calculatedFormula; // not seen in docs

  protected bool $cascadeDelete; // not seen in docs

  protected bool $caseSensitive;

  protected ?string $compoundFieldName; // not seen in docs

  protected ?string $controllerName;

  protected bool $createable;

  protected bool $custom;

  protected bool $dataTranslationEnabled; // not seen in return

  protected $defaultValue; // not seen in docs; TODO: update to multiple types in php8.0, string and bool seen so far

  protected ?string $defaultValueFormula;

  protected bool $defaultedOnCreate;

  protected bool $dependentPicklist;

  protected bool $deprecatedAndHidden;

  protected int $digits;

  protected bool $displayLocationInDecimal;

  protected bool $encrypted;

  protected bool $externalId; // not seen in docs

  protected ?string $extraTypeInfo; // likely has list of allowed values

  // Seems a bit arbitrary to deal with
  // public const EXTRA_TYPE_INFOS = [
  //   'plaintextarea',
  //   'richtextarea',
  //   'imageurl',
  //   'null',
  //   'externallookup',
  //   'indirectlookup',
  //   'switchablepersonname',
  //   'personname',
  // ];

  protected bool $filterable;

  protected FilteredLookupInfo $filteredLookupInfo;

  protected ?string $formula; // not seen in return

  protected bool $formulaTreatNullNumberAsZero; // not seen in docs

  protected bool $groupable;

  protected bool $highScaleNumber;

  protected bool $htmlFormatted;

  protected bool $idLookup;

  protected ?string $inlineHelpText;

  protected string $label;

  protected int $length;

  protected ?string $mask;

  protected ?string $maskType;

  protected string $name;

  protected bool $nameField;

  protected bool $namePointing;

  protected bool $nillable;

  protected bool $permissionable;

  protected PicklistEntries $picklistValues;

  protected bool $polymorphicForeignKey;

  protected int $precision;

  protected bool $queryByDistance; // not seen in docs

  protected ?string $referenceTargetField;

  protected Strings $referenceTo;

  protected ?string $relationshipName;

  protected ?int $relationshipOrder; // technically on null, 0, and 1 are valid

  protected bool $restrictedDelete;

  protected bool $restrictedPicklist;

  protected int $scale;

  protected bool $searchPrefilterable;

  protected string $soapType;

  public const SOAP_TYPES = [
    'tns:ID', // Unique ID associated with an sObject. For information on IDs, see ID Field Type.
    'xsd:anyType', // Can be ID, Boolean, double, integer, string, date, or dateTime.
    'xsd:base64Binary', // Base 64-encoded binary data.
    'xsd:boolean', // Boolean (true / false) values.
    'xsd:date', // Date values.
    'xsd:dateTime', // Date/time values.
    'xsd:double', // Double values.
    'xsd:int', // Integer values.
    'xsd:string', // Character strings.
    'urn:address', // not seen in docs, https://developer.salesforce.com/docs/atlas.en-us.api.meta/api/compound_fields_address.htm
    'urn:location', , // not seen in docs
  ];

  protected bool $sortable;

  protected string $type;
  
  public const TYPES = [
    'string', // String values.
    'boolean', // Boolean (true / false) values.
    'int', // Integer values.
    'double', // Double values.
    'date', // Date values.
    'datetime', // Date and time values.
    'base64', // Base64-encoded arbitrary binary data (of type base64Binary). Used for Attachment, Document, and Scontrol objects.
    'id', // Primary key field for the object. For information on IDs, see ID Field Type.
    'reference', // Cross-references to a different object. Analogous to a foreign key field in SQL.
    'currency', // Currency values.
    'textarea', // String that is displayed as a multiline text field.
    'percent', // Percentage values.
    'phone', // Phone numbers. Values can include alphabetic characters. Client applications are responsible for phone number formatting.
    'url', // URL values. Client applications should commonly display these as hyperlinks. If Field.extraTypeInfo is imageurl, the URL references an image, and can be displayed as an image instead.
    'email', // Email addresses.
    'combobox', // Comboboxes, which provide a set of enumerated values and allow the user to specify a value not in the list.
    'picklist', // Single-select picklists, which provide a set of enumerated values from which only one value can be selected.
    'multipicklist', // Multi-select picklists, which provide a set of enumerated values from which multiple values can be selected.
    'anytype', // Values can be any of these types: string, picklist, boolean, int, double, percent, ID, date, dateTime, url, or email.
    'location', // Geolocation values, including latitude and longitude, for custom geolocation fields on custom objects
    'address', // not seen in docs, https://developer.salesforce.com/docs/atlas.en-us.api.meta/api/compound_fields_address.htm
  ];

  protected bool $unique;

  protected bool $updateable;

  protected bool $writeRequiresMasterRead;

  // public function setExtraTypeInfo(?string $extraTypeInfo): Field
  // {

  //   if ($extraTypeInfo !== null) {

  //     if (!in_array($extraTypeInfo, static::EXTRA_TYPE_INFOS))
  //       throw new InvalidArgumentException("Extra type info {$extraTypeInfo} is not allowed");
  //   }

  //   $this->extraTypeInfo = $extraTypeInfo;

  //   return $this;
  // }

  public function setFilteredLookupInfo(?array $filteredLookupInfo): Field
  {

    if ($filteredLookupInfo !== null)
      $this->filteredLookupInfo = new FilteredLookupInfo($filteredLookupInfo);

    return $this;
  }

  public function setPicklistValues(array $picklistValues): Field
  {

    $this->picklistValues = new PicklistEntries($picklistValues);

    return $this;
  }

  public function setReferenceTo(array $referenceTo): Field
  {

    $this->referenceTo = new Strings($referenceTo);

    return $this;
  }

  public function setSoapType(string $soapType): Field
  {

    if (!in_array($soapType, static::SOAP_TYPES))
      throw new InvalidArgumentException("SOAP Type {$soapType} is not allowed");

    $this->soapType = $soapType;

    return $this;
  }

  public function setType(string $type): Field
  {

    // these come in all sorts of capitalization
    $type = strtolower($type);

    if (!in_array($type, static::TYPES))
      throw new InvalidArgumentException("Type {$type} is not allowed");

    $this->type = $type;

    return $this;
  }
}
