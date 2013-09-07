<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property UserDetail $UserDetail
 * @property Campaign $Campaign
 */
class User extends AppModel {
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
	public $primaryKey = 'user_id';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';
/**
 * Name field
 *
 * @var string
 */
	public $name = 'User';

	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Username cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Username is already taken.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'Alphabets and numbers only.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'message' => 'Username must be at least 6 characters.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Password cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'message' => 'Password must be at least 6 characters.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'Match passwords' => array(
                'rule'=> 'matchPasswords',
                'message' => 'Your passwords do not match.'
            ),
		),
		'confirm_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please confirm password.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid e-mail format.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Email cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'E-mail address is already taken.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'current_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Current password cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'match_current' => array(
                'rule' => array('matchCurrentPassword'),
                'message' => 'Your password was incorrect.'
            )
        ),
        'new_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'New password cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'match_confirm' => array(
                'rule' => array('matchConfirmNewPassword'),
                'message' => 'Passwords do not match.'
            )
        ),
        /*
        'confirm_new_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Confirm new password cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
        )
         */
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'UserDetail' => array(
			'className' => 'UserDetail',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        /*
		'UserDetail' => array(
			'className' => 'UserDetail',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
        ),
        */

		/**
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => '',
			'conditions' => 'User.role_id = Role.role_id',
			'fields' => '',
			'order' => ''
		)
		*/
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Campaign' => array(
			'className' => 'Campaign',
			'foreignKey' => 'user_id',
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

	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array('Role');
	/*
	public $belongsTo = array(
			'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
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
	
/**
 * actsAs 
 * 
 * @var array
 */
	//public $actsAs = array('Acl' => array('type' => 'requester'));
    
    /*
    var $actsAs = array(
        'Sluggable' => array(
            'title_field' => 'username',
            'slug_field' => 'slug',
            'slug_max_length' => 100,
            'separator' => '_'
        )
    );
     */



	public function parentNode() {
		if (!$this->id && empty($this->data))
		{
			return null;
		}
		if (isset($this->data['User']['role_id']))
		{
			$roleId = $this->data['User']['role_id'];
		}
		else
		{
			$roleId = $this->field('role_id');
		}
		if (!$roleId)
		{
			return null;
		}
		else
		{
			return array('Role' => array('role_id' => $roleId));
		}
	}
	
	
    public function matchPasswords($data) {
        if ($data['password'] == $this->data['User']['confirm_password']) {
            return true;
        }
        $this->invalidate('password_confirmation', 'Your passwords do not match');
        return false;
    }

    public function matchCurrentPassword($data) {
        //DO NOT USER READ. THIS WILL OVERRIDE $this->data
        //$userToEdit = $this->read(null, $this->data['User']['user_id']);
        $userToEdit = $this->findByUserId($this->data['User']['user_id']);

        if (AuthComponent::password($data['current_password']) == $userToEdit['User']['password']) {
            return true;
        }
        //$this->invalidate('current_password', 'Your passwords do not match');
        return false;
    }

    public function matchConfirmNewPassword($data) {
        if ($data['new_password'] == $this->data['User']['confirm_new_password']) {
            return true;
        }
        $this->invalidate('confirm_new_password', 'Passwords do not match.');
        return false;
    }

    public function beforeSave() {
        if(isset($this->data['User']['password']))
        {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
    
    public function isOwnedBy($profile_id, $user) {
    	return $this->field('user_id', array('user_id' => $user)) === $profile_id;
    	//return $profile_id === $user;
    }

}
