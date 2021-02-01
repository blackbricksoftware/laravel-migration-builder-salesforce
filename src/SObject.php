<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce;

use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\ActionOverrides;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\ChildRelationships;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\Fields;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\NamedLayoutInfos;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\RecordTypeInfos;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\ScopeInfos;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\SObjectBase;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\Urls;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm
 */
class SObject extends SObjectBase
{

  protected bool $activateable;

  protected ActionOverrides $actionOverrides;

  protected ?string $associateEntityType;

  protected ?string $associateParentEntity;

  protected ChildRelationships $childRelationships;

  protected bool $compactLayoutable;
  
  protected bool $createable;

  protected bool $custom;

  protected bool $customSetting;
  
  protected bool $dataTranslationEnabled;

  protected bool $deepCloneable;

  protected ?string $defaultImplementation;

  protected bool $deletable;

  protected bool $deprecatedAndHidden;

  protected ?string $extendedBy;

  protected ?string $extendsInterfaces;

  protected bool $feedEnabled;

  protected Fields $fields;

  protected bool $hasSubtypes;

  protected ?string $implementedBy;

  protected ?string $implementsInterfaces;

  protected bool $isInterface;

  protected bool $isSubtype;

  protected ?string $keyPrefix;

  protected string $label;

  protected string $labelPlural;

  protected bool $layoutable;

  protected ?bool $listviewable; // not seen in docs

  protected ?bool $lookupLayoutable; // not seen in docs

  protected bool $mergeable;

  protected bool $mruEnabled;

  protected string $name;

  protected NamedLayoutInfos $namedLayoutInfos;

  protected ?string $networkScopeFieldName;

  protected bool $queryable;

  protected RecordTypeInfos $recordTypeInfos;

  protected bool $replicateable;

  protected bool $retrieveable;

  protected bool $searchLayoutable;

  protected bool $searchable;
  
  protected string $sobjectDescribeOption; // not seen in docs; only value I have seen is "FULL"

  protected ScopeInfos $supportedScopes;

  protected bool $triggerable;

  protected bool $undeletable;

  protected bool $updateable;

  protected ?string $urlDetail; // not seen in return

  protected ?string $urlEdit; // not seen in return

  protected ?string $urlNew; // not seen in return

  protected Urls $urls;
  
  public function setActionOverrides(array $actionOverrides): SObject
  {

    $this->actionOverrides = new ActionOverrides($actionOverrides);

    return $this;
  }

  public function setChildRelationships(array $childRelationships): SObject
  {
    
    $this->childRelationships = new ChildRelationships($childRelationships);

    return $this;
  }

  public function setFields(array $fields) {

    $this->fields = new Fields($fields);

    return $this;
  }

  public function setNamedLayoutInfos(array $namedLayoutInfos) {

    $this->namedLayoutInfos = new NamedLayoutInfos($namedLayoutInfos);

    return $this;
  }

  public function setRecordTypeInfos(array $recordTypeInfos) {

    $this->recordTypeInfos = new RecordTypeInfos($recordTypeInfos);

    return $this;
  }

  public function setSupportedScopes(array $supportedScopes) {

    $this->supportedScopes = new ScopeInfos($supportedScopes);

    return $this;
  }

  public function setUrls(array $urls) {

    $this->urls = new Urls($urls);

    return $this;
  }
}
