<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\SObject;

use BlackBrickSoftware\LaravelSalesforceSync\Base;
use Illuminate\Support\Str;
// use ReflectionClass;
// use ReflectionProperty;
// use ReflectionNamedType;
use RuntimeException;

class SObjectBase extends Base
{

  /**
   * A reflection of current object
   * to check type vs type hits as they are set
   * possibly also test for uninitialized properties
   */
  // protected ReflectionClass $reflection;

  protected ?string $rawApiResponse;

  /**
   * SObjectBase Constructor
   * Binds a return fromt the Salesforce API to this object on the appropriate properties
   */
  public function __construct(?array $rawApiResponse = null)
  {

    // $this->reflection = new ReflectionClass($this);

    if ($rawApiResponse !== null)
      $this->bind($rawApiResponse);
  }

  /**
   * Bind the api respose array into the object
   */
  public function bind(array $rawApiResponse): SObjectBase
  {

    if (count($rawApiResponse) === 0)
      return $this;

    foreach ($rawApiResponse as $property => $value) {

      $setter = $this->findSetter($property);
      if ($setter !== null) {
        $this->$setter($value);
      } else {
        $this->setGenericProperty($property, $value);
      }
    }

    return $this;
  }

  /**
   * Return a method to set a property to this object
   */
  public function findSetter(string $property): ?string
  {

    $setterMethod = 'set' . Str::studly($property);

    if (method_exists($this, $setterMethod))
      return $setterMethod;

    return null;
  }

  /**
   * Set a property of this object, checking existanse and type
   * 
   * @throws RuntimeException
   */
  public function setGenericProperty($property, $value): SObjectBase
  {

    if (!property_exists($this, $property))
      throw new RuntimeException("Property {$property} does not exist");

    // $property = $this->reflection->getProperty($property);
    // $type = $property->getType();
    // if ($type===null)
    //   return $this;

    $this->$property = $value;

    return $this;
  }
}
