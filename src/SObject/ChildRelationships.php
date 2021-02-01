<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;

class ChildRelationships extends ArrayObject
{
  public function offsetSet($key, $val): void
  {
    if ($val instanceof ChildRelationship) {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a ChildRelationship type');
  }
}
