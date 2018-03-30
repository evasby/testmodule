<?php

namespace Drupal\testmodule\Email;

/**
 * Interface EmailValidatorInterface
 *
 * @package Drupal\testmodule\Email
 */
interface EmailValidatorInterface
{
  /**
   * @param string $email
   *
   * @return bool
   * @throws \Drupal\testmodule\Email\EmailDomainException
   */
   public function validate($email);
}