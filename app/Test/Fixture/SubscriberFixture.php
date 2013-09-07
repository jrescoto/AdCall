<?php
/**
 * SubscriberFixture
 *
 */
class SubscriberFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'subscriber_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'msisdn' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 12, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'active' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
		'date_on' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'date_off' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'subscriber_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'subscriber_id' => 1,
			'msisdn' => 'Lorem ipsu',
			'active' => 1,
			'date_on' => '2012-03-29 09:07:17',
			'date_off' => '2012-03-29 09:07:17'
		),
	);
}
