<?php
App::uses('AppController', 'Controller');
/**
 * RegionCities Controller
 *
 * @property RegionCity $RegionCity
 */
class RegionCitiesController extends AppController {
    public $components = array('RequestHandler');
    public $helpers = array('Js');
    public $paginate = array('limit' => 5);
/**
 * isAuthorized method
 *
 * @return boolean 
 */
	public function isAuthorized($user) {
		//debug($user);
        switch($this->action) {
			case 'index':
			case 'add':
			case 'delete':
				return parent::isAuthorized($user);
				break;	
			case 'get_cities':
                return true;
			default:
				return parent::isAuthorized($user);
				break;
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RegionCity->recursive = 0;
		$this->set('regionCities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->RegionCity->id = $id;
		if (!$this->RegionCity->exists()) {
			throw new NotFoundException(__('Invalid region city'));
		}
		$this->set('regionCity', $this->RegionCity->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		//debug($this->request->data);
		if ($this->request->is('post')) {
		//die;
			//$this->RegionCity->set($this->request->data);
			$region_id = $this->request->data['RegionCity']['region_id'];
			unset($this->request->data['RegionCity']['region_id']);
			foreach($this->request->data['RegionCity'] as $key => $value) {
				//debug($key);
				$this->request->data['RegionCity'][$key]['region_id'] = $region_id;
			}
			//debug($this->request->data);
			$this->request->data['RegionCity']['0']['region_id'] = $region_id;
			$this->RegionCity->create();
			
			if ($this->RegionCity->saveAll($this->request->data['RegionCity'])) {
				$this->Session->setFlash(__('The region city has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data['RegionCity']['region_id'] = $region_id;
				$this->Session->setFlash(__('The region city could not be saved. Please, try again.'), 'error');
			}		
		//debug($this->request->data);
		/**
			$this->RegionCity->create();
			if ($this->RegionCity->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The region city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region city could not be saved. Please, try again.'));
			}
			*/
		}
		$regions = $this->RegionCity->Region->find('list');
		$this->set(compact('regions'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->RegionCity->id = $id;
		if (!$this->RegionCity->exists()) {
			throw new NotFoundException(__('Invalid region city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegionCity->save($this->request->data)) {
				$this->Session->setFlash(__('The region city has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region city could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->RegionCity->read(null, $id);
		}
		$regions = $this->RegionCity->Region->find('list');
		$this->set(compact('regions'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->RegionCity->id = $id;
		if (!$this->RegionCity->exists()) {
			throw new NotFoundException(__('Invalid region city'));
		}
		if ($this->RegionCity->delete()) {
			$this->Session->setFlash(__('Region city deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Region city was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

/**
 * get_cities
 *
 * @param post_data
 * @return json_encoded array
 */

    public function get_cities(){
        $this->loadModel('Region');

        if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }else{
            //ajax-request handling
            if($this->RequestHandler->isAjax()){
                Configure::write('debug', 0);
                $this->autoRender = false;
                header('Content-type: application/json');

                //error_log(serialize($this->data));

                if(is_null($this->data['Campaign'])){
                    if($this->data['filter'] == 0){
                        return;
                    }else{
                        $region_cities = $this->RegionCity->find('list');
                        echo json_encode($region_cities);
                    }
                }else{
                    $filter = $this->data['filter'];
                    if($filter == 0){
                        $regions = $this->data['Campaign']['RegionList'];
                        $region_cities = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array('RegionCity.region_id' => $regions),
                            )
                        );
                        echo json_encode($region_cities);
                    }else{
                        $exclude_regions = $this->data['Campaign']['RegionList'];

                        $region_cities = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array(
                                    'NOT' => array(
                                        'RegionCity.region_id' => $exclude_regions
                                    )
                                )
                            )
                        );

                        /*
                        $region_cities = $this->RegionCity->find(
                            'list',
                            array(
                                'conditions' => array(
                                    'NOT' => array(
                                        'RegionCity.region_id' => $exclude_regions
                                    ),
                                    'AND' => array(
                                        'RegionCity.region_id' => array_keys($include_regions)
                                    )
                                )
                            )
                        );
                         */

                        echo json_encode($region_cities);
                    }
                }
            }else{
            
            }
        }
    }
}
