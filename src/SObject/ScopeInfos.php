<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;

class ScopeInfos extends ArrayObject
{
  public function offsetSet($key, $val): void
  {
    if ($val instanceof ScopeInfo) {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a ScopeInfo type');
  }
}
