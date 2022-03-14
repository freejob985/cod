<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class Common extends CI_Controller {

    private static $data = array();
    
	function __construct() {
		parent::__construct();
		$this->load->helper(array('helperssl'));

        $this->load->model('DatabaseOperationsHandler', 'database');
        $this->load->model('CommonOperationsHandler', 'common');
        $this->load->model('EmailOperationsHandler', 'email_op');
        $this->load->model('EscrowOperationsHandler', 'escrow');

        self::$data['l_format']=   $this->database->_get_single_data('tbl_languages',array('status'=>1,'language'=>$this->common->is_language()),'l_format');
        self::$data['token']   =   $this->security->get_csrf_hash();
    }

	/*User logout*/
	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_level');
		redirect($this->session->userdata('url'));
		return;
	}

    /*get sponsored listings*/
    public function text_rotator(){
        $sponsored_listings = $this->database->_get_sponsored_listing('sponsored',true);
        $sponsored_listings = array_column($sponsored_listings, 'names');
        exit(json_encode($sponsored_listings));
    }

	/*Not found Page*/
	public function pageNotFound(){
		$this->load->view('main/404');
	}

    /*Load all languages*/
    public function load_languages(){
        header('Content-Type: application/json');
        $output['token']        = $this->security->get_csrf_hash();
        $output['response']     = $this->database->load_all_languages();
        exit(json_encode($output));
    }

	/*User Login*/
	public function user_login(){
        if(empty($this->common->is_logged('ignore'))){
            $data = self::$data;
            $data['selectedLanguage']       =   $this->common->is_language();
            $data['imagesData']             =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
            $data['settings']               =   $this->database->getSettingsData();
            $data['language']               =   $this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
            $data['social_log']             =   $this->database->_get_row_data('tbl_social_logins', array());
            $this->common->is_ssl();
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('user/login',$data);
        }
        else
        {
            redirect(base_url().'user');
        }
	}

	/*User Signup*/
	public function user_signup(){
        if(empty($this->common->is_logged('ignore'))){
          $data = self::$data;
		  $data['selectedLanguage'] 		= 	$this->common->is_language();
          $data['imagesData']               =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
          $data['settings']                 =   $this->database->getSettingsData();
          $data['language']                 =   $this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
          $data['social_log']              =   $this->database->_get_row_data('tbl_social_logins', array());
		  $this->common->is_ssl();
          $data = html_escape($this->security->xss_clean($data));
		  $this->load->view('user/register',$data);
        }
        else
        {
            redirect(base_url().'user');
        }
	}

    /*admin Login*/
    public function admin_login(){
        if(empty($this->common->is_logged_admin('ignore'))){
            $data = self::$data;
            $data['selectedLanguage']       =   $this->common->is_language();
            $data['imagesData']             =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
            $data['settings']               =   $this->database->getSettingsData();
            $data['language']               =   $this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
            $this->common->is_ssl();
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('admin/login',$data);
        }
        else
        {
            redirect(base_url().'admin');
        }
    }

    /*Get Currency Options*/
    public function load_currency_options() {
        $output['token']      = $this->security->get_csrf_hash();
        $output['response']   = false;
        header('Content-Type: application/json');
        $output['response']   = $this->database->_get_row_data('tbl_currencies',''); 
        exit(json_encode($output));
    }

    /*Plugin Status Changer*/
    public function plugin_status_changer($id,$status) {
        $output['token']      = $this->security->get_csrf_hash();
        $output['response']   = false;
        header('Content-Type: application/json');
        if(!empty($id)){
           $output['response']   = $this->database->_plugin_status_changer($id,$status); 
        }
        exit(json_encode($output));
    }

     /*Homepage Modules Changer*/
    public function homepage_status_changer($id,$status) {
        $output['token']      = $this->security->get_csrf_hash();
        $output['response']   = false;
        header('Content-Type: application/json');
        if(!empty($id)){
           $output['response']   = $this->database->_update_to_table('tbl_homepage_setup',array($id=>$status),array('id'=>'1')); 
        }
        exit(json_encode($output));
    }


    /*Password Request Form*/
    public function reset_user_password(){
        header('Content-Type: application/json');
        $output['token'] = $this->security->get_csrf_hash();
        $data = array(
        'reset_email' => $this->input->post('reset_email')
        );
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('reset_email', 'reset_email', 'required|trim|xss_clean|valid_email');
        if ($this->form_validation->run()){
            $output['response']    = $this->database->_reset_user_password();
            exit(json_encode($output));
        }
        
        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Password Reset Update*/
    public function reset_user_password_update(){
        header('Content-Type: application/json');
        $data['token'] = $this->security->get_csrf_hash();
        $data = array(
        'reset_user_email' => $this->input->post('reset_user_email')
        );
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('reset_user_email', 'reset_user_email', 'required|trim|xss_clean|valid_email');
        if ($this->form_validation->run()){
            $output['response']    = $this->database->_reset_user_password_update();
            exit(json_encode($output));
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    public function password_reset_request($token){
        $isvalid = $this->database->_results_count('tbl_users',array('token'=>$token));
        if($isvalid){
            $data['token'] = $this->security->get_csrf_hash();
            $data['userdata'] = $this->database->_get_row_data('tbl_users',array('token'=>$token));

            if(isset($data['userdata'][0]['email']) && !empty($data['userdata'][0]['email'])){
                $email                  = $data['userdata'][0]['email'];
                $data['settingsData']   = $this->database->getSettingsData();
                $data['imagesData']     = $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
                $data['email']          = $email;

                if(isset($data['settingsData'][0]['ssl_enable']) && $data['settingsData'][0]['ssl_enable']==1){
                    force_ssl();
                }
                $data = html_escape($this->security->xss_clean($data));
                $this->load->view('user/reset_password_change',$data);
            }
            else
            {
                header( "refresh:5;url=".base_url().'login' );
                echo $this->lang->line('invalid_token_msg') ;
            }
        }
        else
        {
            header( "refresh:5;url=".base_url().'login' );
            echo $this->lang->line('invalid_token_msg') ;
        }
    }

    /*Password Reset*/
    public function reset_password(){
        $data = self::$data;
        if(empty($this->common->is_logged('ignore'))){
            $data['token'] = $this->security->get_csrf_hash();
            $data['selectedLanguage']       =   $this->common->is_language();
            $data['imagesData']             =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
            $data['settings']               =   $this->database->getSettingsData();
            $data['language']               =   $this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
            $this->common->is_ssl();
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('user/reset_password',$data);
        }
        else
        {
            redirect(base_url().'user');
        }
    }

    /*Password Reset Complete*/
    public function reset_password_complete($email){
        $data['token'] = $this->security->get_csrf_hash();
        if(!empty($email)){
            $email                          = base64_decode(urldecode($email));
            $data['email']                  = $email;
            $data['imagesData']             = $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
            $data['settings']               = $this->database->getSettingsData();
            $data['language']               = $this->database->_get_single_data('tbl_languages',array('default_status'=>1),'language_code');
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('user/reset_password_change',$data);
        }
        else
        {
            redirect(base_url().'user');
        }
    }

    /*get listing plan data*/
    public function get_listing_plans($id,$type){
        header('Content-Type: application/json');
        $output['token']            = $this->security->get_csrf_hash();
        $data                       = $this->database->_get_row_data('tbl_purchases',array('plan_id'=>$id,'listing_type'=>$type));
        if(!empty($data)){
            $output['response']     = $data;
        }
        else
        {
            $output['response']     = false;
        }
        
        exit(json_encode($output));
    }

    /*update date*/
    public function update_listing_plans(){
        header('Content-Type: application/json');
        $output['token']            = $this->security->get_csrf_hash();
        if(!empty($this->input->post('plan-id'))){
            $listing_plan = $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('plan-id')));
            if(!empty($listing_plan)){
                if(!empty($this->input->post('listing_extend'))){
                    $current = $this->database->_get_row_data('tbl_purchases',array('plan_id'=>$listing_plan[0]['id'],'listing_type'=>$listing_plan[0]['listing_type']));
                    if(!empty($current)){
                        $this->database->_update_to_table('tbl_purchases',array('expire_date'=>date("Y-m-d" , strtotime(date("Y-m-d",strtotime($current[0]['expire_date']))."+ ".$this->input->post('listing_extend')."day"))),array('id'=>$current[0]['id']));
                    }
                    else
                    {
                        $this->database->_insert_purchasedata_admin($this->session->userdata('user_id'),array('user_membership_id'=>$listing_plan[0]['id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$listing_plan[0]['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$this->input->post('listing_extend')."day")),'plan_header'=>'ADMIN'));
                    }
                }

                if(!empty($this->input->post('sponsore_listing'))){
                    $current = $this->database->_get_row_data('tbl_purchases',array('plan_id'=>$listing_plan[0]['id'],'listing_type'=>'sponsored'));
                    if(!empty($current)){
                        $this->database->_update_to_table('tbl_purchases',array('expire_date'=>date("Y-m-d" , strtotime(date("Y-m-d",strtotime($current[0]['expire_date']))."+ ".$this->input->post('sponsore_listing')."day"))),array('id'=>$current[0]['id']));
                    }
                    else
                    {
                        $this->database->_insert_purchasedata_admin($this->session->userdata('user_id'),array('user_membership_id'=>$listing_plan[0]['id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>'sponsored','user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$this->input->post('sponsore_listing')."day")),'plan_header'=>'ADMIN'));
                    }
                }
            }

            $output['response'] =  true;
        }
        else
        {
            $output['response'] =  false;
        }

        exit(json_encode($output));
    }

    /*send message*/
    public function send_msg(){
        header('Content-Type: application/json');
        $output['token']            = $this->security->get_csrf_hash();
        $output['response']         = $this->EmailOperationsHandler->_send_contact_email();
        exit(json_encode($output));
    }

	/*Login Operations*/
	public function LoginUser($userlevel=1){
        header('Content-Type: application/json');
		$userData =  $this->database->LoginUser();
        $data['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
		if(isset($userData[0]['user_id']) && !empty($userData[0]['user_id'])){
			if($userData[0]['user_level'] == $userlevel ){
				switch ($userData[0]['user_status']) {
				case 1:
                    $data['response']   = 1;
					exit(json_encode($data));
        			break;
    			case 2:
    				$this->session->set_userdata('user_id', $userData[0]['user_id']);
    				$this->session->set_userdata('user_level',$userData[0]['user_level']);
                    $data['response']   = 2;
    				exit(json_encode($data));			
       	 			break;
       	 		case 3:
                    $data['response']   = 3;
       	 			exit(json_encode($data));				
       	 			break;
       	 		case 4:
                    $data['response']   = 4;
       	 			exit(json_encode($data));				
       	 			break;
    			default:
                    $data['response']   = 0;
    				exit(json_encode($data));
				}
			}
			else{
                $data['response']   = 8;
				exit(json_encode($data));
			}
		}
		else{
            $data['response']   = 5;
			exit(json_encode($data));
		}
	}

    /*Get Monthlwise Total Earnings*/
    public function get_userwisemonthlyearnings($year='',$userid){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if(empty($year)){
            $year = date('Y');
        }

        $finalArr = array();
        $arr = $this->database->_get_userwisemonthlyearnings($year,$userid);
        if(!empty($arr)){
            for($i=0;$i<12;$i++) {
                $finalArr[$i] =  $arr[$i]['total'];
            }
        }

        $output['response']         = $finalArr;
        exit(json_encode($output));
    }

	/*Username Availability Check*/
	public function RegistrationUsernameChecks(){
        $data = array(
        'register_username' => $this->input->get('register_username')
        );
        $response['token'] = $this->security->get_csrf_hash();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('register_username', 'Username', 'required|trim|xss_clean|alpha_dash');
        if ($this->form_validation->run()){
            $response['response'] = $this->database->RegistrationAvailabilityChecks('tbl_users','username',$this->input->get('register_username'));
            header('Content-Type: application/json');
            exit(json_encode($response));
        }
        $response['response'] = false;
        header('Content-Type: application/json');
        exit(json_encode($response));
	}

	/*Email Availability Check*/
	public function RegistrationEmailChecks(){
        $data = array(
        'register_email' => $this->input->get('register_email')
        );
        $response['token'] = $this->security->get_csrf_hash();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('register_email', 'Email', 'required|trim|xss_clean|valid_email');
        if ($this->form_validation->run()){
		  $response['response'] = $this->database->RegistrationAvailabilityChecks('tbl_users','email',$this->input->get('register_email',true));
          header('Content-Type: application/json');
          exit(json_encode($response));
        }
        $response['response'] = false;
        header('Content-Type: application/json');
        exit(json_encode($response));
	}

	/*User Registration*/
    public function UserRegistration(){
        $this->load->library('encryption');
        $settingsData   = $this->database->getSettingsData();
        $deviceData     = $this->common->detectVisitorDevice();
        $userStatus     = 2;
        $referral_code  = 0;

        if(isset($settingsData[0]['user_email_activation']) && $settingsData[0]['user_email_activation'] == '1'){
            $userStatus = 1;
            $activation_token = $this->common->_generate_user_token();
            $this->EmailOperationsHandler->sendUserActivationmail($this->input->post('register_email'),$activation_token);
        }


        if(file_exists(APPPATH.'/libraries/Referral_Module.php')){
            $this->load->library('Referral_Module',NULL,'refferal');
            $referral_code = $this->refferal->reffer();
        }
        
        
        $data = array(
        'username' => $this->input->post('register_username'),
        'firstname' => $this->input->post('register_firstname'),
        'lastname' => $this->input->post('register_lastname'),
        'email' => $this->input->post('register_email'),
        'password' => md5(trim($this->input->post('register_password'))),
        'user_membership_id' => 0,
        'user_status' => $userStatus,
        'user_ip' => $deviceData['ip_address'],
        'date' => date('Y-m-d H:i:s'),
        'token' => $activation_token,
        'user_level' => 1,
        'referrer'=>$referral_code
        );

        $data = $this->security->xss_clean($data);
        return $this->database->_insert_to_DB('tbl_users', $data);
    }

	/*Account Activation*/
	public function AccountActivation($token){
		if($this->database->activateViaToken($token)){
			header( "refresh:5;url=".base_url().'login' );
			echo $this->lang->line('account_activation_msg');
		}
		else{
			header( "refresh:5;url=".base_url().'login');
			echo $this->lang->line('invalid_token_msg');
		}
	}

	/*Change User Online / Offline Status*/
	public function ChangeUserOnlineStatus(){
        $output['token']  = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']  =   $this->database->ChangeUserOnlineStatus('online');
        exit(json_encode($output));
	}

    /*Reset user password*/
    public function resetUserPassword(){
        $reset_token = $this->common->_generate_user_token();
        $this->EmailOperationsHandler->sendPasswordResetEmail($this->input->post('reset_email',true),$reset_token);

        $data = array(
        'token' => $reset_token
        );

        return $this->database->_update_to_table('tbl_users', $data,array('email'=>$this->input->post('reset_email',true)));
    }

    /*Change User Password*/
    public function changePasswordUpdate(){
        $output['token']  = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        if(!empty($this->session->userdata('user_id'))){
            $data = array(
            'password' => md5(trim($this->input->post('txt_user_password')))
            );
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
            if ($this->form_validation->run()){
                $output['response']  =  $this->database->_update_to_table('tbl_users', $data,array('user_id'=>$this->input->post('txt_user_id')));
                exit(json_encode($output));
            }
        }

        $output['response']  =   false;
        exit(json_encode($output));
    }

    /*Reset password update*/
    public function resetUserPasswordUpdate(){
        $data = array(
        'password' => md5(trim($this->input->post('reset_user_password'))),
        'token' => $this->common->_generate_user_token()
        );
        
        return $this->database->_update_to_table('tbl_users', $data,array('email'=>$this->input->post('reset_user_email',true)));
    }

	/*Upload file Generation*/
    public function uploadFileGenerator(){
        $dataArr            = array();
        $url                = $this->input->post('lisingtDomain');
        $data['token']      = $this->security->get_csrf_hash();
        $settings           = $this->database->getSettingsData();

        if(filter_var($url, FILTER_VALIDATE_URL)){
            $domain = parse_url($url, PHP_URL_HOST);
            $domainExist =  $this->database->_get_row_data('tbl_domains',array('domain' =>$domain,'user_id' =>$this->session->userdata('user_id')));
            if(isset($domainExist[0]['domain']) && !empty($domainExist[0]['domain'])){
                $dataArr['token']       = $domainExist[0]['token'];
                $dataArr['domain']      = $domainExist[0]['domain'];
                $dataArr['id']          = $domainExist[0]['id'];
                $dataArr['validations'] = true;

                if($settings[0]['active_domain_verification'] !== '0'){
                    if($this->database->createVerificationFile($dataArr)){
                        $data['response']  =   $dataArr;
                        header('Content-Type: application/json');
                        exit(json_encode($data));
                    }

                    $data['response']  =   false;
                    header('Content-Type: application/json');
                    exit(json_encode($data));
                }
                else
                {
                    $dataArr['validations'] = false;
                    $data['response']  =   $dataArr;
                    header('Content-Type: application/json');
                    exit(json_encode($data));
                }
            }
            else
            {
            	$token 					= $this->common->_generate_unique_tokens('tbl_domains');
            	$dataIns= array(
            	'domain' =>$domain,
            	'category_id' =>2,
            	'user_id'=>$this->session->userdata('user_id'),
            	'status'=>0,
            	'token'=>$token,
            	'date'=>date('Y-m-d H:i:s')
       			);

        		$dataArr = array();
        		$dataArr['token']       = $token;
        		$dataArr['domain']      = $domain;
                $dataIns = $this->security->xss_clean($dataIns);
                $dataArr['id']      	= $this->database->_insert_to_DB('tbl_domains',$dataIns);
                $dataArr['validations'] = true;

                if($settings[0]['active_domain_verification'] !== '0'){

                    if($this->database->createVerificationFile($dataArr)){
                        $data['response']  =   $dataArr;
                        header('Content-Type: application/json');
                        exit(json_encode($data));
                    }

                    $data['response']  =   false;
                    header('Content-Type: application/json');
                    exit(json_encode($data));
                }
                else
                {
                    $dataArr['validations'] = false;
                    $data['response']  =   $dataArr;
                    header('Content-Type: application/json');
                    exit(json_encode($data));   
                }
            }
        }
        $data['response']  =   false;
        header('Content-Type: application/json');
        exit(json_encode($data));
    }

    /*Read HTTP Response URL*/
    private function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    /*Check website exists*/
    private function get_http_status( $url ) {
        $timeout = 10;
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
        $http_respond = curl_exec($ch);
        $http_respond = trim( strip_tags( $http_respond ) );
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
            return true;
        }   else {
            // you can return $http_code here if necessary or wanted
            return false;
        }
        curl_close( $ch );
    }

    /*Read and Verify Using DNS TXT*/
    public function readAndVerifyDNS(){
        $output['token']    = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']  =   false;

        if(!empty($this->input->post('dataArr'))){
            $dnsdata = $this->input->post('dataArr');

            try
            {
                $this->load->library('Dns_Verifier' ,NULL ,'dns');
                $response = $this->dns->dnsCheck($dnsdata['token'].'.'.$dnsdata['domain'] , $dnsdata['token']);
            }
            catch (Exception $e)
            {
                $output['response']  =  false;
                exit(json_encode($output));
            }
           

            if($response)
            {
                $dataDOM= array(
                'domain' =>$data['domain'],
                'user_id'=>$this->session->userdata('user_id'),
                'token'=>$code,
                );

                if($this->database->CheckAlreadyExists('tbl_domains',$dataDOM) > 0){
                    if($this->database->_update_domain_token($dataDOM)){
                        $output['response']  =   true;
                    }
                }
            }
        }

        exit(json_encode($output));
    }

	/*Read and Verify Domain*/
	public function readAndVerifyDomain(){
        $output['token']  = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']  =   false;

        if(!empty($this->input->post('dataArr'))){

            $data = $this->input->post('dataArr');
            $verificationURL = 'http://'.$data['domain'].'/'.$data['token'].'.txt';

            try
            {
                $responseVerification = file_get_contents($verificationURL);

                $domainToken = substr($responseVerification, 0, strlen($data['token']));

                if ($domainToken === $data['token']) {
                    $response = true;
                }
            }
            catch (Exception $e)
            {
                $output['response']  =  false;
                exit(json_encode($output));
            }

            if($response)
            {
                $dataDOM= array(
                'domain' =>$data['domain'],
                'user_id'=>$this->session->userdata('user_id'),
                'token'=>$code,
                );

                if($this->database->CheckAlreadyExists('tbl_domains',$dataDOM) > 0){
                    if($this->database->_update_domain_token($dataDOM)){
                        $output['response']  =   true;
                    }
                }

                $output['response']  =   true;
            }

            exit(json_encode($output));

        }
	}

    /*Curl file get content*/
    private function curl_file_get_content($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

	/*Blacklisted domain validations*/
	public function CheckBlacklistedDomains(){
		$results =  $this->database->getSettingsData();
        $data['token']      =   $this->security->get_csrf_hash();
		if(isset($results[0]['blacklisted_domains'])){
            $data['response']   =   $results[0]['blacklisted_domains'];
            header('Content-Type: application/json');
            exit(json_encode($data));
        }
        $data['response']   = '';
        exit(json_encode($data));
	}

    /*Get Platform Domain*/
    public function GetPlatformDomain(){
        $data['results']    =  $this->database->_get_row_data('tbl_platform_list',array('platfrom_domain'=>$this->input->post('platform_domain')));
        $data['token']      =   $this->security->get_csrf_hash();
        if(count($data['results']) > 0){
            $data['response']   =   true;
            header('Content-Type: application/json');
            exit(json_encode($data));
        }
        $data['response']   = false;
        exit(json_encode($data));
    }

	/*Check already a listing exists for a domain*/
	public function checkListingExists(){
		$url              = $this->input->post('lisingtDomain');
        $domain           = parse_url($url, PHP_URL_HOST);
		$settingsData     = $this->database->getSettingsData();
        $output['token']  = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

		$data= array(
        'domain' =>$domain,
        'status' =>1,
        'user_id'=>$this->session->userdata('user_id'),
        );

        if($settingsData[0]['activate_one_listing_per_domain'] === '1'){
        	$domain_id = $this->database->_get_single_data('tbl_domains',$data,'id');
        	if(!empty($domain_id)){
        		$dataList= array(
        		'status' =>1,
        		'domain_id' =>$domain_id,
        		'sold_status'=>0,
        		'user_id'=>$this->session->userdata('user_id'),
        		);

        		$rec_count = $this->database->CheckAlreadyExists('tbl_listings',$dataList);
				if($rec_count > 0){
					$output['response']  = true;
                    exit(json_encode($output));
				}
        	}
		}
		$output['response']  = false;
        exit(json_encode($output));
	}

    /*load pages to table*/
    public function get_table_data($table){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_get_row_data($table,'','');
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*load pages to table*/
    public function get_table_data_with_name($table){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_get_listing_data_name($table,'','');
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*get selected data*/
    public function get_reported_data($table){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']  = $this->database->_get_reported_data();
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*load withdrawals data*/
    public function withdrawals_data($status){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_withdrawals_data($status);
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

     /*set default language*/
    public function set_default_language($id){
        $output['token']        = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']     = $this->database->_set_default_language($id);
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*load listings to table*/
    public function get_listing_table_data($id='',$type='domain'){
        $condition = array();
        if(!empty($id)){
            switch ($id) {
                case '':
                    $condition = array();
                    break;
                case '0':              
                     $condition = array('status' =>0 );
                    break;
                case '1':              
                     $condition = array('status' =>1);
                    break;
                case '2':              
                     $condition = array('status' =>2);
                    break;
                case '4':              
                     $condition = array('status' =>4);
                    break;
                case '5':              
                     $condition = array('status' =>5);
                    break;
                case '6':              
                     $condition = array('status' =>6);
                    break;
                case '7':              
                     $condition = array('sold_status' =>0);
                    break;
                case '8':              
                     $condition = array('sold_status' =>1);
                    break;
                case '9':              
                     $condition = array('listing_type' =>$type);
                    break;
                default:
                    return ;
            }
        }

        $output['token']        = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']     = $this->database->_get_row_data('tbl_listings',$condition,'');
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*load selected data from table*/
    public function get_selected_row($table,$column,$value){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_get_row_data($table,array($column=>$value),'');

        /*if(!DECODE_DESCRIPTIONS){
            $output = html_escape($this->security->xss_clean($output)); 
        }
        else
        {
            $output = $this->security->xss_clean($output); 
        }*/
        
        exit(json_encode($output));
    }

    /*delete selected data*/
    public function delete_from_table($table,$column,$value){
        $output['token']      = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_delete_from_table($table,array($column=>$value));
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*delete selected data*/
    public function delete__language_from_table($table,$column,$value){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $language_name  =   $this->database->_get_single_data('tbl_languages',array($column=>$value),'language');
        if(!empty($language_name)){
            $this->database->_delete_from_table($table,array($column=>$value));
            $output['response']   = $this->delete_language_files('application/language/'.$language_name);
            $output = html_escape($this->security->xss_clean($output));
            exit(json_encode($output));
        }
        else
        {
            $output['response']   = false;
            exit(json_encode($output));
        }
    }

    /*delete language file accordingly*/
    public function delete_language_files($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

            foreach( $files as $file ){
                $this->delete_language_files( $file );      
            }

            rmdir( $target );
            return true;
        } 
        elseif(is_file($target)) 
        {
            unlink( $target );
            return true;  
        }
    }

    /*selected data*/
    public function update_selected_data($table,$column,$value,$condition,$con_value){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_update_to_table($table,array($column=>$value),array($condition=>$con_value));
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*selected data withdrawals*/
    public function update_selected__withdrawal($table,$column,$value,$condition,$con_value){
        if($table ==='tbl_withdrawals' && !empty($con_value)){
            $this->email_op->_user_email_notification('withdraw-change',array('id'=>$con_value,'status'=>$value));
        }

        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_update_to_table($table,array($column=>$value),array($condition=>$con_value));
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*URL SLug Generator*/
    public function urlSlugGenerator(){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $slug = $this->input->post('title',true);
        $output['response']   = $this->common->_urlSlugGenerator('tbl_pages','page_id','txt_page_url_slug',$slug);
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

     /*Blog URL SLug Generator*/
    public function blog_urlSlugGenerator(){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $slug = $this->input->post('title',true);
        $output['response']   = $this->common->_urlSlugGenerator('tbl_blog','id','slug',$slug);
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

     /*Category URL SLug Generator*/
    public function category_urlSlugGenerator(){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $slug = $this->input->post('title',true);
        $output['response']   = $this->common->_urlSlugGenerator('tbl_categories','id','url_slug',$slug);
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*Accept Reported Listing*/
    public function accept_complaint($id){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $listing_id = $this->database->_get_single_data('tbl_reports',array('id'=>$id),'listing_id');
        $this->database->_update_to_table('tbl_listings',array('status'=>6),array('id'=>$listing_id));
        $output['response']   = $this->database->_update_to_table('tbl_reports',array('status'=>1),array('id'=>$id));
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*Reject Reported Listing Complaint*/
    public function reject_complaint($id){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   = $this->database->_update_to_table('tbl_reports',array('status'=>2),array('id'=>$id));
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    /*User Signup*/
    public function RegisterUser(){
        header('Content-Type: application/json');
        $this->load->library('encryption');
        $response['token']  =  $this->security->get_csrf_hash();
        $settingsData   = $this->database->getSettingsData();
        $deviceData     = $this->common->detectVisitorDevice();
        $userStatus     = 2;
        $referral_code  = 0;

        $data = array(
        'register_username' => $this->input->post('register_username'),
        'register_email' => $this->input->post('register_email'),
        'register_firstname' => $this->input->post('register_firstname'),
        'register_lastname' => $this->input->post('register_lastname'),
        'register_password' => $this->input->post('register_password'),
        'register_repassword' => $this->input->post('register_repassword')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('register_username', 'Username', 'required|trim|xss_clean|alpha_dash');
        $this->form_validation->set_rules('register_email', 'Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('register_password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('register_firstname', 'Firstname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('register_lastname', 'Lastname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('register_repassword', 'RetypePassword', 'required|trim|xss_clean|matches[register_password]');

        if ($this->form_validation->run()){

            if(isset($settingsData[0]['user_email_activation']) && $settingsData[0]['user_email_activation'] == '1'){
                $userStatus = 1;
                $activation_token = $this->common-> _generate_user_token();
                $this->EmailOperationsHandler->sendUserActivationmail($this->input->post('register_email'),$activation_token);
            }

            if(file_exists(APPPATH.'/libraries/Referral_Module.php')){
                $this->load->library('Referral_Module',NULL,'refferal');
                $referral_code = $this->refferal->reffer();
            }
        
            $data = array(
            'username' => $this->input->post('register_username'),
            'email' => $this->input->post('register_email'),
            'password' => md5(trim($this->input->post('register_password'))),
            'firstname' => $this->input->post('register_firstname'),
            'lastname' => $this->input->post('register_lastname'),
            'user_membership_id' => 0,
            'user_status' => $userStatus,
            'user_ip' => $deviceData['ip_address'],
            'date' => date('Y-m-d H:i:s'),
            'token' => $activation_token,
            'user_level' => 1,
            'referrer'=>$referral_code
            );

            $data = html_escape($this->security->xss_clean($data));
            if($this->database->_insert_to_table('tbl_users',$data)){
                $response['response']  = true;
                exit(json_encode($response));
            }
        }
        $response['response']  = false;
        exit(json_encode($response));
    }
    
    public function activation_email_sent(){
        header( "refresh:5;url=".base_url().'login' );
        echo $this->lang->line('lang_email_activation');
    }

    /*Update Other user settings*/
    public function SaveUserSettings(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if(!empty($this->session->userdata('user_id'))){
            $thumbnaildb = $this->database->getUserData($this->session->userdata('user_id'))[0]['thumbnail'];
            if(!empty(pathinfo($_FILES["uploadthumbnail"]["name"])['filename'])){
                if($thumbnaildb !== pathinfo($_FILES["uploadthumbnail"]["name"])['filename']){
                    if($this->security->xss_clean($_FILES['uploadthumbnail']['name'], TRUE) === TRUE) {
                        $thumbnail  = $this->upload__image('uploadthumbnail',USER_UPLOAD);
                    }
                    else
                    {
                        $thumbnail  = $thumbnaildb;
                    }
                }
                else
                {
                    $thumbnail  = $thumbnaildb;
                }
            }
            else
            {
                $thumbnail      = $thumbnaildb;
            }
       
            $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'thumbnail' => $thumbnail,
            'user_metadescription' => $this->input->post('user_metadescription'),
            'user_description' => $this->input->post('user_description'),
            'online' => $this->input->post('account-online-radio'),
            'user_country' => $this->input->post('user_country'),
            'social_twitter' => $this->input->post('social_twitter'),
            'social_facebook' => $this->input->post('social_facebook'),
            'social_youtube' => $this->input->post('social_youtube'),
            'paypal' => $this->input->post('paypal_email'),
            'payoneer' => $this->input->post('payoneer_email'),
            'bank_transfer' => $this->input->post('bank_details'),
            'escrow_email' => $this->input->post('escrow_email')
            );

            $data = html_escape($this->security->xss_clean($data));
            if(!empty($this->input->post('user_id'))){
                $output['response']  = $this->database->_update_to_table('tbl_users',$data,array('user_id'=>$this->input->post('user_id')));
                exit(json_encode($output));
            }
        }
        
        $output['response']  = false;
        exit(json_encode($output));
    }

    /*Upload Images */
    public function upload__image($nameBox,$path=IMAGES_UPLOAD){
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = false;
        if (!$this->upload->do_upload($nameBox)) {
            $error = array('error' => $this->upload->display_errors('', ''));
            if(isset($error['error'])){
                return 'N/A';
            }
        }
        else
        {
            $image_data = $this->upload->data();
            $upload_image_name = $image_data['file_name'];
            $full_path = $image_data['full_path'];
            if(isset($full_path)){
                return $upload_image_name;
            }
        } 
    }


    /*Validate App URLs*/
    public function validateApp(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $result = $this->common->checkGooglePlayApp($this->input->post("appurl"));
        if($result){
            $output['response']  = true;
        }
        else{
            $output['response']  = false;
        }
        exit(json_encode($output));
    }

    /*Get Payment URL according to selected method*/
    public function get_payment_url(){
        $output['token']        = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']     = $this->escrow->_get_payment_methods($this->input->post('tid'),$this->input->post('method'));
        if(empty($output['response'])){
            $output['response'] = false;
        }
        exit(json_encode($output));
    }

     /*Wire Transfer Confirmation*/
    public function confirm_wire_transfer($id){
        $output['token']        = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']     = $this->escrow->_confirm_wire_transfer($id);
        $listing_id     = $this->database->_get_row_data('tbl_contracts',array('invoice_id'=>$id,'contract_method'=>'escrow'));
        $listing_data   = $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id[0]['listing_id']));

        $this->common->change_contract_status($listing_id[0]['contract_id'],10);

        $contractArr= array(
            'user_id' =>$this->session->userdata('user_id'),
            'domain_id' =>0,
            'contract_id' =>$listing_id[0]['contract_id'],
            'listing_id' =>$listing_id[0]['listing_id'],
            'amount' =>$listing_data[0]['website_buynowprice'],
            'invoice_id' =>$id,
            'contract_method' =>'escrow',
        );
        
        if($this->database->CheckAlreadyExists('tbl_invoices',array('invoice_id'=>$id)) > 0){
            $this->database->_update_to_table('tbl_invoices',array('date'=>date('Y-m-d H:i:s'),'status'=>9),array('invoice_id'=>$id));
        }
        else
        {
            $this->common->create_invoice($contractArr,9);
        }
        
        if(empty($output['response'])){
            $output['response'] = false;
        }
        exit(json_encode($output));
    }

    /*DNS domain verification*/
    public function domain_txt_val($domains,$compare){
        $txts = dns_get_record($domains, DNS_TXT);
        if(!empty($txts)){
            foreach($txts as $txt) {
                if(!empty($txt['entries'])){
                    foreach($txt['entries'] as $txtValue) {
                        if ($txtValue === $compare) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /*Load admin's Escrow Transactions*/
    public function load_escrow_transacions($page){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $data['transactions']   = $this->escrow->_list_transactions($page);
        $response               = $this->load->view('admin/includes/escrow-trans', $data, TRUE);
        $output['response']     = $response;
        exit(json_encode($output));
    }

    /*View Escrow Transaction*/
    public function view_escrow($id){
        $credentails = $this->DatabaseOperationsHandler->_get_row_data('tbl_payment_settings',array('id'=>4,'status'=>1));
        if(!empty($credentails)){
            
            if($credentails[0]['sandbox']){
                $url = 'https://my.escrow-sandbox.com/myescrow/Transaction.asp?TID='.$id;
            }
            else
            {
                $url = 'https://escrow.com/myescrow/Transaction.asp?TID='.$id;
            }
        }
        redirect($url);
    }

    /*Subscription form submit*/
    public function subscribe_from(){
        $output['token']    = $this->security->get_csrf_hash();
        $data['settings']   = $this->database->getSettingsData();
        header('Content-Type: application/json');
        $this->load->library('MailChimp');
        $list_id = $data['settings'][0]['mailchimp_listing_id'];

        if(!empty($list_id)){
            if(!empty($data['settings'][0]['mailchimp_apikey'])){
                
                $result = $this->mailchimp->post("lists/$list_id/members", [
                    'email_address' => $this->input->post('subscribe_email'),
                    'merge_fields' => ['FNAME'=>'', 'LNAME'=>''],
                    'status'        => 'subscribed',
                ]);

                if($result){
                    $output['response'] = true;
                }
                else
                {
                    $output['response'] = false;
                }
            }
            else
            {
                $output['response'] = false;
            }
        }
        else
        {
            $output['response'] = false;
        }

        exit(json_encode($output));
    }

    /*Add / Edit User*/
    public function AddUser(){
        header('Content-Type: application/json');
        $this->load->library('encryption');
        $response['token']  =  $this->security->get_csrf_hash();
        $settingsData   = $this->database->getSettingsData();
        $deviceData     = $this->common->detectVisitorDevice();
        $userStatus     = 2;
        $referral_code  = 0;

        $data = array(
        'register_username' => $this->input->post('register_username'),
        'register_email' => $this->input->post('register_email'),
        'register_firstname' => $this->input->post('register_firstname'),
        'register_lastname' => $this->input->post('register_lastname'),
        'register_password' => $this->input->post('register_password'),
        'register_repassword' => $this->input->post('register_repassword')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('register_username', 'Username', 'required|trim|xss_clean|alpha_dash');
        $this->form_validation->set_rules('register_email', 'Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('register_password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('register_firstname', 'Firstname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('register_lastname', 'Lastname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('register_repassword', 'RetypePassword', 'required|trim|xss_clean|matches[register_password]');

        if ($this->form_validation->run()){

            if(isset($settingsData[0]['user_email_activation']) && $settingsData[0]['user_email_activation'] == '1'){
                $userStatus = 1;
                $activation_token = $this->common-> _generate_user_token();
                $this->EmailOperationsHandler->sendUserActivationmail($this->input->post('register_email'),$activation_token);
            }

            if(file_exists(APPPATH.'/libraries/Referral_Module.php')){
                $this->load->library('Referral_Module',NULL,'refferal');
                $referral_code = $this->refferal->reffer();
            }
        
            $data = array(
            'username' => $this->input->post('register_username'),
            'email' => $this->input->post('register_email'),
            'password' => md5(trim($this->input->post('register_password'))),
            'firstname' => $this->input->post('register_firstname'),
            'lastname' => $this->input->post('register_lastname'),
            'user_membership_id' => 0,
            'user_status' => $this->input->post('user_status'),
            'user_ip' => $deviceData['ip_address'],
            'date' => date('Y-m-d H:i:s'),
            'token' => $activation_token,
            'user_level' => 1,
            'referrer'=>$referral_code
            );

            $data = html_escape($this->security->xss_clean($data));

            if(!empty($this->input->post('user_id'))){
                $output['response']     = $this->database->_update_to_table('tbl_users',$data,array('user_id'=>$this->input->post('user_id')));
                $response['response']  = true;
                exit(json_encode($response));
            }
            else
            {
                $this->database->_insert_to_table('tbl_users',$data);
                $response['response']  = true;
                exit(json_encode($response));
            }   
        }
        
        $response['response']  = false;
        exit(json_encode($response));
    }
}
