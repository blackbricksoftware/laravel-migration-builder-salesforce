<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;

class NamedLayoutInfos extends ArrayObject
{
  public function offsetSet($key, $val): void
  {
    if ($val instanceof NamedLayoutInfo) {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a NamedLayoutInfo type');
  }
}
