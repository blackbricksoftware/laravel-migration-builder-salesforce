<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;

class Strings extends ArrayObject
{
  public function offsetSet($key, $val): void
  {
    if (gettype($val)==='string') {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a string type');
  }
}
