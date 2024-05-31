<?php

namespace Drupal\user_company_migration\Commands;

use Drush\Commands\DrushCommands;
use Drupal\migrate_tools\MigrateExecutable;
use Drupal\migrate_tools\MigrateBatchExecutable;
use Drupal\migrate\MigrateMessage;

class MigrateCommands extends DrushCommands {

  /**
   * Run all migrations.
   *
   * @command migrate-users-companies:import
   * @aliases muc-import
   */
  public function migrateRun() {
    $migration_ids = [
      'user_migration',
      'company_migration',
    ];

    foreach ($migration_ids as $migration_id) {
      $migration = \Drupal::service('plugin.manager.migration')->createInstance($migration_id);
      if ($migration) {
        $executable = new MigrateBatchExecutable($migration, new MigrateMessage());
        $executable->batchImport();
      } else {
        $this->logger()->error(dt('Migration with ID @id not found.', ['@id' => $migration_id]));
      }
    }
  }
}