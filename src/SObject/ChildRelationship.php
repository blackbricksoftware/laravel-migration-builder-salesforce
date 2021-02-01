<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#childrelationship_topic
 */
class ChildRelationship extends SObjectBase
{

  protected bool $cascadeDelete;

  protected string $childSObject;

  protected bool $deprecatedAndHidden;

  protected string $field;

  protected Strings $junctionIdListNames;

  protected Strings $junctionReferenceTo;

  protected ?string $relationshipName;

  protected bool $restrictedDelete;

  public function setJunctionIdListNames(array $junctionIdListNames): ChildRelationship
  {

    $this->junctionIdListNames = new Strings($junctionIdListNames);

    return $this;
  }

  public function setJunctionReferenceTo(array $junctionReferenceTo): ChildRelationship
  {

    $this->junctionReferenceTo = new Strings($junctionReferenceTo);

    return $this;
  }
}
