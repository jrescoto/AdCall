<?php
App::uses('Subscriber', 'Model');

/**
 * Subscriber Test Case
 *
 */
class SubscriberTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.subscriber', 'app.subscriber_detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subscriber = ClassRegistry::init('Subscriber');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subscriber);

		parent::tearDown();
	}

}
