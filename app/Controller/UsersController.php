<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * - class for adding and modifying user accounts
 * @property User $User
 */
class UsersController extends AppController {
    public $components = array(
        'Security',
        'RequestHandler',
    );
    public $helpers = array('Js');
    public $paginate = array('limit' => 5);
/**
 * 
 */
	public function beforeFilter() {
		$this->Auth->allow('logout','login','register');
        //$this->Security->csrfCheck = false;
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
 *
 * @return boolean
 *
 * - defines who can access what
 * - Admins have access to add, delete, view, edit, change password, search user methods
 * - Campaign Managers can only view, edit, and change password for their own accounts
 */
	public function isAuthorized($user) {
		//$this->Auth->authError = serialize($user);
		switch($this->action) {
			case 'index':
				return true;
			case 'add':
			case 'delete':
			case 'toggleActive':
			case 'search':
				return parent::isAuthorized($user);
				break;	
			case 'change_password':
			case 'edit':
				if($this->User->isOwnedBy($this->request->params['pass'][0], $user['user_id']))
					return true;
				return parent::isAuthorized($user);
				break;
			case 'view':
				$this->Auth->authError = 'You are only allowed to view your own profile.';
				if($this->User->isOwnedBy($this->request->params['pass'][0], $user['user_id']))
					return true;
				return parent::isAuthorized($user);
				break;
			default:
				return parent::isAuthorized($user);
				break;
		}
		/**
		if($this->action === 'add')
			return parent::isAuthorized($user);
		
		return true;
		*/
	}

/**
 * index method
 *
 * @return void
 *
 * - pagination of users list
 * - accessed as /acadmin/users/index
 */
	public function index() {
        $this->loadModel('Role');
		$this->User->recursive = 0;
		
		if(!is_null($this->Auth->user()))
		{
			//debug($this->Auth->user('role_id'));
			if($this->Auth->user('role_id') == 1)
			{
				$this->set('users', $this->paginate());
			}
			else
			{
				$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('user_id')));
			}
		}
		else
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}
	
/**
 * login method
 * 
 * @return void
 *
 * - method for user login
 * - used the default login function of Auth component
 */
	public function login() {
		//debug($this->request->data);
		if ($this->request->is('post')){
			if($this->Auth->login())
			{
				$this->redirect($this->Auth->redirect());
				//$this->redirect(array('controller' => 'users', 'action' => 'index'));
				//$this->redirect(array('controller' => 'replies', 'action' => 'view/Category/1'));
				//$this->flash('Login successful. Redirecting.', array('controller' => 'replies', 'action' => 'view/Category/1'), 2, 'flash');
			}
			else
			{
                //TODO add check if active here
				$this->Session->setFlash(__('Invalid username/password'), 'error');
			}
        }else{
            if($this->Auth->user()){
                $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
            }
        }
	}
	
