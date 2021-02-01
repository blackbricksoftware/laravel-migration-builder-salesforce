<?php

declare(strict_types=1);

namespace BlackBrickSoftware\LaravelSalesforceSync\Commands;

use Forrest;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Storage;

class SObjectDebugCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:migration-builder:salesforce:object:debug
    {objectName : Name of Salesforce object}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Write a var_dump, print_r, and json_encode to storage: objectName.var_dump.txt, objectName.print_r.txt, objectName.json';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(Composer $composer)
  {
    parent::__construct();

    $this->composer = $composer;
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {

    $this->line('Authenticating with Salesforce....');
    Forrest::authenticate();
    $this->info('Authenticated!');

    $objectName = $this->argument('objectName');
    
    // https://developer.salesforce.com/docs/atlas.en-us.api_rest.meta/api_rest/dome_sobject_basic_info.htm
    $objectDescription = Forrest::sobjects("$objectName/describe");

    $localStorage = Storage::disk('local');

    ob_start();
    var_dump($objectDescription); 
    $objDump = ob_get_clean();
    $var_dump = "migration-builder/salesforce/$objectName.var_dump.txt";
    $files[] = $var_dump;
    $localStorage->put($var_dump, $objDump);
    
    $print_r = "migration-builder/salesforce/$objectName.print_r.txt";
    $files[] = $print_r;
    $localStorage->put($print_r, print_r($objectDescription, true));

    $json = "migration-builder/salesforce/$objectName.json";
    $files[] = $json;
    $localStorage->put($json, json_encode($objectDescription, JSON_PRETTY_PRINT));

    $this->info('Wrote to local storage');
    $storagePath = storage_path();
    array_map(fn($file) => $this->line(' - ' . $storagePath . '/' . $file), $files);

    return 0;
  }
}
