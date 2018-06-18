<?php

namespace Drupal\zemoga_ms_form\Step;

/**
 * Class ZemogaStepFinalize.
 *
 * @package Drupal\zemoga_test\Step
 */
class ZemogaStepFinalize extends ZemogaBaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return ZemogaStepsNum::STEP_THREE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {

    $form['completed'] = [
      '#markup' => t('The user was created successfully!'),
    ];

    return $form;
  }

}