/**
 * logout method
 * 
 * @return void
 *
 * - method for logout
 * - used the default logout method of Auth component
 */
	public function logout() {
		//debug($this);
		$this->redirect($this->Auth->logout());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 *
 * - method for fetching and passing user data to View files
 */
	public function view($id = null) {
		//debug($this->Auth->user());
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
 * - method for adding new user account
 * - accessed as /acadmin/users/add
 */
	public function add() {
        $this->loadModel('Role');
        $this->loadModel('UserDetail');

		if ($this->request->is('post')) {
            debug($this->request->data);
            if($this->User->saveAll($this->request->data, array('validates' => 'only')))
            {
                $this->Session->setFlash(__('The user has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
            /**
            //$this->User->save($this->request->data);
            //$this->UserDetail->save($this->request->data);
            //$this->request->data['UserDetail']['user_id'] = $this->request->data['User']
			$this->User->create();
            //$this->request->data['UserDetail']['user_id'] = 0;
            $this->UserDetail->set($this->request->data);
            $this->UserDetail->validates();
			if ($this->User->save($this->request->data)) {
                $this->request->data['UserDetail']['user_id'] = $this->User->getLastInsertID();
                $this->UserDetail->save($this->request->data);
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
             */
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
 *
 * - method to edit user details
 */
	public function edit($id = null) {
		//debug($this->Auth->user());
        //debug($this->request->data);
        $this->loadModel('Role');
        $this->loadModel('UserDetail');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            debug($this->request->data);
            if($this->User->saveAll($this->request->data, array('validates' => 'only')))
            {
                $this->Session->setFlash(__('The user has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
			/**
			debug($this->request->data);
			exit;
			if ($this->User->save($this->request->data)) {
                //request->data has index ['UserDetail']['user_detail_id'] as identifier for the save method that it will update the record
                $this->UserDetail->set($this->request->data);
                $this->UserDetail->validates();
                //$this->UserDetail->save($this->request->data);
				$this->Session->setFlash(__('The user has been saved'));
				//$this->Session->setFlash(__(serialize($this->request->data)));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
			*/
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
 *
 * - accessed as POST link /acadmin/users/delete/<user_id>
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

/**
 * register method
 *
 * @return void
 *
 * - method for registration
 * - accessed as /acadmin/users/register
 */
    public function register() {
        $this->loadModel('UserDetail');

		if ($this->request->is('post') || $this->request->is('put')) {
            if($this->User->saveAll($this->request->data, array('validates' => 'only')))
            {
                $this->Session->setFlash(__('Profile has been saved. Please wait for your account to be activated.'), 'success');
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Unable to save details. Please, try again.'), 'error');
            }
		} else {
            if($this->Auth->user()){
                $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
            }
		}



    }
    
/**
 * changePassword method
 *
 * @return void
 *
 * - method to change password
 * - Admin can change password of all of the user accounts
 */
    public function change_password($id = null) {
    	//debug($this->request->data);
    	//debug($this->Auth->user());
        
    	$this->User->recursive = -1;
    	
		$this->User->id = $id;
		//$this->set('user', $this->User->read(null, $id));
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
            $is_valid = false;
            //debug($this->request->data);
            $this->User->set($this->request->data);

            if($this->Auth->user('role_id') == 1)
                $is_valid = $this->User->validates(array('fieldList' => array('new_password', 'confirm_new_password')));

            if($this->Auth->user('role_id') == 2){
                $is_valid = $this->User->validates(array('fieldList' => array('current_password','new_password', 'confirm_new_password')));
            }

            if($is_valid){
                if($this->User->saveField('password', $this->request->data['User']['new_password'])){
				    $this->Session->setFlash(__('Password has been changed successfully.'), 'success');
                }else{
				    $this->Session->setFlash(__('Unable to change password. Please, try again.'), 'error');
                }
				//$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Unable to change password. Please, try again.'), 'error');
			}

            unset($this->request->data['User']['current_password']);
            unset($this->request->data['User']['new_password']);
            unset($this->request->data['User']['confirm_new_password']);

			/**
			if($this->User->saveAll($this->request->data, array('validates' => 'only')))
			{
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
			*/
			//$this->User->validates();
			//if($this->User->saveField('password', $this->request->data['User']['new_password'], $validate = true)) {
			
			//$this->request->data['User']['password'] = $this->request->data['User']['new_password'];
			//if($this->User->save($this->request->data)) {
			//$this->User->set($this->request->data);
			//$is_valid = $this->User->validates(array('fieldList' => array('new_password', 'confirm_new_password')));
            /*
			if($this->User->validates()) {
				if($this->User->saveField('password', $this->request->data['User']['new_password']))
				{
					$this->Session->setFlash(__('Password saved.'));
					$this->redirect(array('action' => 'index'));	
				}
				else
				{
					$this->Session->setFlash(__('Unable to change password. Please try again.'));
				}
			}
			else {
				$this->Session->setFlash(__('Unable to change password. Please try again.'));
			}
             */
		} else {
			$user = $this->User->read(null, $id);
			$this->request->data = $user;
			$this->set('user', $user);
		}
    }
    
/**
 * toggleActive method
 *
 * @return void
 * 
 *
 * - method to change password
 * - accessed as POST link /acadmin/users/toggleActive/<user_id>/<flag>
 *    - user_id as user's id from users table
 *    - flag as either 0 or 1
 *       - 0 to deactivate
 *       - 1 to activate
 */

    public function toggleActive($id = null, $flag = null) {
 		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		$action = ($flag == 0)  ? 'deactivated.' : 'activated.';
		
		if($this->User->saveField('active', $flag))
		{
			$this->Session->setFlash(__('User has been ' . $action), 'success');
			$this->redirect(array('action' => 'index'));	
        }else{
		    $this->Session->setFlash(__('Unable to activate/deactivate user.'),'error');
		    $this->redirect(array('action' => 'index'));
        }
    }

/**
 * search method
 *
 * @param null
 * @return json_encoded(data)
 *
 * - search method called in /acadmin/users/index
 * - returns paged results
 * - accessed as POST $.ajax({url: '/acadmin/users/search/q=<term>&page_limit=<limit>&page=<page>'}) in js/users_index.js
 */


    public function search(){
        if($this->RequestHandler->isAjax()){
            $result = array();
            //echo json_encode($this->request->query);
            $term = $this->request->query['q'];
            $page_limit = $this->request->query['page_limit'];
            $page = --$this->request->query['page'];
            //echo $term;
            //echo $page_limit;
            $limit = $page*$page_limit . ', ' . $page_limit;

            //$result['subscribers'] = $this->Location->find('list');
            $this->User->recursive = -1;

            $total = $this->User->find(
                'count',
                array(
                    'conditions' => array(
                        'OR' => array(
                            'User.username like' => "%{$term}%",
                            'User.email like' => "%{$term}%",
                        )
                    )
                )
            );

            $users = $this->User->find(
                'all',
                array(
                    'contain' => false,
                    'conditions' => array(
                        'OR' => array(
                            'User.username like' => "%{$term}%",
                            'User.email like' => "%{$term}%",
                        )
                    ),
                    'fields' => array('User.user_id as id', 'User.username as text'),
                    'limit' => $limit
                )
            );
            $ctr = 0;

            if(empty($users)){
                $result['users'] = '';
            }else{
                 foreach($users as $user){
                    $result['users'][$ctr++] = $user['User'];
                }
            }

            $result['total'] = $total;
            echo json_encode($result);
            $this->autoRender = false;
        }else{
			throw new MethodNotAllowedException();
        }   
    }
    
    /**
    public function initDB() {
    	$role = $this->User->Role;
    	$role->id = 1;
    	$this->Acl->allow($role, 'controllers');
    	
    	$role->id = 2;
    	$this->Acl->deny($role, 'controllers');
    	$this->Acl->allow($role, 'controllers/Campaigns');
    	$this->Acl->allow($role, 'controllers/Users/edit');
    	$this->Acl->allow($role, 'controllers/Users/view');
    	exit;
    }
    */
}


