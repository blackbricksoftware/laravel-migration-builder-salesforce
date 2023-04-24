<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\Commands;

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

    $objects = $this->option('objects');
    $all = $this->option('all');
    dd($objects, $all);

    $this->line('Authenticating with Salesforce....');
    Forrest::authenticate();
    $this->info('Authenticated!');

    // https://developer.salesforce.com/docs/atlas.en-us.api_rest.meta/api_rest/dome_sobject_basic_info.htm
    $objectsDescription = Forrest::sobjects();
    $objectList = new SObjectList($objectsDescription); // do we need to worry about nextRecordsUrl?
    $sobjects = $objectList->sobjects;
    $length = count($sobjects);

    $this->line("Found {$length} objects");

    if ($length === 0)
      $this->line('No Objects found');

    $headers = [
      'Label',
      'Name',
      'Custom',
    ];

    $rows = [];

    foreach ($sobjects as $sobject) {
      $rows[] = [
        'label' => $sobject->label,
        'name' => $sobject->name,
        'custom' => $sobject->custom ? 'Yes' : 'No',
      ];
    }

    $this->table($headers, $rows);

    return 0;
  }
}
