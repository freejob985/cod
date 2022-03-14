<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

class SocialLogins {

	protected $CI = null;

	public function __construct(){
		$this->CI =& get_instance();
    	$this->CI->load->model('DatabaseOperationsHandler','database');
    	$this->CI->load->model('CommonOperationsHandler','common');
	}

	public function social_login($method){

		$appData = $this->CI->database->_get_row_data('tbl_social_logins',array('name'=>$method));
		// Build configuration array
		$config = [
    		// Location where to redirect users once they authenticate with Facebook
    		// For this example we choose to come back to this same script
			'callback' => base_url().'social/social_login?method='.$method.'&completed=yes',

			'providers' => [
				$method => [
            		'enabled' => true,     // Optional: indicates whether to enable or disable Twitter adapter. Defaults to false
            		'keys' => [
                		'key' => $appData[0]['appid'], // Required: your Twitter consumer key
                		'secret' => $appData[0]['secretid']  // Required: your Twitter consumer secret
            		]
        		],
    		]
		];

		try 
		{
			// Feed configuration array to Hybridauth
			$hybridauth = new Hybridauth\Hybridauth($config);

			$adapter = $hybridauth->authenticate($method); 

    		// Returns a boolean of whether the user is connected with Twitter
			$isConnected = $adapter->isConnected();

    		// Retrieve the user's profile
			$userProfile = $adapter->getUserProfile();

    		// Inspect profile's public attributes
			$data = array(
				'username'=>$userProfile->firstName,
				'firstName'=>$userProfile->firstName,
				'lastName'=>$userProfile->lastName,
				'email'=>$userProfile->email,
				'identifier'=>$userProfile->identifier
			);

			$this->addUserDatabase($data);

    		// Disconnect the adapter (log out)
    		$adapter->disconnect();
		}
		catch(\Exception $e){
			echo 'Oops, we ran into an issue! ' . $e->getMessage();
		}
	}

	/*Data Saving*/
	public function addUserDatabase(array $data){
		$deviceData     = $this->CI->common->detectVisitorDevice();

		$dataArr = array(
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => md5($data['identifier']),
			'firstname' => $data['firstName'],
			'lastname' => $data['lastName'],
			'user_membership_id' => 0,
			'user_status' => 2,
			'user_ip' => $deviceData['ip_address'],
			'date' => date('Y-m-d H:i:s'),
			'token' => $data['identifier'],
			'user_level' => 1,
			'identifier' => $data['identifier']
		);

		try {

			$userdata = $this->CI->database->_get_row_data('tbl_users',array('identifier'=>$dataArr['identifier']));

			if(!empty($userdata)){
				
				if($this->CI->database->_update_to_table('tbl_users',$dataArr,array('identifier'=>$dataArr['identifier']))){
					$userdataArr = $this->CI->database->_get_row_data('tbl_users',array('identifier'=>$dataArr['identifier']));
					$this->CI->session->set_userdata('user_id', $userdataArr[0]['user_id']);
					$this->CI->session->set_userdata('user_level',$userdataArr[0]['user_level']);
					redirect(base_url().'user');
					return;
				}
			}
			else
			{
				if($this->CI->database->_insert_to_table('tbl_users',$dataArr))
				{
					$userdataArr = $this->CI->database->_get_row_data('tbl_users',array('identifier'=>$dataArr['identifier']));
					if(!empty($userdataArr)){

						$this->CI->session->set_userdata('user_id', $userdataArr[0]['user_id']);
						$this->CI->session->set_userdata('user_level',$userdataArr[0]['user_level']);
						redirect(base_url().'user');
						return;
					}
				}
			}
		}
		catch(\Exception $e){
			echo 'Oops, we ran into an issue! ' . $e->getMessage();
		}
	}

}