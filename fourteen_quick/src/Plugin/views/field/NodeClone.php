<?php

namespace Drupal\fourteen_quick\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Handler for showing quick node clone link.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("cloning_link")
 */
class NodeClone extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['text'] = ['default' => $this->getDefaultLabel()];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text to visible on screen'),
      '#default_value' => $this->options['text'],
    ];
    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function query() {}

  /**
   * Returns the default label for the link.
   *
   * @return string
   *   The default link label.
   */
  protected function getDefaultLabel() {
    return $this->t('node');
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $node = $this->getEntity($values);

    if (!$node) {
      return '';
    }

    $url = Url::fromRoute('entity.node.canonical', ['node' => $node->id()]);

    if (!$url->access()) {
      return '';
    }

    return [
      '#type' => 'link',
      '#url' => $url,
      '#title' => $this->options['text'] ?: $this->getDefaultLabel(),
    ];
  }

}
