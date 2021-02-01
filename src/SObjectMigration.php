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

  const SF_TYPE_TO_DB_TYPE = [
    'string', // String values.
    'boolean', // Boolean (true / false) values.
    'int', // Integer values.
    'double', // Double values.
    'date', // Date values.
    'datetime', // Date and time values.
    'base64', // Base64-encoded arbitrary binary data (of type base64Binary). Used for Attachment, Document, and Scontrol objects.
    'id', // Primary key field for the object. For information on IDs, see ID Field Type.
    'reference', // Cross-references to a different object. Analogous to a foreign key field in SQL.
    'currency', // Currency values.
    'textarea', // String that is displayed as a multiline text field.
    'percent', // Percentage values.
    'phone', // Phone numbers. Values can include alphabetic characters. Client applications are responsible for phone number formatting.
    'url', // URL values. Client applications should commonly display these as hyperlinks. If Field.extraTypeInfo is imageurl, the URL references an image, and can be displayed as an image instead.
    'email', // Email addresses.
    'combobox', // Comboboxes, which provide a set of enumerated values and allow the user to specify a value not in the list.
    'picklist', // Single-select picklists, which provide a set of enumerated values from which only one value can be selected.
    'multipicklist', // Multi-select picklists, which provide a set of enumerated values from which multiple values can be selected.
    'anytype', // Values can be any of these types: string, picklist, boolean, int, double, percent, ID, date, dateTime, url, or email.
    'location', // Geolocation values, including latitude and longitude, for custom geolocation fields on custom objects
    'address', // not seen in docs, https://developer.salesforce.com/docs/atlas.en-us.api.meta/api/compound_fields_address.htm
  ];

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
    return new Column($field->name, 'string', [
      'length' => $field->length ?: 255,
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
}
