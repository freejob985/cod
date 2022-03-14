<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

/*Paypal Pro Plugin Slippa*/

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class PayPal_Pro extends Omnipay {

	protected $gateway = null;
	protected $CI = null;

	public function __construct($test_mode = true){
		$this->CI =& get_instance();
    	$this->CI->load->model('DatabaseOperationsHandler', 'database');
    	$this->CI->load->model('CommonOperationsHandler', 'common');

		$paymentData = $this->CI->database->_get_row_data('tbl_payment_settings',array('paymentgateway_id'=>'PayPal_Pro'));

		if(!empty($paymentData)){
			$this->gateway = Omnipay::create((string) trim($paymentData[0]['paymentgateway_id']) );
			$this->gateway->setUsername(trim($paymentData[0]['username']));
			$this->gateway->setPassword(trim($paymentData[0]['password']));
			$this->gateway->setSignature(trim($paymentData[0]['signature']));
			$this->gateway->setTestMode(boolval($paymentData[0]['sandbox']));
		}
	}

	
	public function purchase($cardInput, $valTransaction,$itemsArr="" , $type ='internal'){
		$card = new CreditCard($cardInput);
		$payArray = array(
			'amount'=> $valTransaction['amount'],
			'transactionId' => $valTransaction['transactionId'],
			'description'=> $valTransaction['description'],
			'currency'=>$valTransaction['currency'],
			'clientIp'=>$valTransaction['clientIp'],
			'returnUrl'=> $valTransaction['returnUrl'],
			'card'=>$card
		);

		if(!empty($itemsArr))
		{
			$response = $this->gateway->purchase($payArray)->setItems($itemsArr)->send();
		}

		$response = $this->gateway->purchase($payArray)->send();

		if($response->isSuccessful())
		{
			$paypalResponse = $response->getData();
		}
		elseif($response->isRedirect())
		{
			$paypalResponse = $response->getRedirectData();
		}
		else
		{
			$paypalResponse = $response->getMessage();
		}

		return $this->decodeResponse($paypalResponse , $type);
	}

	private function decodeResponse($data , $type ='internal'){
		$valTransc[0] = $this->CI->session->userdata('paypal_data');

		if(isset($data['ACK']) && $data['ACK'] == 'Success'){
			$this->CI->common->direct_payments($data,$valTransc[0], $type ,'PAYPAL PRO');
			$url 	= base_url().PAYMENT_SUCCESS;
			$this->CI->session->unset_userdata('listing_data');
			$response = array(
				'status' => 'Success',
				'valTransc'=>$valTransc[0],
				'data'=> $data
			);
			return $response;
		}
		else
		{
			$url 	= base_url().PAYMENT_FAIL;
			$response = array(
				'status' => 'Fail',
				'valTransc'=>$valTransc[0],
				'data'=> $data
			);
			return $response;
		}
	}
}