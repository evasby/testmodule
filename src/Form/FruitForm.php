<?php

namespace Drupal\testmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\testmodule\Email\EmailValidatorInterface;
use Drupal\testmodule\Email\EmailDomainValidator;
use Drupal\testmodule\Email\EmailDomainException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class FruitForm
 *
 * @package Drupal\testmodule\Form
 */
class FruitForm extends FormBase {
    
  /**
   * @var EmailValidatorInterface
   */
  private $emailValidator;
    
  /**
   * Class constructor.
   * 
   * @param EmailDomainValidator $emailValidator
   */
  public function __construct(EmailValidatorInterface $emailValidator) {
    $this->emailValidator = $emailValidator;
  }
  
  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'fruitform';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $fruits = ['Apple', 'Banana', 'Blueberry', 'Grapes', 'Orange', 'Strawberry'];

    $form['favorite_fruit'] = array(
      '#type' => 'select',
      '#title' => $this->t('Tell us your favorite fruit.'),
      '#required' => true,
      '#options' => array_combine($fruits, $fruits)
    );

    $form['email_address'] = array(
      '#type' => 'email',
      '#title' => $this->t('What is your email address?'),
      '#required' => true,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit!'),
    );

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!filter_var($form_state->getValue('email_address'), FILTER_VALIDATE_EMAIL)) {
      $form_state->setError($form['email_address'], 'Email address is invalid.');
    }

    try {
      if (!$this->emailValidator->validate($form_state->getValue('email_address'))) {
        $form_state->setError(
          $form['email_address'], 
          sprintf('Sorry, we accept only the next email domains: %s', implode(', ', $this->emailValidator->getDomains()))
        );
      }
    } catch(EmailDomainException $e) {
      $form_state->setError(
        $form['email_address'], 
        sprintf('Error occurred: %s', $e->getMessage())
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('testmodule.email_domain_validator')
    );
  }
  
  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('@fruit! Wow! Nice choice! Thanks for telling us!', array('@fruit' => $form_state->getValue('favorite_fruit'))));
    $form_state->setRedirect('<front>');
  }
}
