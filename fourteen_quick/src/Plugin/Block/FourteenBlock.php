<?php

declare(strict_types = 1);

namespace Drupal\fourteen_quick\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a fourteen block.
 *
 * @Block(
 *   id = "fourteen_quick_fourteen",
 *   admin_label = @Translation("fourteen"),
 *   category = @Translation("Custom"),
 * )
 */
final class FourteenBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
