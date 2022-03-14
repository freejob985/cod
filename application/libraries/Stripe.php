<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

/*Stripe Plugin Slippa */

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class Stripe extends Omnipay {

	protected $gateway = null;
	protected $CI = null;

	public function __construct($test_mode = true){
		$this->CI =& get_instance();
    	$this->CI->load->model('DatabaseOperationsHandler');
		$paymentData = $this->CI->DatabaseOperationsHandler->_get_row_data('tbl_payment_settings',array('paymentgateway_id'=>'Stripe'));

		if(!empty($paymentData)){
			$this->gateway = Omnipay::create((string) trim($paymentData[0]['paymentgateway_id']) );
			$this->gateway->setApiKey(trim($paymentData[0]['signature']));
		}
	}

	public function purchase($cardInput, $valTransaction,$itemsArr="" , $type ='internal'){
		$payArray = array(
			'amount' => $valTransaction['amount'],
			'currency' => $valTransaction['currency'],
			'description'=> $valTransaction['description'],
			'card' => $cardInput,
			'paymentMethod'=> $valTransaction['transactionId'],
			'returnUrl'=> $valTransaction['returnUrl'],
			'confirm'=> true,
		);

		if(!empty($itemsArr)){
			$response = $this->gateway->authorize($payArray)->setItems($itemsArr)->send();
		}

		$response = $this->gateway->authorize($payArray)->setItems($itemsArr)->send();
		if($response->isSuccessful())
		{
			$stripeResponse = $response->getData();
		}
		elseif($response->isRedirect())
		{
			$stripeResponse = $response->getRedirectUrl();
		}
		else
		{
			$stripeResponse = $response->getMessage();
		}

		return $this->decodeResponse($stripeResponse , $type);
	}

	private function decodeResponse($data , $type ='internal'){

		$newData = array(
			'TRANSACTIONID'=>$data['id'],
			'ACK'=>$data['status'],
			'CORRELATIONID'=>$data['source']['fingerprint'],
			'PAYER_ID'=>$data['source']['last4']
		);

		$valTransc[0] = $this->CI->session->userdata('paypal_data');

		if(isset($data['status']) && $data['status'] == 'succeeded'){

			$this->CI->common->direct_payments($newData,$valTransc[0], $type ,'Stripe');
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