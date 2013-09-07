<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $this->loadModel('Role');
        $this->loadModel('UserDetail');

		if ($this->request->is('post')) {
            //$this->User->save($this->request->data);
            //$this->UserDetail->save($this->request->data);
            //$this->request->data['UserDetail']['user_id'] = $this->request->data['User']
			$this->User->create();
			if ($this->User->save($this->request->data)) {
                $this->request->data['UserDetail']['user_id'] = $this->User->getLastInsertID();
                $this->UserDetail->save($this->request->data);
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}

        $options['order'] = array("role_id" => "desc");
        $roles = $this->Role->find('list', $options);
        $this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->loadModel('Role');
        $this->loadModel('UserDetail');


        var_dump($this->request->data);
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
                //request->data has index ['UserDetail']['user_detail_id'] as identifier for the save method that it will update the record
                $this->UserDetail->save($this->request->data);
				$this->Session->setFlash(__('The user has been saved'));
				//$this->Session->setFlash(__(serialize($this->request->data)));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}

        $roles = $this->Role->find('list');
        $this->set(compact('roles'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
