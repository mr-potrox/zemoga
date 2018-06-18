<?php

namespace Drupal\zemoga_ms_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\zemoga_ms_form\Manager\ZemogaStepManager;
use Drupal\zemoga_ms_form\Step\ZemogaStepsNum;

/**
 * Class ZemogaMultiStepForm.
 */
class ZemogaMultiStepForm extends FormBase {


  /**
   * Step Id.
   *
   * @var \Drupal\zemoga_ms_form\Step\ZemogaStepsNum
   */
  protected $stepId;

  /**
   * Multi steps of the form.
   *
   * @var \Drupal\zemoga_ms_form\Step\ZemogaStepInterface
   */
  protected $step;

  /**
   * Step manager instance.
   *
   * @var \Drupal\zemoga_ms_form\Manager\ZemogaStepManager
   */
  protected $zemogaStepManager;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->stepId = ZemogaStepsNum::STEP_ONE;
    $this->stepManager = new ZemogaStepManager();
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'zemoga_multi_step_form';
  }


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['wrapper-messages'] = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'messages-wrapper',
      ],
    ];

    $form['wrapper'] = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'form-wrapper',
      ],
    ];

    // Get step from step manager.
    $this->step = $this->stepManager->getStep($this->stepId);

    // Attach step form elements.
    $form['wrapper'] += $this->step->buildStepFormElements();

    // Attach buttons.
    $form['wrapper']['actions']['#type'] = 'actions';
    $buttons = $this->step->getButtons();
    foreach ($buttons as $button) {
      /** @var \Drupal\zemoga_test\Button\ButtonInterface $button */
      $form['wrapper']['actions'][$button->getKey()] = $button->build();

      if ($button->ajaxify()) {
        // Add ajax to button.
        $form['wrapper']['actions'][$button->getKey()]['#ajax'] = [
          'callback' => [$this, 'loadStep'],
          'wrapper' => 'form-wrapper',
          'effect' => 'fade',
        ];
      }

      $callable = [$this, $button->getSubmitHandler()];
      if ($button->getSubmitHandler() && is_callable($callable)) {
        // Attach submit handler to button, so we can execute it later on..
        $form['wrapper']['actions'][$button->getKey()]['#submit_handler'] = $button->getSubmitHandler();
      }
    }

    return $form;

  }

  /**
   * Ajax callback to load new step.
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state interface.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   Ajax response.
   */
  public function loadStep(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    $messages = drupal_get_messages();
    if (!empty($messages)) {
      // Form did not validate, get messages and render them.
      $messages = [
        '#theme' => 'status_messages',
        '#message_list' => $messages,
        '#status_headings' => [
          'status' => $this->t('Status message'),
          'error' => $this->t('Error message'),
          'warning' => $this->t('Warning message'),
        ],
      ];
      $response->addCommand(new HtmlCommand('#messages-wrapper', $messages));
    }
    else {
      // Remove messages.
      $response->addCommand(new HtmlCommand('#messages-wrapper', ''));
    }

    // Update Form.
    $response->addCommand(new HtmlCommand('#form-wrapper',
      $form['wrapper']));

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    // Only validate if validation doesn't have to be skipped.
    // For example on "previous" button.
    if (empty($triggering_element['#skip_validation']) && $fields_validators = $this->step->getFieldsValidators()) {
      // Validate fields.
      foreach ($fields_validators as $field => $validators) {
        // Validate all validators for field.
        $field_value = $form_state->getValue($field);
        foreach ($validators as $validator) {
          if (!$validator->validates($field_value)) {
            $form_state->setErrorByName($field, $validator->getErrorMessage());
          }
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save filled values to step. So we can use them as default_value later on.
    $values = [];
    foreach ($this->step->getFieldNames() as $name) {
      $values[$name] = $form_state->getValue($name);
    }
    $form_state->setStorage($values);
    $this->step->setValues($values);
    // Add step to manager.
    $this->stepManager->addStep($this->step);
    // Set step to navigate to.
    $triggering_element = $form_state->getTriggeringElement();
    $this->stepId = $triggering_element['#goto_step'];

    // If an extra submit handler is set, execute it.
    // We already tested if it is callable before.
    if (isset($triggering_element['#submit_handler'])) {
      $this->{$triggering_element['#submit_handler']}($form, $form_state);
    }

    $form_state->setRebuild(TRUE);
  }

  /**
   * Submit handler for last step of form.
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state interface.
   */
  public function submitValues(array &$form, FormStateInterface $form_state) {
    
    // Create a new user
    // Getting the form values.
    $values = [];
   
    $steps_values = $this->stepManager->steps;
    foreach ($steps_values as $step => $step_value) {
      $field_definitions = $step_value->getValues();
      foreach ($field_definitions as $field_name => $field_value) {
        if ($field_name == "gender") {
          foreach ($field_value as $value) {
            if ($value) {
              $values[$field_name] = $value;
            }
          }
        }
        else{
          $values[$field_name] = $field_value;
        }
        
      }
    }

    $user_name = str_replace(' ', '', $values['first_name']) . '_' . str_replace(' ', '', $values['last_name']);

    $lang = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $user = \Drupal\user\Entity\User::create();
 
    // The Basics
    $user->setUsername($user_name);
    $user->setPassword('zemogaTest');
    $user->setEmail($user_name . '@zemogaTest.com');
    $user->enforceIsNew();  // Set this to FALSE if you want to edit (resave) an existing user object
    $user->set('field_first_name', $values['first_name']);
    $user->set('field_last_name', $values['last_name']);
    $user->set('field_date_of_birth', $values['date_of_birth']);
    $user->set('field_gender', $values['gender']);
    $user->set('field_city', $values['city']);

    if (!empty($values['address'])) {
      $user->set('field_address', $values['address']);
    }

    if (!empty($values['address'])) {
      $user->set('field_phone_number', $values['phone_number']);
    }

    $user->set("init", $user_name . '@zemogaTest.com');
    $user->set("langcode", $lang);
    $user->set("preferred_langcode", $lang);
    $user->set("preferred_admin_langcode", $lang);
    $user->activate();
 
    // Save user
    $result = $user->save();
  }

}
