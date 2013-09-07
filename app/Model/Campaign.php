<?php
App::uses('AppModel', 'Model');
/**
 * Campaign Model
 *
 * @property Client $Client
 * @property User $User
 */
class Campaign extends AppModel {
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
	public $primaryKey = 'campaign_id';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
        /*
		'client_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
         */
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
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'client_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Client name cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),		),
		'execution_start' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Execution start cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'date' => array(
				'rule' => array('date', 'ymd'),
                'message' => 'Date format must be YYYY-MM-DD.'
            ),
        ),
		'execution_end' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Execution end cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'date' => array(
				'rule' => array('date', 'ymd'),
                'message' => 'Date format must be YYYY-MM-DD.'
			),
			'greaterThanStart' => array(
				'rule' => 'compareDates',
				'message' => 'End date must be ahead of Start date.'
            ),
        ),
		'sms_alert' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'SMS alert cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sms_ad' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'SMS Ad cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'audio_ad' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select audio file.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'validFile' => array(
				'rule' => array('extension', array('mp3', 'wav')),
				'message' => 'Please upload a valid audio file.'
			),
            /*
			'validSize' => array(
				'rule' => array('filesize', '<=', '10MB'),
				'message' => 'Audio filesize must be less than 10MB.'
			),
             */
		),
		'age' => array(
			//'multiple' => array(
				'rule' => array('multiple', array(
					'in' => array('18_24', '25_35', '35_45', '45_60', '60_up', 'all_ages'),
					'min' => 1,
					'max' => 6 
				)),
				'message' => 'Please select at least one age range from the list.'
			//),
			/*
			'inAgeOption' => array(
				'rule' => 'inAgeOption',
				'message' => 'please select 1 or more age range'
			),	
			*/
		),
		'age_from' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Age from cannot be empty.',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Age from must be numeric.',
            ),
            'comparison' => array(
                'rule' => array('comparison', '>=', 18),
                'message' => 'Age must be at least 18'
            )
		),
		'age_to' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Age to cannot be empty.',
			),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Age to must be numeric.',
            ),
            'validAgeRange' => array(
                'rule' => array('validAgeRange'),
                'message' => 'Must be larger than age from.'
            )
		),
		
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select one gender or All.'
			)
		),
        /*
        'filename' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Filename cannot be empty.'
            )
        ),
         */
        'RegionList' => array(
            'rule' => 'RegionListValidation',
            'message' => 'Please fill necessary fields for location.'
        ),

        'RegionCityList' => array(
            'rule' => 'RegionCityListValidation',
            'message' => 'Please fill necessary fields for location.'
        ),

	);

    var $actsAs = array(
        'Sluggable' => array(
            'title_field' => 'title',
            'slug_field' => 'slug',
            'slug_max_length' => 100,
            'separator' => '_',
            'class' => 'Campaign'
        )
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
        /*
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
         */
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'CampaignSetting' => array(
			'className' => 'CampaignSetting',
			'foreignKey' => 'campaign_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
    );

	
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'CampaignLifecycle' => array(
			'className' => 'CampaignLifecycle',
			'foreignKey' => 'campaign_id',
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
		'CampaignAgeRange' => array(
			'className' => 'CampaignAgeRange',
			'foreignKey' => 'campaign_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CampaignLocation' => array(
			'className' => 'CampaignLocation',
			'foreignKey' => 'campaign_id',
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

	public function isOwnedBy($campaign_id, $user) {
    	return $this->field('campaign_id', array('campaign_id' => $campaign_id, 'user_id' => $user)) === $campaign_id;
	}
	
	public function compareDates($data) {
		if(strtotime($data['execution_end']) > strtotime($this->data['Campaign']['execution_start']))
			return true;
		return false;
	}

    public function validAgeRange($data){
        if(empty($this->data['Campaign']['age_from']))
            return true;

        if((int)$data['age_to'] <= (int)$this->data['Campaign']['age_from'])
            return false;

        return true;
    }
	
	public function inAgeOption($data) {
		return false;
	}
	
	public function regionListValidation_test($data) {
        $errors = false;
        /*
		if(strcmp($this->data['Campaign']['location_filter'][0], 'specific_cities_lgus') == 0) {
			//if(empty($data['regionList[0]']) || empty($data['regionList[1]'])) {	
			if(empty($data['regionList'][0])) {	
			}	
		}
         */

        foreach($this->data['Campaign']['location_filter'] as $index => $value){
            if(strcmp($value, 'specific_cities_lgus') == 0){
                if(empty($data['regionList'][$index])){
                    $errors = true;
                    $this->validationErrors['regionList'][$index] = $index . ' error';
                }
            }else{
                //$this->validationErrors['regionList'][$index] = null;
            }
        }

        if($errors)
            return false;

		return true;
	}

    public function RegionListValidation($data){
        $error = false;
        if($this->data['Campaign']['RegionFilter'] == 0){
            //debug($data);
            if(empty($data['RegionList'])){
                $error = true;
            }
        }

        if($error)
            return false;

        return true;
        /*
        $error = false;
        foreach($this->data['Campaign']['RegionFilter'] as $index => $value){
            if($value == 0){
                if(empty($this->data['Campaign']['RegionList'][$index])){
                    $this->validationErrors['RegionList'][$index] = 'Please fill necessary fields for ' . $this->locationName($index);
                    $error = true;
                }
            }else{
                //$this->validationErrors['RegionList'][$index] = null;
            }
        }

        if($error){
            return false;
        }
        return true;
         */
    }

    public function RegionCityListValidation($data){
        $error = false;
        if($this->data['Campaign']['RegionCityFilter'] == 0){
            //debug($data);
            if(empty($data['RegionCityList'])){
                $error = true;
            }
        }

        if($error){
            return false;
        }
        return true;

        /*
        foreach($this->data['Campaign']['RegionCityFilter'] as $index => $value){
            if($value == 0){
                if(empty($this->data['Campaign']['RegionCityList'][$index])){
                    $this->validationErrors['RegionCityList'][$index] = 'Please fill necessary fields for ' . $this->locationName($index);
                    $error = true;
                }
            }else{
                //$this->validationErrors['RegionList'][$index] = null;
            }
        }
         */
    }

    private function locationName($id){
        switch($id){
            case 1: return 'NCR'; break;
            case 2: return 'Balance Luzon'; break;
            case 3: return 'Visayas'; break;
            case 4: return 'Mindanao'; break;
            default: return 'location'; break;
        }
    }
}
