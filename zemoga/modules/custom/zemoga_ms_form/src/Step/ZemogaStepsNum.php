<?php

namespace Drupal\zemoga_ms_form\Step;

/**
 * Class  ZemogaStepsNum.
 *
 * @package Drupal\zemoga_ms_form\Step
 */
abstract class ZemogaStepsNum {

  /**
   * Steps used in form.
   */
  const STEP_ONE = 1;
  const STEP_TWO = 2;
  const STEP_THREE = 3;

  /**
   * Return steps associative array.
   *
   * @return array
   *   Associative array of steps.
   */
  public static function toArray() {
    return [
      self::STEP_ONE => 'step-one',
      self::STEP_TWO => 'step-two',
      self::STEP_THREE => 'step-finalize',
    ];
  }

  /**
   * Map steps to it's class.
   *
   * @param int $step
   *   Step number.
   *
   * @return bool
   *   Return true if exist.
   */
  public static function map($step) {
    $map = [
      self::STEP_ONE => 'Drupal\\zemoga_ms_form\\Step\\ZemogaStepOne',
      self::STEP_TWO => 'Drupal\\zemoga_ms_form\\Step\\ZemogaStepTwo',
      self::STEP_THREE => 'Drupal\\zemoga_ms_form\\Step\\ZemogaStepFinalize',
    ];

    return isset($map[$step]) ? $map[$step] : FALSE;
  }

}
