<?php

namespace Drupal\cache_task\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Cache\Cache;

/**
 * Controller for handling tasks related to ControllerTask module.
 */
class CacheTaskController extends ControllerBase {

  /**
   * Function call.
   */
  public function task() {
    $nid = 74;
    $cid = 'marksss:' . $nid;

    if ($item = \Drupal::cache()->get($cid)) {
      return $item->data;
    }

    // Build up the markdown array we're going to use later.
    $node = Node::load($nid);
    $title = $node->getTitle();
    $marksss = [
      // '#title' => $node->get('title')->value,
      '#markup' => $title,
      // ...
    ];

    // Set the cache so we don't need to do this work again until $node changes.
    \Drupal::cache()->set($cid, $marksss, Cache::PERMANENT, $node->getCacheTags());

    return $marksss;
  }

}
