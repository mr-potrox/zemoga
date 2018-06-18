<?php

namespace Drupal\zemoga_ms_form\Validator;

/**
 * Interface ZemogaValidatorInterface.
 *
 * @package Drupal\zemoga_ms_form\Validator
 */
interface ZemogaValidatorInterface {

  /**
   * Returns bool indicating if validation is ok.
   */
  public function validates($value);

  /**
   * Returns error message.
   */
  public function getErrorMessage();

}
