<?php
App::uses('CampaignStatus', 'Model');

/**
 * CampaignStatus Test Case
 *
 */
class CampaignStatusTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.campaign_status');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CampaignStatus = ClassRegistry::init('CampaignStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CampaignStatus);

		parent::tearDown();
	}

}
