<?php

namespace Drupal\task_advance\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Task advance settings for this site.
 */
final class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'task_advance_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['task_advance.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = \Drupal::config('task_advance.settings');
    $tag_value = $config->get('tags');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('title'),
      '#default_value' => $config->get('title'),
    ];

    $form['advance'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('advance'),
      '#default_value' => $config->get('advance'),
    ];
    $form['tags'] = [
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('tags'),
      '#target_type' =>'taxonomy_term',
      '#default_value' => \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($tag_value),
      '#required' => True,
    ];
    return parent::buildForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('task_advance.settings')
      ->set('title', $form_state->getValue('title'))
      ->set('advance', $form_state->getValue('advance'))
      ->set('tags', $form_state->getValue('tags'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
