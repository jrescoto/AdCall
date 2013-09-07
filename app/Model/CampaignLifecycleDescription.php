<?php
App::uses('AppModel', 'Model');
/**
 * CampaignLifecycleDescription Model
 *
 */
class CampaignLifecycleDescription extends AppModel {
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'campaign_lifecycle_description_id';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
