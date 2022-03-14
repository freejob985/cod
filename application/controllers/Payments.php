<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class payments extends CI_Controller {

	private static $data = array();
	public function __construct() {
		parent::__construct();
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('EmailOperationsHandler', 'email_op');
		$this->load->model('EscrowOperationsHandler', 'escrow');	 
        
        self::$data['categoriesData']				=	$this->database->_count_listings_categories_wise();
		self::$data['languages']					=	$this->database->load_all_languages();
		self::$data['default_currency']				=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'symbol');
		self::$data['userdata'] 					= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 			= 	$this->common->is_language();
		self::$data['listingCount']					= 	$this->database->_count_listings_user_wise();
		self::$data['imagesData']					=	$this->database->_get_row_data('tbl_siteimages',array('id'=>1));
		self::$data['announcements']                =   $this->database->_get_row_data('tbl_announcement',array('status'=>1));
		self::$data['payments']                     =   $this->database->_get_row_data('tbl_payment_settings',array('status'=>1));
		self::$data['settings']                     =   $this->database->_get_row_data('tbl_settings',array('id'=>1));
		self::$data['token'] 						= 	$this->security->get_csrf_hash();

		if(self::$data['settings'][0]['ssl_enable'] === '1'){
			force_ssl();
		}
    }

    /*Contract Payment Function*/
    public function pay_contract(){

    	if(!empty($this->session->userdata('user_id'))){
    		if($this->input->post('txt_paytotal') > 0){
    			if(!empty($this->input->post('cardType'))){
    				switch ($this->input->post('cardType')) {
    					case 'Escrow':    			
    					$this->escrow->_create_transaction('broker');
    					break;
    					default:
    					$this->common_payment_handler_outside($this->input->post('cardType'));
    					return ;
    				}
    			}
    		}
    		else
    		{
    			$data['errors'] = 'Your Total amount should be greater than 0';
    			$data = html_escape($this->security->xss_clean($data));
    			$this->load->view('main/checkout',$data);
    			return;
    		}

    	}
    	else
    	{
    		$data['errors'] = 'Your login session has expired. Please login to continue';
    		$data = html_escape($this->security->xss_clean($data));
    		$this->load->view('main/checkout',$data);
    		return;
    	}

    }

    /*New Common Payment Gateway Handler Outside*/
	public function common_payment_handler_outside($gateway_id){

		$ListingDataArr = array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'code');
		$currency 			= 'USD';
		$contratc_id_var	= 0;

		if(!empty($gateway_id)){
			$paymentData = $this->database->_get_row_data('tbl_payment_settings',array('paymentgateway_id'=>$gateway_id));
		}
		

		if(!empty($default_currency)) {
			$currency = $default_currency;
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if(!empty($this->input->post('txt_type'))){
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale ='direct';
					break;
				case 'contract':
					$sale ='contract';
					$contratc_id_var = $this->input->post('txt_contract');
					break;
					default:
					return ;
			}
		}

		if(!empty($user_data)){

			$itemsArr[0] = array(
				'id' => $this->input->post('txt_id'), 
				'name' => $this->input->post('txt_description'), 
				'quantity' => 1, 
				'price' => $this->input->post('txt_paytotal'),
				'sale' => $sale
			);

			$valTransc = array(
				'user_id' => $user_data[0]['user_id'],
				'user_email' =>$user_data[0]['email'],
				'user_username' =>$user_data[0]['username'],
				'listing_id' => $this->input->post('txt_id'),
				'amount' => number_format($this->input->post('txt_paytotal'), 2,'.',''),
				'transactionId'=>$payment_id,
				'description' => 'INVOICE :'.$payment_id,
				'currency'=>$currency,
				'payment_method'=>$paymentData[0]['method'],
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN,
				'cancelUrl'=> base_url().PAYMENT_CANCEL,
				'domain_list'=>json_encode($itemsArr),
				'contratc_id_var'=>$contratc_id_var,
				'type' =>'outside',
			);

			$cardInput = array(
				'firstName'=>$this->input->post('name'),
				'lastName'=>'',
				'number'=>$this->input->post('txt_number'),
				'cvv'=>$this->input->post('security-code'),
				'expiryMonth'=>$this->input->post('txt_month'),
				'expiryYear'=>$this->input->post('txt_year'),
				'email'=> $this->input->post('txt_useremail')
			);

			try
			{

				$this->session->set_userdata('paypal_data', $valTransc);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
				$this->load->library($gateway_id ,NULL ,'paymentGateway');
				$data 	= $this->paymentGateway->purchase($cardInput,$valTransc,'','outside');

				if(isset($data['status'])){
					if($data['status'] === 'Success'){
						$this->success($data['valTransc'],$data['data']);
						return;
					}
					else
					{
						$this->fail($this->session->userdata('paypal_data'),$data['data']);
						return;
					}
				}
				else
				{
					$this->fail($this->session->userdata('paypal_data'),$data['data']);
					return;
				}
			}
			catch (Exception $e)
			{
				$valTransc = array(
					'user_id' => $user_data[0]['user_id'],
					'user_email' =>$user_data[0]['email'],
					'user_username' =>$user_data[0]['username'],
					'listing_id' => $this->input->post('txt_id'),
					'amount' => number_format($this->input->post('txt_paytotal'), 2,'.',''),
					'transactionId'=>$payment_id,
					'description' => 'INVOICE :'.$payment_id,
					'currency'=>$currency,
					'payment_method'=>$paymentData[0]['method'],
					'clientIp'=>$this->input->ip_address(),
				);

				$this->fail($valTransc,$e->getMessage());
				return;
			}
		}
		else
		{
			$data['errors'] = 'Invalid User';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout',$data);
			return;
		}	   
	}

    /*Verify and Mark Escrow as success*/
    public function escrow_success($id){
    	if(!empty($id)){
    		$listing_id 	= $this->database->_get_row_data('tbl_contracts',array('invoice_id'=>$id,'contract_method'=>'escrow'));
    		$listing_data 	= $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id[0]['listing_id']));
    		$contract_seq 	= $this->database->_get_single_data('tbl_opens',array('id'=>$listing_id[0]['contract_id'],'contract_method'=>'escrow'),'contract_id');
    		//if($this->database->_update_to_DB('tbl_listings',array('sold_status' => 1),$listing_id[0]['listing_id'])){
            	if(!empty($listing_id[0]['contract_id'])){

            		$contract = array(
                		'user_id' =>$this->session->userdata('user_id'),
                		'domain_id' =>0,
                		'listing_id' =>$listing_id[0]['listing_id'],
                		'amount' =>$listing_data[0]['website_buynowprice'],
                		'invoice_id' =>$id,
                	);

                	$contractArr= array(
                		'user_id' =>$this->session->userdata('user_id'),
                		'domain_id' =>0,
                		'contract_id' =>$listing_id[0]['contract_id'],
                		'listing_id' =>$listing_id[0]['listing_id'],
                		'amount' =>$listing_data[0]['website_buynowprice'],
               	 		'invoice_id' =>$id,
               	 		'contract_method' =>'escrow',
                	);

            		$this->database->_insert_to_table('tbl_domain_purchases',$contract);
                	if($this->database->_insert_to_table('tbl_contracts',$contractArr)){
                    	$this->common->change_contract_status($listing_id[0]['contract_id'],10);
                    	$this->common->create_invoice($contractArr,9);
        				$successURL = base_url().'user/contract/'.$contract_seq;
        				redirect($successURL);     
                	}
            	}
         	//}
        }
    }

    
    /*All Formats Return Page*/
	public function return($type='outside'){
		
		if(!empty($this->session->userdata('paypal_data'))){
			$paypal_data = $this->session->userdata('paypal_data');

			if(!empty( $this->session->userdata('listing_data'))){
				$listing_data = $this->session->userdata('listing_data');
			}

			/*General Payment Return Update*/
			if(in_array($paypal_data['payment_method'], GATEWAY_ARR)){

				$gatewayData = array(
					'TRANSACTIONID'=>rand(),
					'ACK'=>'Success',
					'CORRELATIONID'=>rand(),
					'PAYER_ID'=>$paypal_data['user_id']
				);

				$this->common->direct_payments($gatewayData,$paypal_data,$paypal_data['type'],$paypal_data['payment_method']);

				$url 	= base_url().PAYMENT_SUCCESS;
				$this->success($paypal_data,$returnedData);
				return;
			}

			if(isset($_GET['token']) && isset($_GET['PayerID'])){
				$data = array(
				'token' 	=> $_GET['token'],
				'PayerID' 	=> $_GET['PayerID'],
				'currency' 	=> $paypal_data['currency'],
				'amount' 	=> $paypal_data['amount']
				);

				$this->load->library('paymentgateway',array('gateway'=>'PayPal_Express'));
				$returnedData = $this->paymentgateway->completePurchasePaypal($data);
			}
			else
			{
				if($type !== 'free'){

					$data = array(
					'token' 	=> $_GET['token'],
					'PayerID' 	=> '',
					'currency' 	=> $paypal_data['currency'],
					'amount' 	=> $paypal_data['amount']
					);

					$returnedData['ACK'] = 'FAILED';
				}
				else
				{
					foreach ($listing_data as $key) {
						$this->common->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
					}

					$url 	= base_url().PAYMENT_SUCCESS;
					$this->success($paypal_data,'');
					return;
				}
			}

			if($returnedData['ACK'] ==='Success'){
				
				$gatewayData = array(
					'TRANSACTIONID'=>rand(),
					'ACK'=>'Success',
					'CORRELATIONID'=>rand(),
					'PAYER_ID'=>$paypal_data['user_id']
				);

				$this->common->direct_payments($gatewayData,$paypal_data,$type,$paypal_data['payment_method']);

				$url 	= base_url().PAYMENT_SUCCESS;
				$this->success($paypal_data,$returnedData);
				return;
			}
			else if($returnedData['ACK'] ==='SuccessWithWarning'){

				$gatewayData = array(
					'TRANSACTIONID'=>rand(),
					'ACK'=>'Success',
					'CORRELATIONID'=>rand(),
					'PAYER_ID'=>$paypal_data['user_id']
				);

				$this->common->direct_payments($gatewayData,$paypal_data,$type,$paypal_data['payment_method']);

				$url 	= base_url().PAYMENT_SUCCESS;
				$this->success($paypal_data,$returnedData);
				return;
			}
			else
			{
				$url 	= base_url().PAYMENT_FAIL;
				$this->fail($paypal_data,$returnedData);
				return;
			}
		}

	} 

	/*Open Direct Contract*/
    public function open_direct_contract($listing_id){
        if(!empty($listing_id)){
        	$this->database->_update_to_table('tbl_opens',array('status'=>7),array('listing_id'=>$listing_id,'status'=>0));
            $listing    =  $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id));
            $data = array(
            	'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
            	'listing_id' => $listing_id,
            	'bid_id' => 'direct',
            	'type' => 'direct',
            	'customer_id' => $this->session->userdata('user_id'),
            	'owner_id' => $listing[0]['user_id'],
            	'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")),
            	'delivery' =>$listing[0]['deliver_in'],
            	'status' => 1,
            	'date' => date('Y-m-d H:i:s')
            );
            return $this->database->_insert_to_DB('tbl_opens',$data);
        }
        return;
    }

   
    /*Listing Payment*/
    public function proceedtoPayment(){
	 	if(!empty($this->session->userdata('user_id'))){
			if(!empty($this->input->post('cardType'))){
				if($this->input->post('cardType') !== 'free_checkout'){
					if($this->input->post('txt_payamount') > 0){
						$this->common_payment_handler($this->input->post('cardType'));
					}
					else
					{
						exit('Invalid request');
					}
				}
				else
				{
					$this->free_checkout();
				}
			}
		}
		else
		{
			$data['errors'] = 'Your login session has expired. Please login to continue';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout',$data);
			return;
		}
	}

	/*New Common Payment Gateway Handler*/
	public function common_payment_handler($gateway_id){

		$ListingDataArr = array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'code');
		$currency 			= 'USD';

		if(!empty($gateway_id)){
			$paymentData = $this->database->_get_row_data('tbl_payment_settings',array('paymentgateway_id'=>$gateway_id));
		}
		

		if(!empty($default_currency)) {
			$currency = $default_currency;
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$payment_id  		= $this->_generate_paymentID();
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];
		}

		if(!empty($this->input->post('txt_listingid')) && !empty($ListingData)){
			$redirectURL = base_url().'user/create_listings/'.$ListingData[0]['listing_type'].'/'.$ListingData[0]['id'];
			$this->session->set_userdata('url',$redirectURL);
		}

		if(!empty($userdata)){

			if(!empty($this->input->post('txt_sponsored_id'))){
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_sponsored_id')));
				if(isset($sponsoredArr[0]['listing_price'])){
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored)+floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'].' & '.$sponsoredArr[0]['listing_type'];					
				}

				$ListingDataArr[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $sponsoredArr[0]['listing_id'],
				'listing_type' => $sponsoredArr[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$sponsoredArr[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>$currency,
				'payment_method'=>$paymentData[0]['method'],
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$ListingDataHeader[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>$currency,
				'payment_method'=>$paymentData[0]['method'],
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL,
				'type' =>'internal'
			);

			$cardInput = array(
				'firstName'=>'',
				'lastName'=>'',
				'number'=>$this->input->post('txt_number'),
				'cvv'=>$this->input->post('txt_security-code'),
				'expiryMonth'=>$this->input->post('txt_month'),
				'expiryYear'=>$this->input->post('txt_year'),
				'email'=> $this->input->post('txt_useremail')
			);

			try
			{

				$this->session->set_userdata('paypal_data', $valTransc[0]);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
				$this->load->library($gateway_id ,NULL ,'paymentGateway');
				$data 	= $this->paymentGateway->purchase($cardInput,$valTransc[0],'','internal');

				if(isset($data['status'])){
					if($data['status'] === 'Success'){
						$this->success($data['valTransc'],$data['data']);
						return;
					}
					else
					{
						$this->fail($this->session->userdata('paypal_data'),$data['data']);
						return;
					}
				}
				else
				{
					$this->fail($this->session->userdata('paypal_data'),$data['data']);
					return;
				}
			}
			catch (Exception $e)
			{
				$valTransc = array(
					'user_id' => $userdata[0]['user_id'],
					'user_email' =>$userdata[0]['email'],
					'user_username' =>$userdata[0]['username'],
					'amount' => number_format($totalAmount, 2,'.',''),
					'transactionId'=>$payment_id,
					'currency'=>$currency,
					'payment_method'=>$paymentData[0]['method'],
					'clientIp'=>$this->input->ip_address(),
				);

				$this->fail($valTransc,$e->getMessage());
				return;
			}
		}	   
	}


	/*Free Checkout*/
	public function free_checkout(){
		$ListingDataArr 	= array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'code');
		$currency 			= 'USD';

		if(!empty($default_currency)) {
			$currency = $default_currency;
		}

		if(!empty($this->session->userdata('user_id'))){	
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];	

			if(!empty($this->input->post('txt_sponsored_id'))){
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_sponsored_id')));
				if(isset($sponsoredArr[0]['listing_price'])){
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored)+floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'].' & '.$sponsoredArr[0]['listing_type'];					
				}

				$ListingDataArr[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $sponsoredArr[0]['listing_id'],
				'listing_type' => $sponsoredArr[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$sponsoredArr[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>$currency,
				'payment_method'=>'FREE',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/free',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
			'user_id' => $userdata[0]['user_id'],
			'user_email' =>$userdata[0]['email'],
			'user_username' =>$userdata[0]['username'],
			'listing_id' => $ListingData[0]['id'],
			'plan_header' => $ListingDataHeader[0]['listing_id'],
			'listing_type' => $ListingDataHeader[0]['listing_type'],
			'amount' => number_format($totalAmount, 2,'.',''),
			'period' =>$ListingDataHeader[0]['listing_duration'],
			'transactionId'=>$payment_id,
			'description' => 'Listing :'.$listing_type,
			'currency'=>$currency,
			'payment_method'=>'FREE',
			'clientIp'=>$this->input->ip_address(),
			'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/free',
			'cancelUrl'=> base_url().PAYMENT_CANCEL
			);

			$cardInput = array(
			'firstName'=>'',
			'lastName'=>'',
			'number'=>'',
			'cvv'=>'',
			'expiryMonth'=>'',
			'expiryYear'=>'',
			'email'=>''
			);

			try
			{
				$this->session->set_userdata('paypal_data', $valTransc[0]);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
				header( "Location: ".base_url().PAYMENT_PAYPAL_RETURN.'/free' ); 
			}
			catch (Exception $e)
			{
    			$url 	= base_url().PAYMENT_FAIL;
    			$this->fail($valTransc);
			} 
		}
	}

	
	/*Unique Payment ID Generation*/
	private function _generate_paymentID($table='tbl_payments',$column='id'){
        do{
            $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);
            if ($salt === FALSE){
                $salt = hash('sha256', time() . mt_rand());
            }
            $new_key = substr($salt, 0, 10);
        }
        while ($this->database->_results_count($table,array($column=>$new_key)));
        return $new_key;
    }

    /*Success Return*/
    public function success($data,$returned){
		$DATA['PAYMENT'] 	= $data;
		$DATA['RETURNED']	= $returned;
		$DATA = html_escape($this->security->xss_clean($DATA));
		$this->load->view('payments/success',$DATA);
	}

	/*Fail Return*/
	public function fail($data,$reason=''){
		$DATA['PAYMENT'] 	= $data;
		$DATA['REASON'] 	= $reason;
		$DATA = html_escape($this->security->xss_clean($DATA));
		$this->load->view('payments/fail',$DATA);
	}

	/*Cancel Return*/
	public function cancel(){
		$this->load->view('payments/cancel');
	}

}
