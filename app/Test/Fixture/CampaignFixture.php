<?php
/**
 * CampaignFixture
 *
 */
class CampaignFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'campaign_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'campaign_status_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sms_ad' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 160, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'audo_ad' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 160, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'end' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'date_added' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'timestamp' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => array('campaign_id', 'campaign_status_id', 'client_id', 'user_id'), 'unique' => 1), 'fk_campaigns_campaign_statuses1' => array('column' => 'campaign_status_id', 'unique' => 0), 'fk_campaigns_clients1' => array('column' => 'client_id', 'unique' => 0), 'fk_campaigns_users1' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'campaign_id' => 1,
			'campaign_status_id' => 1,
			'client_id' => 1,
			'user_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'sms_ad' => 'Lorem ipsum dolor sit amet',
			'audo_ad' => 'Lorem ipsum dolor sit amet',
			'start' => '2012-03-29 09:11:19',
			'end' => '2012-03-29 09:11:19',
			'date_added' => '2012-03-29 09:11:19',
			'timestamp' => 1333005079
		),
	);
}
