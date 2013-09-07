<?php
/**
 * SubscriberDetailFixture
 *
 */
class SubscriberDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'subscriber_detail_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'subscriber_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'full_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'age' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 3),
		'address_line_1' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'address_line_2' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'region_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'region_city_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'date_added' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'timestamp' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => array('subscriber_detail_id', 'subscriber_id', 'region_id', 'region_city_id'), 'unique' => 1), 'fk_subscriber_details_subscribers1' => array('column' => 'subscriber_id', 'unique' => 0), 'fk_subscriber_details_regions1' => array('column' => 'region_id', 'unique' => 0), 'fk_subscriber_details_region_cities1' => array('column' => 'region_city_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'subscriber_detail_id' => 1,
			'subscriber_id' => 1,
			'full_name' => 'Lorem ipsum dolor sit amet',
			'age' => 1,
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'region_id' => 1,
			'region_city_id' => 1,
			'date_added' => '2012-03-29 09:09:54',
			'timestamp' => 1333004994
		),
	);
}
