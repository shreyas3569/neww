<?php

declare(strict_types = 1);

namespace Drupal\fifteen_task\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for fifteen_operation routes.
 */
final class FifteenTaskController extends ControllerBase {

  /**
   * Displays the title of the node.
   */
  public function build($node) {
    // $node = Node::load(10);
    return [
      '#markup' => $node->getTitle(),
    ];
  }

}
