<?php
App::uses('AppController', 'Controller');
/**
 * Regions Controller
 *
 * @property Region $Region
 */
class RegionsController extends AppController {
    //always include RequestHandler component for dynamic pagination to work
    public $components = array('RequestHandler');
    public $helpers = array(
        'Js',
    );
    public $paginate = array(
        'limit' => 5
    );

/**
 * isAuthorized method
 *
 * @return boolean 
 */
	public function isAuthorized($user) {
		//debug($user);
		return parent::isAuthorized($user);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Region->recursive = 0;
		$this->set('regions', $this->paginate());
        if($this->RequestHandler->isAjax()){
            //return;
        }
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		$this->set('region', $this->Region->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Region->create();
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('The region has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region could not be saved. Please, try again.'), 'error');
			}
		}
		$locations = $this->Region->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('The region has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Region->read(null, $id);
		}

		$locations = $this->Region->Location->find('list');
		$this->set(compact('locations'));

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
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		if ($this->Region->delete()) {
			$this->Session->setFlash(__('Region deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Region was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function ajax_get_list($id = null){
        error_log(serialize($this->request->data));
    }
}
