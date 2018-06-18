<?php

namespace Drupal\zemoga_ms_form\Step;

use Drupal\zemoga_ms_form\Button\ZemogaStepTwoNextButton;
use Drupal\zemoga_ms_form\Button\ZemogaStepTwoPreviousButton;
use Drupal\zemoga_ms_form\Validator\ZemogaValidatorRequired;

/**
 * Class ZemogaStepTwo.
 *
 * @package Drupal\zemoga_ms_form\Step
 */
class ZemogaStepTwo extends ZemogaBaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return ZemogaStepsNum::STEP_TWO;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new ZemogaStepTwoPreviousButton(),
      new ZemogaStepTwoNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    // City field.
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => t("City"),
      '#required' => FALSE,
      '#default_value' => isset($this->getValues()['city']) ? $this->getValues()['city'] : [],
    ];

    // Phone Number field.    
    $form['phone_number'] = [
      '#type' => 'textfield',
      '#title' => t("Phone Number"),
      '#required' => FALSE,
      '#default_value' => isset($this->getValues()['phone_number']) ? $this->getValues()['phone_number'] : [],      
    ];

    // Address field.    
    $form['address'] = [
      '#type' => 'textfield',
      '#title' => t("Address"),
      '#required' => FALSE,
      '#default_value' => isset($this->getValues()['address']) ? $this->getValues()['address'] : [],      
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'city',
      'phone_number',
      'address',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [
      'city' => [
        new ZemogaValidatorRequired("Please type your City. This field is required."),
      ],
      'phone_number' => [
        new ZemogaValidatorRequired("Please type your Phone Number. This field is required."),
      ],
      'address' => [
        new ZemogaValidatorRequired("Please type your Address. This field is required."),
      ],
    ];
  }

}
