<?php
App::uses('AppController', 'Controller');
/**
 * Subscribers Controller
 *
 * class for manipulating subscriber details
 * @property Subscriber $Subscriber
 */
class SubscribersController extends AppController {
    public $components = array('RequestHandler');
	
    public $helpers = array(
        'Js',
    );

    public $paginate = array(
        'limit' => 10
    );

/**
 * index method
 *
 * @return void
 *
 * - pagination of subscriber list
 */
	public function index() {
		$this->Subscriber->recursive = 0;
		$this->set('subscribers', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 *
 * - method for retrieving and passing subscriber details to View files
 */
	public function view($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		$this->set('subscriber', $this->Subscriber->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 *
 * - method for manually adding subscribers
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subscriber->create();
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		}
		$regionCities = $this->Subscriber->RegionCity->find('list');
		$this->set(compact('regionCities'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 *
 * - method for modifying subscriber details
 */
	public function edit($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Subscriber->read(null, $id);
		}
		$regionCities = $this->Subscriber->RegionCity->find('list');
		$this->set(compact('regionCities'));
	}

/**
 * toggleActive method
 *
 * @param string $id
 * @return void
 *
 * - method to toggle subscriber status
 */

    public function toggleActive($id = null, $flag = null) {
 		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subsciber'));
		}
		
		$action = ($flag == 0)  ? 'deactivated.' : 'activated.';
		
		if($this->Subscriber->saveField('active', $flag))
		{
			$this->Session->setFlash(__('Subscriber has been ' . $action), 'success');
			$this->redirect(array('action' => 'index'));
        }else{
		    $this->Session->setFlash(__('Unable to activate/deactivate subscriber.'),'error');
		    $this->redirect(array('action' => 'index'));
        }
    }
 
/**
 * delete method
 *
 * @param string $id
 * @return void
 *
 * - method for deleting subscriber data
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->Subscriber->delete()) {
			$this->Session->setFlash(__('Subscriber deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Subscriber was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * search method
 *
 * @param null
 * @return json_encoded(data)
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
            $this->Subscriber->recursive = -1;

            $total = $this->Subscriber->find(
                'count',
                array(
                    'conditions' => array('Subscriber.msisdn like' => "%{$term}%"),
                )
            );

            $subscribers = $this->Subscriber->find(
                'all',
                array(
                    'contain' => false,
                    'conditions' => array('Subscriber.msisdn like' => "%{$term}%"),
                    'fields' => array('Subscriber.subscriber_id as id', 'Subscriber.msisdn as text'),
                    'limit' => $limit
                )
            );
            $ctr = 0;

            if(empty($subscribers)){
                $result['subscribers'] = '';
            }else{
                 foreach($subscribers as $subscriber){
                    $result['subscribers'][$ctr++] = $subscriber['Subscriber'];
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
 * custom_search method
 *
 * @param null
 * @return void
 */
    public function custom_search(){
    
    }

    /*
    public function random_add(){
        $data = array();
        $msisdn_list = array();
        $digit_f1 = array(0, 1, 2, 3, 4, 9);
        $digit_f2 = array(0, 1, 2, 9);
        $limit = 50000;
        $completed = false;
        $append = '0000000';
        $gender_list = array('M', 'F');

        for($i=95000;$i<100000;$i++){

            $msisdn = '639' . $digit_f1[rand(0, 5)] . $digit_f2[rand(0, 3)] . substr($append, 0, - (strlen($i))) . $i;
            //echo $msisdn, PHP_EOL;
            //printf("639%s%s\n", $digit1, $digit2);

            $data['Subscriber'][$i] = array(
                'msisdn' => $msisdn,
                'age' => rand(18, 90),
                'gender' => $gender_list[rand(0,1)],
                'region_city_id' => rand(1, 117),
                'active' => rand(0,1),
                'date_on' => date('Y-m-d H:i:s'),
                'date_off' => '0000-00-00 00:00:00'
            );
            //var_dump($data);
        }
            //$this->Subscriber->create();
			//if ($this->Subscriber->saveAll($data['Subscriber'])) {
				//$this->Session->setFlash(__('The region city has been saved'), 'success');
				//$this->redirect(array('action' => 'index'));
			//} else {
				//$this->Session->setFlash(__('The region city could not be saved. Please, try again.'), 'error');
			//}		
    }
     */
}
