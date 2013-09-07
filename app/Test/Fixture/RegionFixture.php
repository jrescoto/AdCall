<?php
/**
 * RegionFixture
 *
 */
class RegionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'region_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_added' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'timestamp' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'region_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'region_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'date_added' => '2012-03-29 09:02:50',
			'timestamp' => 1333004570
		),
	);
}
