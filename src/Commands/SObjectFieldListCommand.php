<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\Commands;

use BlackBrickSoftware\MigrationBuilderSalesforce\SObject;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObjectList;
use Illuminate\Console\Command;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

class SObjectFieldListCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:migration-builder:salesforce:object:fields
    {--objects=* : Names of Salesforce object}
    {--all}
    {--output=table : Format of the output: table (default), csf}
  ';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'List details Salesforce object fields';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }
  
  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {

    $objectNames = $this->option('objects');
    $all = $this->option('all');
    if (count($objectNames) === 0 && !$all) {
      $this->error("The --all flag or --objects argument is required.");
      return Command::INVALID;
    }

    $this->line('Authenticating with Salesforce....');
    Forrest::authenticate();
    $this->info('Authenticated!');

    if ($all) {
      $objectsDescription = Forrest::sobjects();
      $objectList = new SObjectList($objectsDescription); // do we need to worry about nextRecordsUrl?
      $objectNames = collect($objectList->sobjects)->map(fn($o) => $o->name);
    }

    $objectDescriptions = collect();
    foreach ($objectNames as $objectName) {
      $objectDescription = Forrest::sobjects("$objectName/describe");
      $objectDescriptions[] = new SObject($objectDescription);
    }

    $length = count($objectDescriptions);
    $this->line("Found {$length} objects");

    if ($length === 0) {
      $this->line('No Objects found');
    }

    $headers = [
      'Object Label',
      'Object Name',
      'Custom Object',
      'Field Label',
      'Field Name',
      'Custom Field',
      'Field Type',
      'Field Relationship'
    ];

    $rows = [];

    foreach ($objectDescriptions as $sobject) {
      foreach ($sobject->fields as $field) {
        $rows[] = [
          'object_label' => $sobject->label,
          'object_name' => $sobject->name,
          'object_custom' => $sobject->custom ? 'Yes' : 'No',
          'field_label' => $field->label,
          'field_name' => $field->name,
          'field_custom' => $field->custom ? 'Yes' : 'No',
          'field_type' => $field->type,
          'field_relationship' => $field->referenceTo[0] ?? '',
        ];
      }
    }

    $output = $this->option('output');
    if ($output === 'table') {
      $this->table($headers, $rows);
    } else if ($output === 'csv') {
      $fh = fopen('php://output', 'w');
      if (!$fh) {
        $this->error('Could not open output');
        return Command::FAILURE;
      }
      fputcsv($fh, $headers);
      foreach ($rows as $row) {
        fputcsv($fh, $row);
      }
      fclose($fh);
    } else {
      $this->error("Unknown output type: $output");
      return Command::FAILURE;
    }   

    return Command::SUCCESS;
  }
}
