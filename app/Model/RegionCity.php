<?php
App::uses('AppModel', 'Model');
/**
 * RegionCity Model
 *
 * @property Region $Region
 * @property SubscriberDetail $SubscriberDetail
 */
class RegionCity extends AppModel {
/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'database';
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'region_city_id';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'region_city_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'region_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tags' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Tags cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Region' => array(
			'className' => 'Region',
			'foreignKey' => 'region_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Subscriber' => array(
			'className' => 'Subscriber',
			'foreignKey' => 'region_city_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    /*
	public $hasMany = array(
		'SubscriberDetail' => array(
			'className' => 'SubscriberDetail',
			'foreignKey' => 'region_city_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
     */

    /*
    var $actsAs = array(
        'Sluggable' => array(
            'title_field' => 'name',
            'slug_field' => 'slug',
            'slug_max_length' => 100,
            'separator' => '_'
        )
    );
     */



}
