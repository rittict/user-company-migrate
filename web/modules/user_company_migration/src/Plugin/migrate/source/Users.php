<?php

namespace Drupal\user_company_migration\Plugin\migrate\source;

use Drupal\migrate_plus\Plugin\migrate\source\Url;
use Drupal\migrate\Row;

/**
 * Source plugin for users.
 *
 * @MigrateSource(
 *   id = "users"
 * )
 */
class Users extends Url {

  public function prepareRow(Row $row) {
    $company = $row->getSourceProperty('company');
    $company_name = isset($company['name']) ? $company['name'] : '';
    $row->setSourceProperty('company_name', $company_name);
    return parent::prepareRow($row);
}

}
