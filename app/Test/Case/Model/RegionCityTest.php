<?php
App::uses('RegionCity', 'Model');

/**
 * RegionCity Test Case
 *
 */
class RegionCityTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.region_city', 'app.region', 'app.subscriber_detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RegionCity = ClassRegistry::init('RegionCity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RegionCity);

		parent::tearDown();
	}

}
