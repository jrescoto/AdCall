<?php
App::uses('AppController', 'Controller');
/**
 * SubscriberDetails Controller
 *
 * @property SubscriberDetail $SubscriberDetail
 */
class SubscriberDetailsController extends AppController {
    public $helpers = array('Js');
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
		$this->SubscriberDetail->recursive = 0;
		$this->set('subscriberDetails', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SubscriberDetail->id = $id;
		if (!$this->SubscriberDetail->exists()) {
			throw new NotFoundException(__('Invalid subscriber detail'));
		}
		$this->set('subscriberDetail', $this->SubscriberDetail->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SubscriberDetail->create();
			if ($this->SubscriberDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber detail could not be saved. Please, try again.'));
			}
		}
		$subscribers = $this->SubscriberDetail->Subscriber->find('list');
		$regions = $this->SubscriberDetail->Region->find('list');
		$regionCities = $this->SubscriberDetail->RegionCity->find('list');
		$this->set(compact('subscribers', 'regions', 'regionCities'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SubscriberDetail->id = $id;
		if (!$this->SubscriberDetail->exists()) {
			throw new NotFoundException(__('Invalid subscriber detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SubscriberDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber detail could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SubscriberDetail->read(null, $id);
		}
		$subscribers = $this->SubscriberDetail->Subscriber->find('list');
		$regions = $this->SubscriberDetail->Region->find('list');
		$regionCities = $this->SubscriberDetail->RegionCity->find('list');
		$this->set(compact('subscribers', 'regions', 'regionCities'));
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
		$this->SubscriberDetail->id = $id;
		if (!$this->SubscriberDetail->exists()) {
			throw new NotFoundException(__('Invalid subscriber detail'));
		}
		if ($this->SubscriberDetail->delete()) {
			$this->Session->setFlash(__('Subscriber detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Subscriber detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
