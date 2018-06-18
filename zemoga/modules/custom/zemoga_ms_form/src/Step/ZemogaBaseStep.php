<?php

namespace Drupal\zemoga_ms_form\Step;

/**
 * Class ZemogaBaseStep.
 *
 * @package Drupal\zemoga_ms_form\Step
 */
abstract class ZemogaBaseStep implements ZemogaStepInterface {

  /**
   * Multi steps of the form.
   *
   * @var ZemogaStepInterface
   */
  protected $step;

  /**
   * Values of element.
   *
   * @var array
   */
  protected $values;

  /**
   * ZemogaBaseStep constructor.
   */
  public function __construct() {
    $this->step = $this->setStep();
  }

  /**
   * {@inheritdoc}
   */
  public function getStep() {
    return $this->step;
  }

  /**
   * {@inheritdoc}
   */
  public function isLastStep() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function setValues($values) {
    $this->values = $values;
  }

  /**
   * {@inheritdoc}
   */
  public function getValues() {
    return $this->values;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  abstract protected function setStep();

}
