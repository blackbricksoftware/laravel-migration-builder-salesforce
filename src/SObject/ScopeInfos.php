<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use ArrayObject;
use InvalidArgumentException;

class ScopeInfos extends ArrayObject
{
    
  public function __construct(array $input = [], int $flags = 0, string $iterator_class = "ArrayIterator")
  {
    
    if (count($input)===0)
      parent::__construct($input, $flags, $iterator_class);

    $newInput = [];
    foreach ($input as $val) {

      if ($val instanceof ScopeInfo) {
        $newInput[] = $val;
      } elseif (gettype($val) === 'array') {
        $newInput[] = new ScopeInfo($val);
      } else {
        throw new InvalidArgumentException('Must be a ScopeInfo type');
      }
    }

    parent::__construct($newInput, $flags, $iterator_class);
  }

  public function offsetSet($key, $val): void
  {
    if ($val instanceof ScopeInfo) {
      parent::offsetSet($key, $val);
      return;
    }
    throw new \InvalidArgumentException('Must be a ScopeInfo type');
  }
}
