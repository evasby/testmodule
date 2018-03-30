<?php

namespace Drupal\Tests\testmodule\Unit;

use Drupal\testmodule\Email\EmailValidatorInterface;
use Drupal\testmodule\Email\EmailDomainValidator;
use Drupal\testmodule\Email\EmailDomainException;
use Drupal\Tests\UnitTestCase;
use Drupal\Component\Utility\UrlHelper;

/**
 * Provide some basic tests for our FruitForm form.
 * @group testmodule
 */
class EmailDomainValidatorTest extends UnitTestCase {

  /**
   * Provides data for the testIsValidEmail method.
   *
   * @return array
   */
  public function IsValidEmailDataProvider() {
    return [
      ['test@test.com'],
      ['test@google.com'],
      ['test@yahoo.com'],
    ];
  }

  /**
   * @var \Drupal\testmodule\Email\EmailDomainValidator
   */
  public $validatorService;

  //protected function setUp() {
    /*parent::setUp();
    $this->validatorService = $this->getMockBuilder('\Drupal\testmodule\Email\EmailDomainValidator')
      ->disableOriginalConstructor()
      ->getMock();*/


    /*$this->EmailParserInterface = $this->getMockBuilder ('\Drupal\testmodule\Email\EmailParserInterface')
      ->disableOriginalConstructor()
      ->getMock();*/

    /*$this->container = new ContainerBuilder();
    $this->container->set('validator.service', $this->validatorService);
    \Drupal::setContainer($this->container);*/
  //}



  /**
   * Tests valid absolute URLs.
   *
   * @dataProvider IsValidEmailDataProvider
   */
  public function testIsValidEmail($email) {

   /* $this->EmailParserInterface = $this->getMockBuilder ('\Drupal\testmodule\Email\EmailParserInterface')
      ->disableOriginalConstructor()
      ->getMock();*/




    //$statistics = new EmailDomainValidator();
    //$isValidEmail = $statistics->validate($email);
    //$isValidEmail = EmailDomainValidator::validate($email);
    //$this->assertTrue($isValidEmail, $email . ' is a valid Email.');

    $obj = $this->getMockBuilder('\Drupal\testmodule\Email\EmailDomainValidator')
      //->disableOriginalConstructor()
      ->getMock();
    $this->assertTrue($obj->validate($email), $email . ' is a valid Email.');
  }

  /**
   * Tests valid absolute URLs.
   *
   * dataProvider IsValidAbsoluteUrlDataProvider
   */
  /*public function testIsValidAbsoluteUrl($url) {
    $isValidUrl = UrlHelper::isValid($url, TRUE);
    $this->assertTrue($isValidUrl, $url . ' is a valid URL.');
  }*/



}