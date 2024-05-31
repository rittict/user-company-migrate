<?php

namespace Drupal\user_company_migration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class UserCompanyController extends ControllerBase {

  public function userCompanyPage() {
    $build = [];

    $user_nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'user']);
    foreach ($user_nodes as $user_node) {
      $company_node = $user_node->get('field_company')->entity;
      $build[] = [
        '#markup' => '<h2>' . $user_node->getTitle() . '</h2>' .
                     '<p>Username: ' . $user_node->get('field_username')->value . '</p>' .
                     '<p>Email: ' . $user_node->get('field_email')->value . '</p>' .
                     '<p>Phone: ' . $user_node->get('field_phone')->value . '</p>' .
                     '<p>Website: ' . $user_node->get('field_website')->uri . '</p>' .
                     '<h3>Company: ' . $company_node->getTitle() . '</h3>' .
                     '<p>Catch Phrase: ' . $company_node->get('field_catch_phrase')->value . '</p>' .
                     '<p>BS: ' . $company_node->get('field_bs')->value . '</p>',
      ];
    }

    return [
      '#theme' => 'item_list',
      '#items' => $build,
    ];
  }
}
