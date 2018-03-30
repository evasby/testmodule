<?php

namespace Drupal\testmodule\Email;

/**
 * Class EmailDomainValidator
 *
 * @package Drupal\testmodule\Email
 */
class EmailDomainValidator implements EmailValidatorInterface
{
  const EMAIL_REGEXPR = "^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$";

  /**
   * @var EmailParserInterface
   */
  private $parser;
  
  /**
   * @var array
   */
  private $domains;

  /**
   * EmailValidator constructor.
   *
   * @param \Drupal\testmodule\Email\EmailParserInterface $parser
   * @param array                                         $domains
   */
  public function __construct(EmailParserInterface $parser, $domains) {
    $this->parser = $parser;
    $this->domains = $domains;
  }

  /**
   * @inheritdoc
   */
  public function validate($email) {
    $emailEntity = $this->parser->parse($email);

    if(!$this->isValidEmail($email)) {
      throw new EmailDomainException('Invalid email');
    }
    $test = in_array($emailEntity->getDomain(), $this->domains);
    return in_array($emailEntity->getDomain(), $this->domains);
  }

  /**
   * @return array
   */
  public function getDomains() {
    return $this->domains;
  }

  /**
   * Validates email.
   *
   * @param string $email
   *
   * @return int
   */
  protected function isValidEmail($email){
    return preg_match("|" . self::EMAIL_REGEXPR . "|", $email);
  }
}
