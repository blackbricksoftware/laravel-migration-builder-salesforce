<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;

class RecordTypeInfos extends ArrayObject
{
  public function offsetSet($key, $val): void
  {
    if ($val instanceof RecordTypeInfo) {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a RecordTypeInfo type');
  }
}
