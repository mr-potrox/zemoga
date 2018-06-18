<?php

namespace Drupal\zemoga_ms_form\Button;

use Drupal\zemoga_ms_form\Step\ZemogaStepsNum;

/**
 * Class ZemogaStepTwoPreviousButton.
 *
 * @package Drupal\zemoga_ms_form\Button
 */
class ZemogaStepTwoPreviousButton extends ZemogaBaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'previous';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Previous'),
      '#goto_step' => ZemogaStepsNum::STEP_ONE,
      '#skip_validation' => TRUE,
    ];
  }

}
