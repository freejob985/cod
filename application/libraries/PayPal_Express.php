<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

/*Paypal Express Plugin Slippa */

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class PayPal_Express extends Omnipay {

	protected $gateway = null;
	protected $CI = null;

	public function __construct($test_mode = true){
		$this->CI =& get_instance();
    	$this->CI->load->model('DatabaseOperationsHandler','database');
		$paymentData = $this->CI->database->_get_row_data('tbl_payment_settings',array('paymentgateway_id'=>'PayPal_Express'));

		if(!empty($paymentData)){
			$this->gateway = Omnipay::create((string) trim($paymentData[0]['paymentgateway_id']) );
			$this->gateway->setUsername(trim($paymentData[0]['username']));
			$this->gateway->setPassword(trim($paymentData[0]['password']));
			$this->gateway->setSignature(trim($paymentData[0]['signature']));
			$this->gateway->setTestMode(boolval($paymentData[0]['sandbox']));
		}
	}

	
	public function purchase($cardInput, $valTransaction,$itemsArr="" , $type ='internal'){
		$payArray = array(
			'amount'=> $valTransaction['amount'],
			'transactionId' => $valTransaction['transactionId'],
			'description'=> $valTransaction['description'],
			'currency'=>$valTransaction['currency'],
			'clientIp'=>$valTransaction['clientIp'],
			'returnUrl'=> $valTransaction['returnUrl'],
			'cancelUrl'=> $valTransaction['cancelUrl']
		);

		if(!empty($itemsArr)){
			$response = $this->gateway->purchase($payArray)->setItems($itemsArr)->send();
		}

		$response = $this->gateway->purchase($payArray)->setItems($itemsArr)->send();
		if($response->isSuccessful())
		{
			$paypalResponse = $response->getData();
		}
		elseif($response->isRedirect())
		{
			$paypalResponse = $response->getRedirectUrl();
		}
		else
		{
			$paypalResponse = $response->getMessage();
		}

		$url 	= $paypalResponse;
		header( "Location: $url" );
		return $paypalResponse; 
	}
}