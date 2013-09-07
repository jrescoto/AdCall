<?php
App::uses('AppModel', 'Model');
/**
 * CampaignLifecycle Model
 *
 * @property CampaignLifecycle $CampaignLifecycle
 * @property Campaign $Campaign
 * @property CampaignLifecycleDescription $CampaignLifecycleDescription
 */
class CampaignLifecycle extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'campaign_lifecycle';
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'campaign_lifecycle_id';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'campaign_lifecycle_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'campaign_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'author' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'campaign_lifecycle_description_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */

	public $hasOne = array(
		'CampaignLifecycleDescription' => array(
			'className' => 'CampaignLifecycleDescription',
			'foreignKey' => 'campaign_lifecycle_description_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Campaign' => array(
			'className' => 'Campaign',
			'foreignKey' => 'campaign_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CampaignLifecycleDescription' => array(
			'className' => 'CampaignLifecycleDescription',
			'foreignKey' => 'campaign_lifecycle_description_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
