<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        //'Acl',
        'Session',
    	//'Auth',
    	'DebugKit.Toolbar',
        //'Security'
        'Auth' => array(
            'loginRedirect' => array('controller'=>'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller'=>'users', 'action' => 'login'),
            'authError' => 'You are not authorized to access that page.',
            //'authError' => 'Unable to display content.',
            //'authorize' => array('Controller')
        	//below, if applied, will work to all actions in all controllers
            'authorize' => array(
            	//'Actions' => array('actionPath' => 'controllers/'),
            	'Controller'
            ),
            //'authenticate' => array(
            //)
        ),
    );
    
    /*public $helpers = array(
    	'Chosen.Chosen',
    );*/

/**
 * isAuthorized method
 * @return boolean
 *
 * - parent isAuthorized method
 * 
 */

    public function isAuthorized($user) {
    	//admin is authorized to access all actions and parts of the application
        //error_log('parent isauth ' . serialize($this->request->params));
    	if(isset($user['role_id']) && $user['role_id'] == 1)
    		return true;
    	return false;
    }

/**
 * beforeFilter method
 * @return void
 *
 * - parent beforeFilter method
 * - sets additional parameters in Auth component (scope as User.active)
 *    - users with active = 0 will not be able to login
 * - sets value to logged_in and current_user variables accessible in all View files
 * 
 */


    
    public function beforeFilter() {
        /*
        //$this->Auth->allow('logout', 'login');
    	$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    	//$this->Auth->loginRedirect = array('controller' => 'pages', 'display' => 'home');
    	//$this->Auth->loginRedirect = array('controller' => 'dashboard', 'display' => 'index');
        
    	$this->Auth->logoutRedirect = '/';
    	//$this->Auth->logoutRedirect = array('controller' => 'users', 'actions' => 'login');
    	//$this->Auth->authorize = 'controller';
    	$this->Auth->authorize = array('Controller');
    	$this->Auth->userScope = array('User.active' => 1);
         */

        $this->Auth->authenticate = array(
            AuthComponent::ALL => array(
                'userModel' => 'User',
                'scope' => array('User.active' => 1),
            ),
                'Form'
        );

        //$this->Security->blackHoleCallback = 'blackhole';

        $this->set('logged_in', $this->Auth->loggedIn());
        $this->set('current_user', $this->Auth->user());

    }

    /*
    public function blackhole($type) {
        debug($type);
        $this->Session->setFlash(__('ERROR: %s',$type), 'error');
    }
     */
}
