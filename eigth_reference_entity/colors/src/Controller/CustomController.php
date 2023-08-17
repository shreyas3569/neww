<?php

namespace Drupal\colors\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Use of our custom service.
 */
class CustomController extends ControllerBase {

  /**
   * This is the function colors.
   */
  public function colors() {
    $node_id = 8;
    $node = Node::load($node_id);
    if ($node && $node->getType() == 'Shapes') {
      $node_title = $node->getTitle();
      $taxonomy_term_name = '';
      $taxonomy_term_references = $node->get('field_texx')->referencedEntities();
      if (!empty($taxonomy_term_references)) {
        $taxonomy_term = reset($taxonomy_term_references);
        $taxonomy_term_name = $taxonomy_term->getName();
      }
      $user_name = '';
      $user_references = $node->get('field_texx')->entity->get('field_users')->referencedEntities();
      if (!empty($user_references)) {
        $user = reset($user_references);
        $user_name = $user->getDisplayName();
      }
      return [
        '#markup' => $node_title . ' ' . $taxonomy_term_name . ' ' . $user_name,
      ];
    }
  }

}
