<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Campaigns Controller
 *
 * @property Campaign $Campaign
 * class
 */

class CampaignsController extends AppController {
    public $components = array(
        'Security' => array(
            'unlockedFields' => array(
                'Campaign.age_from',
                'Campaign.age_to',
                'Campaign.age',
                'Campaign.filename',
                'Campaign.audio_ad',
                'Campaign.current_audio_ad'
            )
        ),
        'RequestHandler'
    );
	
    public $helpers = array(
        'Js',
        'Cache'
        //'Chosen.Chosen',
    );

    public $paginate = array(
        'limit' => 10
    );

    public function beforeFilter(){
        $this->Security->unlockedActions = array(
            'validate_profile_setting',
            'data_mine',
        );

		//$this->Auth->allow('prepare_scheduler');
        $this->Security->csrfCheck = false;
        $this->Security->blackHoleCallback = 'blackhole';
        parent::beforeFilter();
    }

    public function blackhole($type){
        debug($type);

        $this->Session->setFlash(__('Problem has been encountered: %s',$type), 'error');
        //TODO
        //add actions depending on $type
        $this->redirect(array('action' => 'index'));
    }

/**
 * isAuthorized method
 * @return boolean
 *
 * - decides who accesses what
 * - Campaign Managers can only `edit`, `view`, `upload_content`, `profile_setting`, `data_mine` and `submit` campaigns created using their accounts
 * - Administrator can access anything in the app
 */
	public function isAuthorized($user) {

        //debug($this->RequestHandler);
		switch($this->action) {
			case 'index':
			case 'add':
			case 'search':
			//case 'prepare_scheduler':
			case 'file_manipulation_test':
				return true;
			case 'edit':
			case 'view':
			case 'upload_content':
			case 'profile_setting':
			case 'validate_profile_setting':
			case 'data_mine':
			case 'submit':
			case 'validate_for_submit':
				if($this->Campaign->isOwnedBy($this->request->params['pass'][0], $user['user_id']))
					return true;
				$this->Auth->authError = 'You are only allowed to edit your own campaigns.';
				return parent::isAuthorized($user);
			case 'delete':
			case 'toggleApproval':
				$this->Auth->authError = 'You are not allowed to delete campaigns.';
				return parent::isAuthorized($user);
			case 'default':
                return true;
				//return parent::isAuthorized($user);
		}
	}

/**
 * index method
 *
 * @return void
 * - pagination of campaign list
 * - @link https://talktipid.com/acadmin/campaigns - prod server
 *
 * @/campaigns/index
 */
	public function index() {
		//debug($this->Auth->user());
		if($this->Auth->user('role_id') == 2)
		{
			//viewable campaigns will be limited to campaigns created by the logged-in user
			$this->paginate = array(
					'conditions' => array('Campaign.user_id' => $this->Auth->user('user_id'))
				);
		}
		
		$this->Campaign->recursive = 0;
		$this->set('campaigns', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 *
 * - method for displaying Campaign details
 * - accessed as /acadmin/campaigns/view/<campaign_id>
 */
	public function view($id = null) {
        $this->loadModel('Region');
        $this->loadModel('RegionCity');
        $this->loadModel('CampaignLifecycleDescription');
        //debug($this->request->data);

		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}
        $campaign = $this->Campaign->read(null, $id);

        if(!empty($campaign['CampaignSetting'])){
            $_age_setting = json_decode($campaign['CampaignSetting']['age']);
            $_loc_setting = json_decode($campaign['CampaignSetting']['location']);

            if($_age_setting->type == 0){
                $_age_ranges = (array)$_age_setting->data;

                //debug($selected_age_range);
                if(in_array('all_ages', $_age_ranges)){
                    $campaign['CampaignSetting']['age'] = 'All';
                }else{
                    foreach($_age_ranges as $index => $range){
                        $selected_age_range[] = str_replace('_', '-', $range);
                    }
                    $campaign['CampaignSetting']['age'] = implode(', ', $selected_age_range);
                }
            }else{
                $campaign['CampaignSetting']['age'] = $_age_setting->data->age_from . '-' . $_age_setting->data->age_to;
            }

            $region_filter = $_loc_setting->RegionFilter;
            $region_city_filter = $_loc_setting->RegionCityFilter;
            $selected_gender = $campaign['CampaignSetting']['gender'];
            $selected_regions = $_loc_setting->RegionList;
            $selected_cities = $_loc_setting->RegionCityList;
            if(!empty($selected_regions)){
                $selected_regions = $this->Region->find(
                    'list',
                    array(
                        'conditions' => array('Region.region_id' => $selected_regions)
                    )
                );
            }
            if(!empty($selected_cities)){
                $selected_cities = $this->RegionCity->find(
                    'list',
                    array(
                        'conditions' => array('RegionCity.region_city_id' => $selected_cities)
                    )
                );
            }


            //set cities_lgus here
            if($region_filter == 0){
                $campaign['CampaignSetting']['location'] = 'Regions: ' . implode(', ', $selected_regions);
                if($region_city_filter == 0){
                    $campaign['CampaignSetting']['location'] .= "<br/>" . 'Cities/LGUs: ' . implode(', ', $selected_cities);
                }else{
                    if(!empty($selected_cities)){
                        $campaign['CampaignSetting']['location'] .= "<br/>" .
                            'Cities/LGUs: all cities/lgus of ' .
                            implode(', ', $selected_regions) .
                            ' except ' . implode(', ', $selected_cities);
                    }else{
                        $campaign['CampaignSetting']['location'] .= "<br/>" .
                            'Cities/LGUs: include all cities/lgus of ' . implode(', ', $selected_regions);
                    }
                }
            }else{
                if(!empty($selected_regions)){
                    $campaign['CampaignSetting']['location'] = 'Regions: include all except ' . implode(', ', $selected_regions);
                }else{
                    $campaign['CampaignSetting']['location'] = 'Regions: Include all';
                }

                if($region_city_filter == 0){
                    $campaign['CampaignSetting']['location'] .= "<br/>" . 'Cities/LGUs: ' . implode(', ', $selected_cities);
                }else{
                    if(!empty($selected_cities)){
                        $campaign['CampaignSetting']['location'] .= "<br/>" .
                            'Cities/LGUs: Include all ' .
                            ' except ' . implode(', ', $selected_cities);
                    }else{
                        $campaign['CampaignSetting']['location'] .= "<br/>" .
                            'Cities/LGUs: All cities/lgus excluding those under ' . implode(', ', $selected_regions);
                    }
                }

            }
        }else{
            $campaign['CampaignSetting']['age'] = 'not defined yet';
            $campaign['CampaignSetting']['gender'] = 'not defined yet';
            $campaign['CampaignSetting']['location'] = 'not defined yet';
        }

        //debug($campaign['CampaignLifecycle']);
        /*
        $campaign_lifecycle = array();
        foreach($campaign['CampaignLifecycle'] as $cl){
            $campaign_lifecycle[] = $cl['campaign_lifecycle_description_id'];
        }
         */

        //debug($campaign_lifecycle);

		$this->set('campaign', $campaign);
	}

/**
 * add method
 *
 * @return void
 *
 * - method for creating new campaigns
 * - accessed as /acadmin/campaigns/add
 */
	public function add() {
        $this->loadModel('Status'); 
        //debug($this->request->data);

		if ($this->request->is('post')) {
            //$this->request->data['Campaign']['date_added'] = date('Y-m-d H:i:s');
            //$this->request->data['Campaign']['timestamp'] = date('Y-m-d H:i:s');
			$this->Campaign->create();
			$this->request->data['Campaign']['user_id'] = $this->Auth->user('user_id');
			//$this->request->data['Campaign']['client_id'] = '1';
			$this->request->data['Campaign']['status_id'] = '1';
			$this->request->data['Campaign']['start'] = $this->request->data['Campaign']['execution_start'];
			$this->request->data['Campaign']['end'] = $this->request->data['Campaign']['execution_end'];
			//debug($this->request->data);
			if ($this->Campaign->save($this->request->data)) {
				$this->Session->setFlash(__('The campaign has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'error');
			}
		}
		//$clients = $this->Campaign->Client->find('list');
		$users = $this->Campaign->User->find('list');
		$statuses = $this->Status->find('list');
		$this->set(compact('users', 'statuses'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 *
 * - method for modifying campaign details
 * - accessed as /acadmin/edit/<campaign_id>
 */
	public function edit($id = null) {
		//debug($this->request->data);
        $this->loadModel('Status');

		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Campaign']['start'] = $this->request->data['Campaign']['execution_start'];
			$this->request->data['Campaign']['end'] = $this->request->data['Campaign']['execution_end'];

            if($this->request->data['Campaign']['campaign_id'] != $id){
				$this->Session->setFlash(__('Tampered form. Please, try again.'), 'error');
				$this->redirect(array('action' => 'index'));
            }

			if ($this->Campaign->save($this->request->data)) {
				//$this->Session->setFlash(__('The campaign has been saved'));
				$this->Session->setFlash(__('The campaign has been saved'), 'success');
				//$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'));
				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Campaign->read(null, $id);
            $status_id = $this->request->data['Campaign']['status_id'];
            if($status_id > 3){
                $this->Session->setFlash(__("You cannot further edit campaigns in 'ongoing' or 'completed' status."), 'error');
				$this->redirect(array('action' => 'index'));            
            }
			$this->request->data['Campaign']['execution_start'] = $this->request->data['Campaign']['start'];
			$this->request->data['Campaign']['execution_end'] = $this->request->data['Campaign']['end'];
		}
		//$clients = $this->Campaign->Client->find('list');
		$users = $this->Campaign->User->find('list');
		$statuses = $this->Status->find('list');
		$this->set(compact('clients', 'users', 'statuses'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 *
 * - method for deleting campaings
 * - called as a request to POST link /acadmin/campaigns/delete/<campaign_id>
 * - only Administrators have access to this method
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		if ($this->Campaign->delete()) {
			$this->Session->setFlash(__('Campaign deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Campaign was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * toggleApproval method
 *
 * @param string $id
 * @return void
 *
 * - POST link to toggle campaign status from 'pending' to 'approved' and vice-versa
 * - only Administrators have accessed to this method
 */
	public function toggleApproval($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}

        $campaign = $this->Campaign->findByCampaignId($id);
        if($campaign['Campaign']['status_id'] == 2){
            if ($this->Campaign->saveField('status_id', 3)) {
                $this->Session->setFlash(__('Campaign has been approved.'), 'success');
                $this->redirect(array('action' => 'view', $id));
            }
        }

        if($campaign['Campaign']['status_id'] == 3){
            if ($this->Campaign->saveField('status_id', 2)) {
                $this->Session->setFlash(__('Campaign has been reverted back to pending status.'), 'success');
                $this->redirect(array('action' => 'view', $id));
            }
        }

		$this->Session->setFlash(__('Unable to change campaign status.'), 'error');
		$this->redirect(array('action' => 'view', $id));
	}

/**
 * upload_content method
 *
 * @param string $id
 * @return void
 *
 * - method for uploading SMS and Audio contents
 * - accessed as /acadmin/campaigns/upload_content/<campaign_id>
 */
	public function upload_content($id = null) {
		//debug($this->request->data);
        $this->loadModel('Status');
		$audio_desc = null;
		$retain_audio_file = true;
        $campaign_title = null;
		
		$this->Campaign->id = $id;
        $campaign_title = $this->Campaign->field('title');

		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request->data); die;
			//debug($this->request->data); die;
			if($this->request->data['Campaign']['current_audio_ad'] == 0) {
				//debug($this->request->data); die;
				$retain_audio_file = false;
				if($this->request->data['Campaign']['audio_ad']['error'] == 0) {
					$audio_desc = $this->request->data['Campaign']['audio_ad'];
					$this->request->data['Campaign']['audio_ad'] = $this->request->data['Campaign']['audio_ad']['name'];
				} else {
					$this->request->data['Campaign']['audio_ad'] = '';
				}	
			} else {
				//debug($this->Campaign->field('audio_ad')); die;
				$this->request->data['Campaign']['audio_ad'] = $this->Campaign->field('audio_ad');
				//unset($this->request->data['Campaign']['audio_ad']);
				//unset($this->Campaign->validate['audio_ad']);
				//debug($this->request->data); die;
			}
			
			if ($this->Campaign->save($this->request->data)) {
                /* TODO:
                 * check error returned by move_uploaded_file
                 */
				if(!$retain_audio_file) {
					$path = WWW_ROOT . 'audio' . DS . 'CP_' . $id . '_' . $audio_desc['name'];
					move_uploaded_file($audio_desc['tmp_name'], $path);
				}
				
				$this->Session->setFlash(__('Contents have been uploaded.'), 'success');
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data['Campaign']['audio_ad'] = $this->Campaign->field('audio_ad');
				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Campaign->read(null, $id);
            $status_id = $this->request->data['Campaign']['status_id'];
            if($status_id > 3){
                $this->Session->setFlash(__("You cannot further edit campaigns in 'ongoing' or 'completed' status."), 'error');
				$this->redirect(array('action' => 'index'));            
            }

		}

		//$clients = $this->Campaign->Client->find('list');
		$users = $this->Campaign->User->find('list');
		$statuses = $this->Status->find('list');
		$this->set(compact('users', 'statuses','campaign_title'));	
	}
	
/**
 * profile_setting method
 *
 * @param string $id
 * @return void
 *
 * - method for modifying and creating profile parameters of campaigns
 * - accessed as /acadmin/profile_setting/<campaign_id>
 */
	public function profile_setting($id = null) {
		$this->loadModel('Status');
		$this->loadModel('Region');
		$this->loadModel('RegionCity');
		$this->loadModel('CampaignSetting');

        $cities_lgus = null;
        $selected_age_range = null;
        $select_age_active = $specify_age_active = null;
        $disable_age_range_input = true;
        $region_filter = 1;
        $region_city_filter = 1;
        $selected_gender = 'A';
        $selected_regions = $selected_cities = null;
		
		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

            $age_setting = null;
            $loc_setting = null;

            if(array_key_exists('age', $this->request->data['Campaign'])){
                $age_setting = array('type' => 0, 'data' => $this->request->data['Campaign']['age']);
            }else{
                $age_setting = array(
                    'type' => 1,
                    'data' => array(
                        'age_from' => $this->request->data['Campaign']['age_from'],
                        'age_to' => $this->request->data['Campaign']['age_to'],
                    )
                );
            }

            $loc_setting = array(
                'RegionFilter' => $this->request->data['Campaign']['RegionFilter'],
                'RegionList' => $this->request->data['Campaign']['RegionList'],
                'RegionCityFilter' => $this->request->data['Campaign']['RegionCityFilter'],
                'RegionCityList' => $this->request->data['Campaign']['RegionCityList']
            );

            $data = array(
                'campaign_id' => $this->request->data['Campaign']['campaign_id'],
                'age' => json_encode($age_setting),
                'gender' => $this->request->data['Campaign']['gender'],
                'location' => json_encode($loc_setting),
                'filename' => $this->request->data['Campaign']['filename']
            );

            if(array_key_exists('campaign_setting_id', $this->request->data['CampaignSetting'])){
                if(!empty($this->request->data['CampaignSetting']['campaign_setting_id']))
                $data['campaign_setting_id'] = $this->request->data['CampaignSetting']['campaign_setting_id'];
            }

            $this->Campaign->set($this->request->data);
            if($this->Campaign->validates()){
                if($this->CampaignSetting->save(array('CampaignSetting' => $data))){
                    //TODO
                    //enable below for production
                    /*
                    $email = new CakeEmail('smtp');
                    $email->from(array('jervy.escoto@gmail.com' => 'AdCall CMT'))
                        ->to('jervy.escoto@gmail.com')
                        ->subject('New Campaign has been sent for approval')
                        ->send('My message');
                     */

                    if($this->save_targetsub_file($id, null, false, true, $data['filename'])){
                        $this->Session->setFlash(__('Campaign has been updated.'), 'success');
                    }else{
                        $this->Session->setFlash(
                            __('Campaign profile setting has been saved but the file generation has failed. Please try again.'),
                            'error'
                        );
                    }

                    $this->redirect(array('action' => 'profile_setting', $id));
                }else{
                    $this->Session->setFlash(__('The campaign could not be saved.'), 'error');
                }
            }else{
                    $this->Session->setFlash(__('The campaign could not be saved.'), 'error');
                    $this->redirect(array('action' => 'profile_setting', $id));
            }
            /*
			if ($this->Campaign->save($this->request->data)) {
				$this->Session->setFlash(__('Campaign has been updated.'), 'success');
				$this->redirect(array('action' => 'index'));
                //TODO
                //manually set campaign location and age array to be saved to CampaignAgeRange and CampaignLocation models
                //if CampaignLocation->save and CampaignAgeRange
                //redirect
                //else
                //flash
			} else {
                //debug($this->data);
                if(array_key_exists('age', $this->request->data['Campaign'])){
                    if(!empty($this->request->data['Campaign']['age'])){
                        foreach($this->request->data['Campaign']['age'] as $index => $value){
                            $this->request->data['CampaignAgeRange'][$index]['type'] = 0;
                            $age_range = explode('_', $value);
                            $this->request->data['CampaignAgeRange'][$index]['low'] = $age_range[0];
                            $this->request->data['CampaignAgeRange'][$index]['high'] = $age_range[1];
                        }
                    }
                }else{
                    $this->request->data['CampaignAgeRange'][0]['type'] = 1;
                    $this->request->data['CampaignAgeRange'][0]['low'] = $this->request->data['Campaign']['age_from'];
                    $this->request->data['CampaignAgeRange'][0]['high'] = $this->request->data['Campaign']['age_to'];
                }

                if($this->request->data['Campaign']['RegionFilter'] == 0){
                    if(!empty($this->request->data['Campaign']['RegionList'])){
                        $cities_lgus = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array('RegionCity.region_id' => $this->request->data['Campaign']['RegionList'])
                            )
                        );
                    }
                }else{
                     if(!empty($this->request->data['Campaign']['RegionList'])){
                        $cities_lgus = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array(
                                    'NOT' => array(
                                        'RegionCity.region_id' => $this->request->data['Campaign']['RegionList']
                                    )
                                )
                            )
                        );
                    }
                }

				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'error');
                //TODO
                //manually set arrays for campaign_age_range and campaign_location to be populated in view fields
			}
             */
		} else {
			$this->request->data = $this->Campaign->read(null, $id);
            $status_id = $this->request->data['Campaign']['status_id'];
            if($status_id > 3){
                $this->Session->setFlash(__("You cannot further edit campaigns in 'ongoing' or 'completed' status."), 'error');
				$this->redirect(array('action' => 'index'));            
            }

            //debug($this->request->data);
            if(!empty($this->request->data['CampaignSetting'])){
                $_age_setting = json_decode($this->request->data['CampaignSetting']['age']);
                $_loc_setting = json_decode($this->request->data['CampaignSetting']['location']);
                //debug($_loc_setting);

                if($_age_setting->type == 0){
                    $_age_ranges = $_age_setting->data;
                    foreach($_age_ranges as $index => $range){
                        $selected_age_range[] = $range;
                    }
                    $select_age_active = 'active';
                }else{
                    $this->request->data['Campaign']['age_from'] = $_age_setting->data->age_from;
                    $this->request->data['Campaign']['age_to'] = $_age_setting->data->age_to;
                    //debug($_age_setting);
                    $specify_age_active = 'active';
                    $disable_age_range_input = true;
                }

                $region_filter = $_loc_setting->RegionFilter;
                $region_city_filter = $_loc_setting->RegionCityFilter;
                $selected_gender = $this->request->data['CampaignSetting']['gender'];
                $selected_regions = $_loc_setting->RegionList;
                $selected_cities = $_loc_setting->RegionCityList;

                //set cities_lgus here
                if($region_filter == 0){
                    if(!empty($selected_regions)){
                        $cities_lgus = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array('RegionCity.region_id' => $selected_regions)
                            )
                        );
                    }
                }else{
                     if(!empty($selected_regions)){
                        $cities_lgus = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array(
                                    'NOT' => array(
                                        'RegionCity.region_id' => $selected_regions
                                    )
                                )
                            )
                        );
                    }
                }
            }else{
                $select_age_active = 'active';
            }
		}

        //debug($this->data);

        $regions = $this->Region->find('list');
        if(is_null($cities_lgus))
            $cities_lgus = $this->RegionCity->find('list');

		//$clients = $this->Campaign->Client->find('list');
		$users = $this->Campaign->User->find('list');
		$statuses = $this->Status->find('list');
        $this->set(
            compact(
                'clients',
                'users',
                'statuses',
                'regions',
                'cities_lgus',
                'selected_age_range',
                'select_age_active',
                'specify_age_active',
                'disable_age_range_input',
                'region_filter',
                'region_city_filter',
                'selected_gender',
                'selected_regions',
                'selected_cities'
            )
        );	
	}


    public function test_ajax($id = null){
		$this->loadModel('Location');
		$this->loadModel('Region');

        $locations = $this->Location->find('list');
        $this->set(compact('locations'));
    }

    public function validate_profile_setting(){
        if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }else{
            //ajax-request handling
            if($this->RequestHandler->isAjax()){
                Configure::write('debug', 0);
                $this->autoRender = false;
                header('Content-type: application/json');
                //echo json_encode($this->request->params);
                $this->Campaign->set($this->data);
                if($this->Campaign->validates()){
                    return true;
                }else{
                    return json_encode($this->Campaign->validationErrors);
                }
            }else{
            
            }
        }
    }

    public function data_mine(){
        $this->loadModel('RegionCity');
        $this->loadModel('Region');
        $this->loadModel('Subscriber');

         if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }else{
            //ajax-request handling
            if($this->RequestHandler->isAjax()){
                Configure::write('debug', 0);
                $this->autoRender = false;
                header('Content-type: application/json');

                $ages_param = isset($this->data['Campaign']['age']) ? $this->data['Campaign']['age'] : null;
                $gender_param = $this->data['Campaign']['gender'];
                $region_filter_param = $this->data['Campaign']['RegionFilter'];
                $region_city_filter_param = $this->data['Campaign']['RegionCityFilter'];
                $region_list_param = $this->data['Campaign']['RegionList'];
                $region_city_list_param = $this->data['Campaign']['RegionCityList'];

                $conditions = array();
                $regions = null;

                /*
                error_log(json_encode($ages_param));
                error_log(json_encode($gender_param));
                error_log(json_encode($region_filter_param));
                error_log(json_encode($region_city_filter_param));
                error_log(json_encode($region_list_param));
                error_log(json_encode($region_city_list_param));
                 */
                if(empty($ages_param) || is_null($ages_param)){
                    $conditions['AND'][] = array(
                        'Subscriber.age between ? and ? ' => array(
                                $this->data['Campaign']['age_from'],
                                $this->data['Campaign']['age_to']
                            )
                    );
                }else{
                    if(!in_array('all_ages', $ages_param)){
                        foreach($ages_param as $index => $ages){
                            $ages = explode('_', $ages);
                            if(strcmp($ages[1], 'up') == 0)
                                $ages[1] = '1000';
                            $conditions['OR'][] = array('Subscriber.age between ? and ? ' => array($ages[0], $ages[1]));
                        }
                    }
                }

                if(strcmp($gender_param, 'A') != 0){
                    $conditions['AND'][] = array('Subscriber.gender' => $gender_param);
                }

                if($region_filter_param == 0){
                    $regions = $this->data['Campaign']['RegionList'];
                }else{
                    $regions = $this->Region->find(
                        'list',
                        array(
                            'conditions' => array(
                                'NOT' => array(
                                    'Region.region_id' => $this->data['Campaign']['RegionList']
                                )
                            )
                        )
                    );
                    $regions = array_keys($regions);
                }

                if($region_city_filter_param == 0){
                    $region_cities = $this->data['Campaign']['RegionCityList'];
                }else{
                    $region_cities = $this->RegionCity->find(
                        'list',
                        array(
                            'conditions' => array(
                                'NOT' => array(
                                    'RegionCity.region_city_id' => $region_city_list_param,
                                ),
                                'AND' => array(
                                    'RegionCity.region_id' => $regions
                                )
                            )
                        )
                    );
                    $region_cities = array_keys($region_cities);
                }

                $conditions['AND'][] = array('Subscriber.region_city_id' => $region_cities);

                /*
                $count = $this->Subscriber->find(
                    'count',
                    array(
                        'conditions' => $conditions
                    )
                );
                 */

                $targetsubs = $this->Subscriber->find(
                    'list',
                    array(
                        'conditions' => $conditions
                    )
                );

                if($this->save_targetsub_file($this->data['Campaign']['campaign_id'], $targetsubs, true)){
                    $response['success'] = true;
                    $response['count'] = count($targetsubs);
                    $response['text'] = count($targetsubs) . ' records found.';
                }else{
                    $response['sucess'] = false;
                }

                //error_log(serialize($this->Subscriber->getDataSource()->getLog(false, false)));
                //echo(json_encode($count));
               //error_log($count);
                usleep(1500000);
                return json_encode($response);
            }else{
            
            }
        }
    }

/**
 * submit method
 *
 * @param $id
 * @return void
 *
 * - method for submitting campaigns for approval
 * - simply modify campaign status from 'incomplete' to 'pending'
 * @TODO create email sender that will notify Admins using their registered email accounts
 * 
 */

    public function submit($id = null){
        $this->loadModel('CampaignSetting');

        $this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}

        $campaign = $this->Campaign->read(null, $id);

        if($this->request->is('put') || $this->request->is('post')){
            //debug($this->request->data);
            $this->Campaign->set($this->request->data);
            $this->CampaignSetting->set($this->request->data);

            $error = false;
            if(!$this->Campaign->validates()){
                debug('campaign error');
                $error = true;
            }
            if(!$this->CampaignSetting->validates()){
                debug('campaign setting error');
                $error = true;
            }

            if($error){
				$this->Session->setFlash(__('Unable to submit for approval. Please populate necessary fields.'), 'error');
            }else{
                if($this->Campaign->saveField('status_id', 2)){
				    $this->Session->setFlash(__('Campaign has been sent for approval.'), 'success');
			        $this->redirect(array('action' => 'index'));	
                }
                //$this->Campaign->field()
            }

        }else{
            $this->request->data = $this->Campaign->read(null, $id);
            $status_id = $this->request->data['Campaign']['status_id'];
            if($status_id > 3){
                $this->Session->setFlash(__("You cannot further edit campaigns in 'ongoing' or 'completed' status."), 'error');
				$this->redirect(array('action' => 'index'));            
            }

            if(empty($this->request->data['Campaign']['sms_alert']) ||
               empty($this->request->data['Campaign']['sms_ad']) ||
               empty($this->request->data['Campaign']['audio_ad'])){
                $this->Session->setFlash(__('Please upload contents first.'), 'error');
                $this->redirect(array('action' => 'upload_content', $id));
            }
            if(empty($this->request->data['CampaignSetting'])){
                $this->Session->setFlash(__('Please complete profile setting first.'), 'error');
                $this->redirect(array('action' => 'profile_setting', $id));
            }
        }
        $this->set('campaign', $campaign);
    }


    public function validate_for_submit($id = null){
        if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }else{
            if(!$id){
                //TODO
                //error-handling here
            }
            $this->loadModel('CampaignSetting');
            //ajax-request handling
            if($this->RequestHandler->isAjax()){
                Configure::write('debug', 0);
                $this->autoRender = false;
                header('Content-type: application/json');

                $result = array('status' => 'success', 'data' => null);

                $campaign = $this->Campaign->read($null, $id);
                if(!$campaign){
                    $result['status'] = 'error';
                    $result['data'] = 'probably a tampered form.';
                    return json_encode($result);
                }

                $campaign = array();
                $campaign['Campaign'] = $this->data['Campaign'];
                //for testing
                //$campaign['Campaign']['audio_ad'] = '';
                $this->Campaign->set($campaign);
                error_log(serialize($campaign));
                $this->CampaignSetting->set($this->data['CampaignSetting']);
                error_log('c: ' . $this->Campaign->validates());
                error_log('cs: ' . $this->CampaignSetting->validates());
                //error_log(serialize($this->data));
                return;
            }
        }
    }

/**
 * search method
 *
 * @param null
 * @return json_encoded(data)
 *
 * - search method called in /acadmin/campaigns/index
 * - returns paged results
 * - accessed as POST $.ajax({url: '/acadmin/campaigns/search/q=<term>&page_limit=<limit>&page=<page>'}) in js/campaigns_index.js
 */
    public function search(){
        if($this->RequestHandler->isAjax()){
            $role_id = $this->Auth->user('role_id');
            $user_id = $this->Auth->user('user_id');

            $result = array();
            $term = $this->request->query['q'];
            $page_limit = $this->request->query['page_limit'];
            $page = --$this->request->query['page'];
            $limit = $page*$page_limit . ', ' . $page_limit;

            $this->Campaign->recursive = -1;
            if($role_id == 2){
                //limit search relative to logged-in user's campaign list
                $conditions = array(
                    'AND' => array(
                        'Campaign.user_id' => $user_id,
                        'Campaign.title like' => "%{$term}%"
                    )
                );
            }else{
                $conditions = array('Campaign.title like' => "%{$term}%");
            }

            $total = $this->Campaign->find(
                'count',
                array(
                    //'conditions' => array('Campaign.title like' => "%{$term}%"),
                    'conditions' => $conditions,
                )
            );

            $campaigns = $this->Campaign->find(
                'all',
                array(
                    'contain' => false,
                    //'conditions' => array('Campaign.title like' => "%{$term}%"),
                    'conditions' => $conditions,
                    'fields' => array('Campaign.campaign_id as id', 'Campaign.title as text'),
                    'limit' => $limit
                )
            );

            $ctr = 0;

            if(empty($campaigns)){
                $result['campaigns'] = '';
            }else{
                 foreach($campaigns as $campaign){
                    $result['campaigns'][$ctr++] = $campaign['Campaign'];
                }
            }

            $result['total'] = $total;
            echo json_encode($result);
            $this->autoRender = false;
        }else{
			throw new MethodNotAllowedException();
        }
    }


    private function save_targetsub_file($campaign_id = null, $data = null, $temp_write = true, $rename = false, $filename){
        //$directory = '/var/www/AdCall.backend/files/targetsubs/';
        $directory = WWW_ROOT . 'files/targetsubs/';
        error_log($directory);
        $temp_filename = 'campaign' . $campaign_id . '_' . 'targetsubs_tempfile';
        $rename_prepend = 'campaign' . $campaign_id . '_';

        if($temp_write){
            $current_file = new File($directory . $temp_filename);
            if($current_file->exists()){
                if(!empty($data) || count($data) > 0){
                    $current_file->write(implode("\n", $data));
                }
                $current_file->close();
                return true;
            }else{
                $file = new File($directory . $temp_filename, true, 0644);
                if($file->exists()){
                    if(!empty($data) || count($data) > 0){
                        $file->write(implode("\n", $data));
                    }
                    $file->close();
                    return true;
                }
                return false;
            }
        }else{
            //TODO
            //actual copying of contents from temp file to new file isn't working yet
            if($filename){
                $file = new File($directory . File::safe($rename_prepend . $filename, 'mins'));
                $temp_file = new File($directory . $temp_filename);

                if(!$temp_file->exists()){
                    $temp_file->close();
                    return false;
                }

                if($file->exists()){
                    $temp_file->copy($file->name(), true);
                    $temp_file->close();
                    $file->close();
                    return true;
                }else{
                    $new_file = new File($directory . File::safe($rename_prepend . $filename, 'mins'), true, 0644);
                    $temp_file->copy($new_file->name(), true);
                    $temp_file->close();
                    $new_file->close();
                    return true;
                }
                return false;
            }

            return false;
        }

        $this->autoRender = false;
    }

/**
 * prepare_scheduler method
 *
 * @param null
 * @return json_encoded(data)
 */
/*
    public function prepare_scheduler(){
        if($this->RequestHandler->isAjax()){
            echo 'test';
        }else{
            throw new MethodNotAllowedException();
        }
    }
 */
}
