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
      '#markup' => t('You have completed the wizard, yeah!'),
    ];
    $form['info'] = [
      '#markup' => $this->getValues()['last_name'],
      '#markup' => $this->getValues()['first_name'],
      '#markup' => $this->getValues()['address'],
      '#markup' => $this->getValues()['city'],
      '#markup' => $this->getValues()['phone_number'],
      '#markup' => $this->getValues()['date_of_bird'],
      '#markup' => $this->getValues()['gender'],
    ];
    $form['button'] = [
      '#type' => 'submit',
      '#value' => t('Finish!'),
      '#goto_step' => ZemogaStepsNum::STEP_ONE,
      '#submit_handler' => 'submitValues',
    ];
    return $form;
  }

}
