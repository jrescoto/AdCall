<?php
App::uses('SubscriberDetail', 'Model');

/**
 * SubscriberDetail Test Case
 *
 */
class SubscriberDetailTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.subscriber_detail', 'app.subscriber', 'app.region', 'app.region_city');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SubscriberDetail = ClassRegistry::init('SubscriberDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SubscriberDetail);

		parent::tearDown();
	}

}
