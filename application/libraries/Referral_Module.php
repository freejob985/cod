<?php defined('BASEPATH') OR exit('No direct script access allowed');


/*Refferal Module Slippa */

class Referral_Module {

	protected $gateway = null;
	protected $CI = null;
	protected $reffer = 0;

	public function __construct(){
		$this->CI =& get_instance();
    	$this->CI->load->model('DatabaseOperationsHandler','database');
    	$this->CI->load->library('session');
	
		$this->CI->load->library('session');
		$this->reffer = $this->CI->input->get('referrer', TRUE);
		if(!empty($this->reffer)){
			$this->CI->session->set_userdata('referrer', $this->reffer);
		}
	}

	public function reffer(){

		if(!empty($this->reffer)){
			$ref_code = $this->reffer;
		}
		else if(!empty($this->CI->session->userdata('referrer')))
		{
			$ref_code = $this->CI->session->userdata('referrer');
		}
		else
		{
			$ref_code = 0;
		}

		if($this->CI->database->CheckAlreadyExists('tbl_users', array('referral_code' => $ref_code)) > 0) {
			$user_id = $this->CI->database->_get_single_data('tbl_users', array('referral_code' => $ref_code),'user_id');
			if(!empty($user_id)){
				return $user_id;
			}
		}

		return 0;
	}

	public function generate_refferal_code(){
		$this->CI->load->helper('string');
		$code = random_string('alnum',5);

		if($this->CI->database->CheckAlreadyExists('tbl_users', array('referral_code' => $code)) > 0) {
			return $this->generate_refferal_code();
		}

		return $code;
	}


	
}