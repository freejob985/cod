<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refferal extends CI_Controller {

	private static $data = array();
	public function __construct() {
		parent::__construct();
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('RefferralOperationsHandler', 'refferalModel');  
		 

		/*Load Defaults*/
		self::$data['settings'] 						= 	$this->database->getSettingsData();
		self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
		self::$data['options']                        	=   $this->database->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
		self::$data['languages']						=	$this->database->load_all_languages();
		self::$data['default_currency']					=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'symbol');
		self::$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 				= 	$this->common->is_language();
		self::$data['language'] 						= 	$this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
		self::$data['openContracts']					= 	$this->database->_get_my_contracts();
		self::$data['closeContracts']					= 	$this->database->_get_my_contracts(false);
		self::$data['openEscrow']						= 	$this->database->_get_my_contracts(true,'escrow');
		self::$data['closeEscrow']						= 	$this->database->_get_my_contracts(false,'escrow',3);
		self::$data['listingCount']						= 	$this->database->_count_listings_user_wise('auction');
		self::$data['listingOfferCount']				= 	$this->database->_count_listings_user_wise('classified');
		self::$data['messageCount']						= 	$this->chat->get_unviewed_msg($this->session->userdata('user_id'));
		self::$data['categoriesData']					=	$this->database->_count_listings_categories_wise();
		self::$data['announcements']                    =   $this->database->_get_row_data('tbl_announcement',array('status'=>1));
		self::$data['pages']                    		=   $this->database->_get_row_data('tbl_pages',array('page_visibility_status'=>1));
		self::$data['imagesData']						=	$this->database->_get_row_data('tbl_siteimages',array('id'=>1));
		self::$data['payments']                     	=   $this->database->_get_row_data('tbl_payment_settings',array('status'=>1,'back_status'=>1));
		self::$data['paymentsOptions']                  =   $this->database->_get_row_data('tbl_payment_settings',array('status'=>1));
		self::$data['ads']                				=   $this->database->_get_row_data('tbl_ads',array('id'=>1));
		self::$data['incomlistings'] 					=  	$this->database->_get_row_data('tbl_listings',array('user_id'=>$this->session->userdata('user_id'),'status'=>0));
		self::$data['l_format']							=   $this->database->_get_single_data('tbl_languages',array('status'=>1,'language'=>$this->common->is_language()),'l_format');
		self::$data['token'] 							= 	$this->security->get_csrf_hash();

		if(self::$data['settings'][0]['ssl_enable'] === '1'){
			force_ssl();
		}    
    }

    public function user_referral(){
    	$this->common->is_logged(); 
    	$data = self::$data;

    	if(empty($data['userdata'][0]['referral_code'])){
    		if(file_exists(APPPATH.'/libraries/Referral_Module.php')){
            	$this->load->library('Referral_Module',NULL,'refferal');
            	$referral_code = $this->refferal->generate_refferal_code();
            	$this->database->_update_to_table('tbl_users',array('referral_code' => $referral_code),array('user_id'=>$this->session->userdata('user_id')));
        	}
    	}

    	$data['userdata'] 		= 	$this->database->getUserData($this->session->userdata('user_id'));
        $data['refferal_users'] =   $this->database->_get_row_data('tbl_users',array('referrer'=>$this->session->userdata('user_id')));

    	$data['refferals'] 		= 	$this->refferalModel->load_refferals($this->session->userdata('user_id') , 1);

        $data['withdrawals']    =   $this->refferalModel->_get_withdrawals_ref($this->session->userdata('user_id'),'',5, 0);

        $data["links"]          =   $this->withdrawals_pagination_loader();

    	$data['refferalsPaym'] 	=   $this->refferalModel->load_user_payments($this->session->userdata('user_id'));
        $data['withdraw_meths'] =   $this->database->_get_row_data('tbl_withdrawal_methods',array('status'=>1));

    	$this->load->view('user/refferals',$data);
		return;
    }

    public function admin_referral(){
    	$this->common->is_logged_admin(); 
    	$data = self::$data;

    	if(empty($data['userdata'][0]['referral_code'])){
    		if(file_exists(APPPATH.'/libraries/Referral_Module.php')){
            	$this->load->library('Referral_Module',NULL,'refferal');
        	}
    	}

    	$data['userdata'] 	= 	$this->database->getUserData($this->session->userdata('user_id'));
    	$data['refferals'] 	= 	$this->database->refferalModel->load_admin_pending_payments(0);

    	$this->load->view('admin/refferals-setup',$data);
        //$this->load->view('admin/admin-referral',$data);
		return;
    }

    /*Save Refferal Commsions*/
    public function save_refferal_com(){

        $data = array(
            'ref_sale_com'=>$this->input->post('ref_sale_com'),
            'ref_plan_com'=>$this->input->post('ref_plan_com')
        );
        
        $output['response']  = $this->database->_update_to_table('tbl_settings',$data,array('id'=>1));
        redirect(base_url().'refferal/admin_referral');
    }

    public function markAsPaid(){
    	$this->common->is_logged_admin();
    	$id = $this->input->get('id', TRUE);
    	$this->database->_update_to_DB('tbl_refferal' , array('status'=> 4) , $id);
    	redirect(base_url().'refferal/admin_referral');
    }

    public function markAsRejected(){
    	$this->common->is_logged_admin();
    	$id = $this->input->get('id', TRUE);
    	$this->database->_update_to_DB('tbl_refferal' , array('status'=> 2) , $id);
    	redirect(base_url().'refferal/admin_referral');
    }

    public function markAsApproved(){
        $this->common->is_logged_admin();
        $id = $this->input->get('id', TRUE);
        $this->database->_update_to_DB('tbl_refferal' , array('status'=> 1) , $id);
        redirect(base_url().'refferal/admin_referral');
    }

    /*load withdrawals data Refferal*/
    public function withdrawals_data_ref($status){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->refferalModel->_withdrawals_data_ref($status);
        exit(json_encode($output));
    }

    /*user withdrawals list*/
    public function user_withdrawals_ref($page=0){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data['withdrawals']                    =   $this->refferalModel->_get_withdrawals_ref($this->session->userdata('user_id'),'',5,$page);

        $data["links"]                          =   $this->withdrawals_pagination_loader();
        $response                               =   $this->load->view('user/includes/user_withdrawals_ref', $data, TRUE);
        $output['response']                     =   $response;
        exit(json_encode($output));
    }

    /*withdrawals list pagination creator*/
    public function withdrawals_pagination_loader(){

        $config = array();
        $config["base_url"]                     = '#';
        $config["total_rows"]                   = $this->database->_results_count('tbl_withdrawals_ref',array('user_id'=>$this->session->userdata('user_id')),true);

        $config["per_page"]                     = 5;
        $config['use_page_numbers']             = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect">';
        $config['num_tag_close']                = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                = '<li class="pagination-arrow">';
        $config['prev_tag_close']               = '</li>';
        $config['first_tag_open']               = '<li class="ripple-effect">';
        $config['first_tag_close']              = '</li>';
        $config['last_tag_open']                = '<li class="ripple-effect">';
        $config['last_tag_close']               = '</li>';

        $config['prev_link']                    = '<i class=" mdi mdi-chevron-left"></i>';
        $config['prev_tag_open']                = '<li class="pagination-arrow">';
        $config['prev_tag_close']               = '</li>';


        $config['next_link']                    = '<i class=" mdi mdi-chevron-right"></i>';
        $config['next_tag_open']                = '<li class="pagination-arrow">';
        $config['next_tag_close']               = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    /*Create Withdrawal Record*/
    public function create_withdrawal(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $datas = self::$data;
        $withdrawalDetails      = $this->database->_get_row_data('tbl_withdrawal_methods',array('id'=>$this->input->post('withdrawal_method'),'status'=>1));
        $availableToWithdraw    = $this->refferalModel->_user_availableto_withdraw($this->session->userdata('user_id'));

        if($availableToWithdraw < $this->input->post('withdraw_amount')){
            $output['response'] ='Sorry You can withdraw only $'.$availableToWithdraw;
            exit(json_encode($output)); 
        }

        if($withdrawalDetails[0]['threshold'] > $this->input->post('withdraw_amount')){
            $output['response'] ='Sorry Your Withdrawal Threshold for this method is $'.$withdrawalDetails[0]['threshold'];
            exit(json_encode($output));
        }

        $fee = $withdrawalDetails[0]['fee'];
        if($withdrawalDetails[0]['cal_meth'] === '1'){
            $fee = ($this->input->post('withdraw_amount') * $withdrawalDetails[0]['fee']) / 100;
        }

        $data = array(
            'withdrawal_id' =>$this->database->_unique_id('tbl_withdrawals_ref','alnum','withdrawal_id'),
            'user_id' => $this->session->userdata('user_id'),
            'updated' => date('Y-m-d H:i:s'),
            'amount' => $this->input->post('withdraw_amount'),
            'fee' => $fee,
            'final_amount' => ($this->input->post('withdraw_amount') - $fee),
            'method' => $this->input->post('withdrawal_method'),
            'status' => 0
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('amount', 'Withdrawal Amount', 'required|numeric|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            if($datas['settings'][0]['email_notifications'] === '1'){
                $this->email_op->_admin_email_notification('withdraw-request',$data);
            }

            $output['response']     =   $this->database->_insert_to_table('tbl_withdrawals_ref',$data);
            exit(json_encode($output)); 
        }

        $output['response']         =   'Sorry, right now we cannot process your request. Please contact support';
        exit(json_encode($output)); 
    }


     /*selected data withdrawals*/
    public function update_selected__withdrawal($table,$column,$value,$condition,$con_value){
        if($table ==='tbl_withdrawals_ref' && !empty($con_value)){
            $this->email_op->_user_email_notification('withdraw-change',array('id'=>$con_value,'status'=>$value));
        }

        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_update_to_table($table,array($column=>$value),array($condition=>$con_value));

        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }
    
}
