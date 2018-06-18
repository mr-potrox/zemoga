<?php

namespace Drupal\zemoga_ms_form\Button;

use Drupal\zemoga_ms_form\Step\ZemogaStepsNum;

/**
 * Class ZemogaStepOneNextButton.
 *
 * @package Drupal\zemoga_ms_form\Button
 */
class ZemogaStepOneNextButton extends ZemogaBaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'next';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Next'),
      '#goto_step' => ZemogaStepsNum::STEP_TWO,
    ];
  }

}
