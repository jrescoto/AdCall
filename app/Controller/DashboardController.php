<?php
App::uses('AppController', 'Controller');
/**
 * Dashboard Controller
 *
 * - this serves as a landing page of the app
 *
 */
class DashboardController extends AppController {
    public $helper = array('Js');
/**
 * isAuthorized method
 *
 * @return boolean 
 */
	public function isAuthorized($user) {
		//debug($user);
        return true;
	}

/**
 * index method
 *
 * @return void
 *
 * - accessed as /acadmin/dashboard
 */
    public function index(){
    
    }
}
?>
