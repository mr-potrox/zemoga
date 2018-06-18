<?php

namespace Drupal\zemoga_ms_form\Validator;

/**
 * Class ZemogaBaseValidator.
 *
 * @package Drupal\zemoga_ms_form\Validator
 */
abstract class ZemogaBaseValidator implements ZemogaValidatorInterface {

  protected $errorMessage;

  /**
   * ZemogaBaseValidator constructor.
   *
   * @param string $error_message
   *   Error message.
   */
  public function __construct($error_message) {
    $this->errorMessage = $error_message;
  }

  /**
   * {@inheritdoc}
   */
  public function getErrorMessage() {
    return $this->errorMessage;
  }

}
