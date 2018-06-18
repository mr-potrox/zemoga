<?php

namespace Drupal\zemoga_ms_form\Validator;

/**
 * Class ZemogaValidatorRequired.
 *
 * @package Drupal\zemoga_ms_form\Validator
 */
class ZemogaValidatorRequired extends ZemogaBaseValidator {

  /**
   * {@inheritdoc}
   */
  public function validates($value) {
    return is_array($value) ? !empty(array_filter($value)) : !empty($value);
  }

}
