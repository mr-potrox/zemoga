<?php

namespace Drupal\zemoga_ms_form\Manager;

use Drupal\zemoga_ms_form\Step\ZemogaStepInterface;
use Drupal\zemoga_ms_form\Step\ZemogaStepsNum ;

/**
 * Class ZemogaStepManager.
 *
 * @package Drupal\zemoga_ms_form\Manager
 */
class ZemogaStepManager {

  /**
   * Multi steps of the form.
   *
   * @var \Drupal\zemoga_ms_form\Step\ZemogaStepInterface
   */
  public $steps;

  /**
   * StepManager constructor.
   */
  public function __construct() {
  }

  /**
   * Add a step to the steps property.
   *
   * @param \Drupal\zemoga_ms_form\Step\ZemogaStepInterface $step
   *   Step of the form.
   */
  public function addStep(ZemogaStepInterface $step) {
    $this->steps[$step->getStep()] = $step;
  }

  /**
   * Fetches step from steps property, If it doesn't exist, create step object.
   *
   * @param int $step_id
   *   Step ID.
   *
   * @return \Drupal\zemoga_ms_form\Step\ZemogaStepInterface
   *   Return step object.
   */
  public function getStep($step_id) {
    if (isset($this->steps[$step_id])) {
      // If step was already initialized, use that step.
      // Chance is there are values stored on that step.
      $step = $this->steps[$step_id];
    }
    else {
      // Get class.
      $class = ZemogaStepsNum::map($step_id);
      // Init step.
      $step = new $class($this);
    }

    return $step;
  }

  /**
   * Get all steps.
   *
   * @return \Drupal\zemoga_ms_form\Step\ZemogaStepInterface
   *   Steps.
   */
  public function getAllSteps() {
    return $this->steps;
  }

}
