<?php

namespace Drupal\zemoga_ms_form\Button;

/**
 * Interface ButtonInterface.
 *
 * @package Drupal\zemoga_ms_form\Button
 */
interface ZemogaButtonInterface {

  /**
   * Get the key.
   *
   * @returns button key.
   */
  public function getKey();

  /**
   * Build the button.
   *
   * @returns renderable array.
   */
  public function build();

  /**
   * Set the button if it is ajaxified or not.
   *
   * @returns if button has to be ajaxified.
   */
  public function ajaxify();

  /**
   * Override submit callback.
   */
  public function getSubmitHandler();

}
