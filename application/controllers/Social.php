<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends CI_Controller {

	private static $data = array();
	public function __construct() {
		parent::__construct();
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('RefferralOperationsHandler', 'refferalModel');  

		/*Load Defaults*/
		self::$data['settings']						    =	$this->database->getSettingsData();
        self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms',array('type'=>'listing'));
        self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms',array('type'=>'option'));
        self::$data['homepage']                         =   $this->database->_get_row_data('tbl_homepage_setup',array('id'=>1));
        self::$data['plugins']                          =   $this->database->_get_row_data('tbl_platforms','');
		self::$data['languages']						=	$this->database->load_all_languages();
		self::$data['default_currency']                 =   $this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'symbol');
        self::$data['language']                         =   $this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
		self::$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
        self::$data['announcements']                    =   $this->database->_get_row_data('tbl_announcement',array('status'=>1));
        self::$data['disputes']                         =   $this->database->_get_disputes_data(0);
        self::$data['imagesData']                       =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
        self::$data['ads']                              =   $this->database->_get_row_data('tbl_ads',array('id'=>1));
        self::$data['email_settings']                   =   $this->database->_get_row_data('tbl_email_settings',array('id'=>1));
        self::$data['token']                            =   $this->security->get_csrf_hash();
        self::$data['paymentsact']                      =   $this->database->_get_row_data('tbl_payment_settings',array('status'=>1));
		if(self::$data['settings'][0]['ssl_enable'] === '1'){
			force_ssl();
		}    
    }

    public function load_social_logins(){
    	$this->common->is_logged_admin(); 
    	$data = self::$data;


    	if(file_exists(APPPATH.'/libraries/SocialLogins.php')){
            $this->load->library('SocialLogins' ,NULL ,'socialLogin');
        }

    	$data['userdata'] 	= 	$this->database->getUserData($this->session->userdata('user_id'));
    	$data['social_log'] =   $this->database->_get_row_data('tbl_social_logins', array());

    	$this->load->view('admin/social-login-plugins',$data);
		return;
    }

    public function load_social_login_setup(){
    	$this->common->is_logged_admin(); 
    	$data = self::$data;

    	$id = $this->input->get('id');

    	if(file_exists(APPPATH.'/libraries/SocialLogins.php')){
            $this->load->library('SocialLogins' ,NULL ,'socialLogin');
        }

    	$data['userdata'] 	= 	$this->database->getUserData($this->session->userdata('user_id'));
    	$data['social_log'] =   $this->database->_get_row_data('tbl_social_logins', array('id' => $id));

    	$this->load->view('admin/social-login-setup',$data);
		return;
    }

    public function social_data_save(){
    	$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $id = $this->input->get('id');

        $data = array(
        'appid' => $this->input->post('appid'),
        'secretid' => $this->input->post('secretid'),
        );

        $output['response']     = $this->database->_update_to_table('tbl_social_logins',$data,array('id'=>$id));
        $this->session->set_flashdata('success', 'Social Login settings were successfully updated');
        redirect(site_url('social/load_social_login_setup?id='.$id));
    }

    /*Social login*/
    public function social_login(){
        $status = $this->input->get('completed');
        $method = $this->input->get('method');
        $this->load->library('SocialLogins' ,NULL ,'socialLogin');
        $this->socialLogin->social_login($method);
        return;
    }
		 
}