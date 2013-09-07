<?php
App::uses('Campaign', 'Model');

/**
 * Campaign Test Case
 *
 */
class CampaignTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.campaign', 'app.client', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Campaign = ClassRegistry::init('Campaign');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Campaign);

		parent::tearDown();
	}

}
