<?php

namespace Drupal\zemoga_ms_form\Step;

use Drupal\zemoga_ms_form\Button\ZemogaStepOneNextButton;
use Drupal\zemoga_ms_form\Validator\ZemogaValidatorRequired;

/**
 * Class ZemogaStepOne.
 *
 * @package Drupal\zemoga_ms_form\Step
 */
class ZemogaStepOne extends ZemogaBaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return ZemogaStepsNum::STEP_ONE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new ZemogaStepOneNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {

    // First name field.
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => t("Name"),
      '#required' => FALSE,
      '#default_value' => isset($this->getValues()['first_name']) ? $this->getValues()['first_name'] : [],
    ];

    // Last Name field.    
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => t("Last Name"),
      '#required' => FALSE,
      '#default_value' => isset($this->getValues()['last_name']) ? $this->getValues()['last_name'] : [],      
    ];

    // Genderfield.    
    $form['gender'] = [
      '#type' => 'select',
      '#title' => t('Gender'),
      '#options' => [
        'male' => t('Male'),
        'female' => t('Female'),
      ],
    ];
    $form['gender'] = [
      '#type' => 'checkboxes',
      '#title' => t('Gender?'),
      '#options' => ['male' => 'Male', 'female' => 'Female'],
      '#default_value' => isset($this->getValues()['gender']) ? $this->getValues()['gender'] : [],
      '#required' => FALSE,
    ];

    // Date of Birth field.    
    $form['date_of_birth'] = array(
      '#type' => 'date',
      '#title' => t('Date of birth'),
      '#default_value' => array(
        'year' => 2020,
        'month' => 2,
        'day' => 15,
      ),
      '#default_value' => isset($this->getValues()['date_of_birth']) ? $this->getValues()['date_of_birth'] : [],      
    );
    
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'first_name',
      'last_name',
      'gender',
      'date_of_birth',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [
      'first_name' => [
        new ZemogaValidatorRequired("Please type your Name. This field is required."),
      ],
      'last_name' => [
        new ZemogaValidatorRequired("Please type your Last Name. This field is required."),
      ],
      'gender' => [
        new ZemogaValidatorRequired("Please choose The Gender. This field is required."),
      ],
      'date_of_birth' => [
        new ZemogaValidatorRequired("Please type your Date of Bird. This field is required."),
      ],
    ];
  }

}
