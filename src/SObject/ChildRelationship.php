<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

/**
 * See: https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm#i1427334
 */
class ChildRelationship extends SObjectBase
{

  protected bool $cascadeDelete;

  protected string $childSObject;

  protected bool $deprecatedAndHidden;

  protected string $field;

  // no reference for the contents of this array
  protected Strings $junctionIdListNames;

  // no reference for the contents of this array
  protected Strings $junctionReferenceTo;

  protected string $relationshipName;

  protected bool $restrictedDeletel;
}
