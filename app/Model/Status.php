<?php
App::uses('AppModel', 'Model');
/**
 * Status Model
 *
 */
class Status extends AppModel {
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
	public $primaryKey = 'status_id';
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
		'status_id' => array(
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
