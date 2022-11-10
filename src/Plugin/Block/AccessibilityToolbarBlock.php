<?php

namespace Drupal\civic_accessibility_toolbar\Plugin\Block;

/**
 * @file
 * Contains \Drupal\civic_accessibility_toolbar\Plugin\Block\accessibilityToolbarBlock.
 */

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an accessibility_toolbar block.
 *
 * @Block(
 *   id = "accessibility_toolbar_block",
 *   admin_label = @Translation("Accessibility Toolbar"),
 * )
 */
class AccessibilityToolbarBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['text_resize'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show text resize toolbar'),
      '#description' => $this->t('Check to show the text resize toolbar'),
      '#default_value' => isset($this->configuration['text_resize']) ? $this->configuration['text_resize'] : TRUE,
    ];
    $form['text_resize_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text resize label'),
      '#description' => $this->t('Leave empty for no label'),
      '#default_value' => isset($this->configuration['text_resize_label']) ? $this->configuration['text_resize_label'] : 'Text',
    ];
    $form['color_contrast'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show color contrast toolbar'),
      '#description' => $this->t('Check to show the color contrast toolbar'),
      '#default_value' => isset($this->configuration['color_contrast']) ? $this->configuration['color_contrast'] : TRUE,
    ];
    $form['color_contrast_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Color contrast label'),
      '#description' => $this->t('Leave empty for no label'),
      '#default_value' => isset($this->configuration['color_contrast_label']) ? $this->configuration['color_contrast_label'] : 'Color',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->configuration['text_resize'] = $values['text_resize'];
    $this->configuration['color_contrast'] = $values['color_contrast'];
    $this->configuration['text_resize_label'] = $values['text_resize_label'];
    $this->configuration['color_contrast_label'] = $values['color_contrast_label'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'block__accessibility_toolbar',
      '#text_resize' => $this->configuration['text_resize'],
      '#color_contrast' => $this->configuration['color_contrast'],
      '#text_resize_label' => $this->configuration['text_resize_label'],
      '#color_contrast_label' => $this->configuration['color_contrast_label'],
      '#attached' => [
        'library' => ['civic_accessibility_toolbar/civic_accessibility_toolbar.accessibility_toolbar'],
      ],
    ];
  }

}
