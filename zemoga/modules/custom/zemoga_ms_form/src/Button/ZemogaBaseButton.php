<?php

namespace Drupal\zemoga_ms_form\Button;

/**
 * Class BaseButton.
 *
 * @package Drupal\zemoga_ms_form\Button
 */
abstract class ZemogaBaseButton implements ZemogaButtonInterface {

  /**
   * {@inheritdoc}
   */
  public function ajaxify() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getSubmitHandler() {
    return FALSE;
  }

}
