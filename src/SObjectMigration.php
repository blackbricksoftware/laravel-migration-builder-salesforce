<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce;

use BlackBrickSoftware\MigrationBuilder\Column;
use BlackBrickSoftware\MigrationBuilder\Migration;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject\Field;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;

class SObjectMigration extends Migration
{

  public function addSObject(SObject $sobject, bool $includeForeignKeys = false): SObjectMigration
  {

    if (count($sobject->fields) === 0)
      return $this;

    foreach ($sobject->fields as $field) {

      $translateMethod = $this->findSObjectFieldToColumnTranslation($field);
      if ($translateMethod) {
        $column = $this->$translateMethod($field);
        $this->table->addColumn($column);
      }
    }

    if ($includeForeignKeys)
      throw new InvalidArgumentException("Including foreign keys is not supported yet.... :'(");

    return $this;
  }

  /**
   * Return a method coonvert a Field to a Column
   * 
   * @throws RuntimeException
   */
  public function findSObjectFieldToColumnTranslation(Field $field): string
  {

    $translateMethod = 'translate' . Str::studly($field->type);

    if (method_exists($this, $translateMethod))
      return $translateMethod;

    return '';
    // throw new RuntimeException("Unknown type {$field->type} for Field {$field->name}");
  }

  public function translateString(Field $field): Column
  {

    $length = $field->length ?: 255;

    // use a text type field if length is greather than 255
    if ($length>255)
      return $this->translateTextarea($field);

    return new Column($field->name, 'string', [
      'length' => ,
    ]);
  }

  public function translateBoolean(Field $field): Column
  {
    return new Column($field->name, 'boolean');
  }

  public function translateInt(Field $field): Column
  {
    return new Column($field->name, $field->digits < 10 ? 'integer' : 'bigInteger');
  }

  public function translateDouble(Field $field): Column
  {
    return new Column($field->name, 'double', [
      'length' => $field->precision,
      'fractional' => $field->scale,
    ]);
  }

  public function translateDate(Field $field): Column
  {
    return new Column($field->name, 'date');
  }

  public function translateDateTime(Field $field): Column
  {
    return new Column($field->name, 'datetime');
  }

  public function translateBase64(Field $field): Column
  {
    return new Column($field->name, 'longText'); // probably could be smarter here, but I do not have an example
  }

  public function translateId(Field $field): Column
  {
    return new Column($field->name, 'string', [
      'length' => 18,
      'unique' => true,
    ]);
  }

  public function translateReference(Field $field): Column
  {
    return new Column($field->name, 'string', [
      'length' => 18,
      'index' => true,
    ]);
  }

  public function translateCurrency(Field $field): Column
  {
    return $this->translateDouble($field);
  }

  public function translateTextarea(Field $field): Column
  {
    // Using mySQL numbers;
    return new Column($field->name, $field->byteLength<=65535 ? 'text': ($field->byteLength<=16777215 ? 'mediumText' : 'longText'));
  }

  public function translatePercent(Field $field): Column
  {
    return $this->translateDouble($field);
  }

  public function translatePhone(Field $field): Column
  {
    return $this->translateString($field);
  }

  public function translateEmail(Field $field): Column
  {
    return $this->translateString($field);
  }

  public function translateCombobox(Field $field): Column
  {
    return $this->translateString($field); // don't have an example, maybe needs to be longer?
  }

  public function translatePicklist(Field $field): Column
  {
    return $this->translateString($field);
  }

  public function translateMultipicklist(Field $field): Column
  {
    return $this->translatePicklist($field);
  }

  public function translateAnytype(Field $field): Column
  {
    return $this->translateTextarea($field);
  }

  public function translateLocation(Field $field): Column
  {
    // pretty much a formatted string? "API location: [latitudeValue longitudeValue]"
    return $this->translateString($field);
  }

  public function translateAddress(Field $field): Column
  {
    return $this->translateTextarea($field);
  }
}
