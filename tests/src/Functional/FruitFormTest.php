<?php

namespace Drupal\Tests\testmodule\Functional;

use Drupal\simpletest\WebTestBase;

/**
 * Provide some basic tests for our FruitForm form.
 * @group testmodule
 */
class FruitFormTest extends WebTestBase {

  /**
   * Modules to install.
   * @var array
   */
  public static $modules = ['node', 'testmodule'];

  /**
   * Tests that 'testmodule/form' returns a 200 OK response.
   */
  public function testFruitFormRouterURLIsAccessible() {
    $this->drupalGet('testmodule/form');
    $this->assertResponse(200);
  }

  /**
   * Tests that the form has a submit button and email field.
   */
  public function testFruitFormFieldsExists() {
    $this->drupalGet('testmodule/form');
    $this->assertResponse(200);
    $this->assertFieldById('edit-submit');
    $this->assertFieldById('edit-email-address');
  }

  /**
   * Test the submission of the form.
   * @throws \Exception
   */
  public function testFruitFormSubmit() {
    // submit the form with test@test.com as a value
    $this->drupalPostForm(
      'testmodule/form',
      array(
        'email_address' => 'test@test.com',
      ),
      t('Submit!')
    );

    // we should now be on the homepage, and see the right form success message
    $this->assertUrl('<front>');

    // submit the form with values which should pass
    $this->drupalPostForm(
      'testmodule/form',
      array(
        'favorite_fruit' => 'Apple',
        'email_address' => 'test@gmail.com'
      ),
      t('Submit!')
    );

    // we should now be on the homepage, and see the right form success message
    $this->assertUrl('<front>');
    $this->assertText('Apple! Wow! Nice choice! Thanks for telling us!', 'The successful submission message was detected on the screen.');
  }
}