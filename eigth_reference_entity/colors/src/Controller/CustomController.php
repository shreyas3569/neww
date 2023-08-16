<?php

namespace Drupal\colors\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Use of our custom service.
 */
class CustomController extends ControllerBase {

  /**
   * Function task1.
   */
  public function colors() {
    $node = Node::load(8);
    if ($node) {
      if ($node->getType() === 'Shapes') {
        $shape = $node->getTitle();
        $color_tid = $node->get('field_texx')->entity;
        $term = $color_tid->getName();
        $userid = $color_tid->get('field_users')->entity;
        $user = $userid->getDisplayName();
        $build = [
          '#markup' => "$shape | $term | $user",
        ];
        return $build;
      }
    }
  }

}
