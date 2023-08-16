<?php

namespace Drupal\colors\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Use of our custom service.
 */
class CustomContyp extends ControllerBase {

  /**
   * This is the function hello.
   */
  public function new() {
    $node = Node::load(8);
    if ($node->getType() === 'Shapes') {
      $shape = $node->getTitle();
      $term = '';
      $color_tid = $node->get('field_texx')->referencedEntities();
      if (!empty($color_tid)) {
        $taxonomy_term = reset($color_tid);
        $term = $taxonomy_term->getName();
      }
      $user = '';
      $userid = $taxonomy_term->get('field_users')->referencedEntities();
      if (!empty($userid)) {
        $user_name = reset($userid);
        $user = $user_name->getDisplayName();
      }
      return [
        '#markup' => "$shape | $term | $user",
      ];
    }
  }

}
