<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;

class Fields extends ArrayObject
{
  public function offsetSet($key, $val): void
  {
    if ($val instanceof Field) {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a Field type');
  }
}
