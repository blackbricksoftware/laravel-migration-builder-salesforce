<?php

declare(strict_types=1);

namespace BlackBrickSoftware\MigrationBuilderSalesforce\Commands;

use BlackBrickSoftware\MigrationBuilder\Column;
use BlackBrickSoftware\MigrationBuilder\MigrationCreator;
use BlackBrickSoftware\MigrationBuilder\Table;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObject;
use BlackBrickSoftware\MigrationBuilderSalesforce\SObjectMigration;
use Forrest;
use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Support\Composer;

class SObjectMigrationCommand extends BaseCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:migration-builder:salesforce:object
    {objectName : Name of Salesforce object}
    {--create= : The table to be created}
    {--table= : The table to migrate}
    {--path= : The location where the migration file should be created}
    {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
    {--fullpath : Output the full path of the migration}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a data base migration for a Salesforce object';

  /**
   * The Composer instance.
   *
   * @var \Illuminate\Support\Composer
   */
  protected $composer;

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

    $sobject = new SObject($objectDescription);

    $app = app();

    // see: Illuminate\Database\MigrationServiceProvider (we are using our own variant)
    $migrationCreator = new MigrationCreator($app['files'], $app->basePath('stubs'));

    // see: Illuminate\Database\Console\Migrations\MigrateMakeCommand
    $path = $this->getMigrationPath();

    $table = new Table($objectName, [
      'timestamps' => true,
    ]);
    $table->addColumn(new Column('local_id', 'integer', [
      'autoIncrement' => true,
    ]));

    $migration = new SObjectMigration("create_{$objectName}_table", $path, $table, $migrationCreator);
    $migration->addSObject($sobject);

    $file = $migration->writeMigration(true);

    $this->composer->dumpAutoloads();

    $this->info("Created Migration: $file");

    return 0;
  }

  /**
   * Get migration path (either specified by '--path' option or default location).
   *
   * @return string
   */
  protected function getMigrationPath()
  {
    if (!is_null($targetPath = $this->input->getOption('path'))) {
      return !$this->usingRealPath()
        ? $this->laravel->basePath() . '/' . $targetPath
        : $targetPath;
    }

    return parent::getMigrationPath();
  }
}
