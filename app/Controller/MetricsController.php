<?php
App::uses('AppController', 'Controller');
/**
 * Dashboard Controller
 *
 * - class for statistics generation
 *
 */
class MetricsController extends AppController {
    public $components = array('RequestHandler'); 
    public $helper = array('Js');
/**
 * isAuthorized method
 *
 * @return boolean 
 *
 * - defines who accesses what
 * - only Administrators can access both adcall and sms reports
 * - Campaign Managers have access to adcall only
 */
	public function isAuthorized($user) {
		//debug($user);
        $this->loadModel('Campaign');

        switch($this->action){
            case 'index':
            case 'adcall':
                return true;
            case 'sms_reports':
				return parent::isAuthorized($user);
            case 'adcall_reports':
            case 'adcall_stat_pdf':
            case 'sms_stat_pdf':
                return true;
            case 'sms':
                //$this->Auth->authError = 'You are not allowed .';
				return parent::isAuthorized($user);
        }
	}

/**
 * index method
 *
 * @return void
 */
    public function index(){
    
    }

    public function sms(){
        $this->loadModel('TransactionCode');

        $codes = $this->TransactionCode->find(
            'all',
            array(
                'conditions' => array(
                    'TransactionCode.type' => array('error','stat')
                )
            )
        );

        $codes_optgroup = array();

        foreach($codes as $code){
            $type = Inflector::humanize($code['TransactionCode']['type']);
            $id = $code['TransactionCode']['transaction_code_id'];
            $desc = $code['TransactionCode']['description'];
            $codes_optgroup[$type][$id] = $desc;
            //if(array_key_exists)
            //echo $type;
            //$codes_optgroup[Inflector::humanize($code['TransactionCode']['type'])][] =  array($code['TransactionCode']);
        }

        //debug($codes_optgroup);
        $this->set('codes', $codes_optgroup);
        /*
        $this->set(
            'codes',
        );
         */
    }

    public function adcall(){
        $this->loadModel('Campaign');
		$this->Campaign->recursive = 0;

        $campaigns = null;
        if($this->Auth->user('role_id') == 2){
            $campaigns = $this->Campaign->find(
                'list',
                array(
                    'conditions' => array(
                        'Campaign.user_id' => $this->Auth->user('user_id')
                    )
                )
            );
        }else{
            $campaigns = $this->Campaign->find('list');
        }
		
        //debug($campaigns);
		$this->set('campaigns', $campaigns);
    
    }

    public function sms_reports($id = null){

        if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }else{
            //ajax-request handling
            error_log(serialize($this->data));
            //error_log(serialize($this->request->params));
            if($this->RequestHandler->isAjax()){
                Configure::write('debug', 0);
                $this->autoRender = false;
                header('Content-type: application/json');
                //echo json_encode($this->request->params);
                sleep(1);
            }else{
                $this->autoRender = false;
            }
        }   
    }

    public function adcall_reports(){

        if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }else{
            //ajax-request handling
            if($this->RequestHandler->isAjax()){
                Configure::write('debug', 0);
                $this->autoRender = false;
                header('Content-type: application/json');

                $this->loadModel('Campaign');
                $result = array();
                $role_id = $this->Auth->user('role_id');
                $user_id = $this->Auth->user('user_id');
                $campaign_id = $this->data['Metrics']['campaign'];

                /*
                if($role_id == 1){
                    $result['status'] = 'success';
                    $result['data'] = array('0' => 'test data 0', '1' => 'test data 1');
                }else{
                */
                if($role_id == 1 || $this->Campaign->isOwnedBy($campaign_id, $user_id)){
                    $result['status'] = 'success';
                    $result['data'] = array(
                        '0' => array(
                            'title' => 'Total number of SMS ALERTS sent:',
                            'tag' => 'total_sms_alert',
                            'value' => rand(1000, 2000)
                        ),
                        '1' => array(
                            'title' => 'Total number of successful 10-sec audio ad played:',
                            'tag' => 'total_10s_audio',
                            'value' => rand(1000, 2000)
                        ),
                        '2' => array(
                            'title' => 'Total number of successful 60-sec calls claimed:',
                            'tag' => 'total_60s_call',
                            'value' => rand(1000, 2000)
                        ),
                        '3' => array(
                            'title' => 'Total number of incomplete (billable) AdCalls made:',
                            'tag' => 'total_inc_billable',
                            'value' => rand(1000, 2000)
                        ),
                    );                   
                }else{
                    $result['status'] = 'error';
                    $result['message'] = 'You are only allowed to generate reports for campains you have created.';
                }
                //}

                sleep(1);
                echo json_encode($result);
            }else{
                $this->autoRender = false;
            }
        }   
    }

    public function adcall_stat_pdf(){
        $this->loadModel('Campaign');
        //$campaign = $this->Campaign->read($this->request->data['campaign']);
        $this->Campaign->recursive = -1;
        $campaign = $this->Campaign->read(null, 1);
        $metrics = $this->request->data;
        $metrics['Campaign'] = array();
        $metrics['Campaign']['title'] = $campaign['Campaign']['title'];
        $metrics['Campaign']['client'] = $campaign['Campaign']['client_name'];
        //$this->Campaign->read();

        $this->layout = 'pdf';
        $this->set('metrics', $metrics);
    }

    public function sms_stat_pdf(){
        if($this->request->is('get')){
			throw new MethodNotAllowedException();
        }

        debug('TODO: generate PDF here');
        die;
    }

}
?>
