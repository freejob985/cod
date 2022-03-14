<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EscrowOperationsHandler extends CI_Model
{
	function __construct(){
		parent::__construct();
        $this->load->database();
        $this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('EmailOperationsHandler', 'email_op');
	}

    /*read given escrow transactions*/
	public function _read_transaction($id='3047481'){
		return json_decode($this->_execute_escrow('','transaction/'.$id),true);
	}

	public function _get_disbursement_method($id='3022957'){
		return json_decode($this->_execute_escrow('','transaction/'.$id.'/disbursement_methods'),true);
	}

    /*confirm wire escrow transactions*/
	public function _confirm_wire_transfer($transid){
		return json_decode($this->_execute_escrow('','transaction/'.$transid.'/payment_methods/wire_transfer',true),true);
	}

    /*list partner escrow transactions*/
    public function _list_partner_transactions(){
        return json_decode($this->_execute_escrow('','partner/transactions',false),true);
    }

    /*list all transactions*/
    public function _list_transactions($page=1){
        return json_decode($this->_execute_escrow('','transaction?page='.$page),true);
    }

    /*set disbusment method*/
	public function _set_disbursement_method($transid,$id){
		$data = array('id' => $id,);
		return json_decode($this->_execute_escrow($data,'transaction/'.$transid.'/disbursement_methods'),true);
	}

    /*escrow payment methods*/
	public function _get_payment_methods($transid,$method=''){
		if(!empty($method)){
			if($method === 'paypal'|| $method === 'credit_card') {
				$data = array( 'return_url' => base_url().'payments/escrow_success/'.$transid,);
				return $this->_execute_escrow($data,'transaction/'.$transid.'/payment_methods/'.$method);
			}

			return $this->_execute_escrow('','transaction/'.$transid.'/payment_methods/'.$method);
		}
		else
		{
			return json_decode($this->_execute_escrow('','transaction/'.$transid.'/payment_methods'),true);
		}
		
	}

    /*escrow payment link*/
	public function _get_payment_link($transid){
		return print_r($this->_execute_escrow('','transaction/'.$transid.'/web_link'));
	}

    /*create contrcat transaction escrow*/
    public function _create_transaction_contract($id,$trans_type,$run_as='seller'){
        $credentails    = $this->DatabaseOperationsHandler->_get_row_data('tbl_payment_settings',array('id'=>4,'status'=>1));
        $settings       = $this->database->getSettingsData();

        if(!empty($settings[0]['mark_as_completed'])){
            $inspection_period = intval($settings[0]['mark_as_completed']) * 86400;
        }
        else
        {
            $inspection_period = 259200;
        }

        if($settings[0]['escrow_run_as_broker'] === '1'){
            $run_as='broker';
        }

        if(!empty($id) && !empty($trans_type)){

            if($trans_type === 'bid'){
                $bid            = $this->database->_get_row_data('tbl_bids',array('id'=>$this->input->post('o_bid_id_cont'),'bid_status'=>1));
                $buyer_data     = $this->database->getUserData($bid[0]['bidder_id']);
                $pay_total      = $bid[0]['bid_amount'];
            }
            else if($trans_type === 'offer'){
                $bid           = $this->database->_get_offer($this->input->post('offer_id'));
                $buyer_data    = $this->database->getUserData($bid[0]['customer_id']);
                $pay_total     = $bid[0]['offer_amount'];
            }

            if(!empty($bid[0]['id'])){
                $listing_info   = $this->DatabaseOperationsHandler->_get_row_data('tbl_listings',array('id'=>$bid[0]['listing_id']));

                if(!empty($listing_info)){
                    $seller_data    = $this->database->getUserData($listing_info[0]['user_id']);
                    
                    if(empty($seller_data[0]['escrow_email'])){
                        exit('No seller escrow email found');
                    }

                    if(empty($buyer_data[0]['escrow_email'])){
                        exit('No seller escrow email found');
                    }

                    $with_content = false;
                    $type = 'domain_name';

                    if(!empty($listing_info)){

                        if($listing_info[0]['listing_type'] === 'website'){
                            $with_content = true;
                            $type = 'domain_name';
                        }
                        else if($listing_info[0]['listing_type'] === 'app'){
                            $with_content = true;
                            $type = 'general_merchandise';
                        }

                        if($run_as === 'seller' || $seller_data[0]['escrow_email'] === $credentails[0]['username']){
                            $beneficiary_customer = 'me';
                        }
                        else
                        {
                            $beneficiary_customer = $seller_data[0]['escrow_email'];
                        }

                        $itemobj = array(
                            'description' => $listing_info[0]['website_BusinessName'],
                            'schedule' => array(
                                array(
                                    'payer_customer' => $buyer_data[0]['escrow_email'],
                                    'amount' => $pay_total,
                                    'beneficiary_customer' => $beneficiary_customer,
                                ),
                            ),
                            'title' => $listing_info[0]['website_BusinessName'],
                            'inspection_period' => $inspection_period,
                            'type' => $type,
                            'quantity' => '1',
                            'extra_attributes' => array(
                                'concierge' => false,
                                'with_content' => $with_content,
                            ),
                        );

                        $appobj = array(
                            'description' => $listing_info[0]['website_BusinessName'],
                            'schedule' => array(
                                array(
                                    'payer_customer' => $buyer_data[0]['escrow_email'],
                                    'amount' => $pay_total,
                                    'beneficiary_customer' => $beneficiary_customer,
                                ),
                            ),
                            'title' => $listing_info[0]['website_BusinessName'],
                            'inspection_period' => $inspection_period,
                            'type' => $type,
                            'quantity' => '1'
                        );

                        $defaultObj = $itemobj;

                        if($listing_info[0]['listing_type'] === 'website'){
                            $defaultObj = $itemobj;
                        }
                        else if($listing_info[0]['listing_type'] === 'app'){
                            $defaultObj = $appobj;
                        }
                        else if($listing_info[0]['listing_type'] === 'domain'){
                            $defaultObj = $itemobj;
                        }
                    }

                    if(!empty($credentails)){

                        if($run_as === 'seller' || $seller_data[0]['escrow_email'] === $credentails[0]['username']){

                            $run_as = 'seller';

                            $data = array(
                                'currency' => strtolower($credentails[0]['payment_currency']),
                                'items' => array($defaultObj),
                                'description' => 'The sale of '.$listing_info[0]['listing_type'].' '.$listing_info[0]['website_BusinessName'],
                                'parties' => array(
                                    array(
                                        'customer' => $buyer_data[0]['escrow_email'],
                                        'role' => 'buyer',
                                    ),
                                    array(
                                        'customer' => 'me',
                                        'role' => 'seller',
                                    ),
                                ),
                            );

                        }
                        else if($run_as === 'broker' || $run_as === 'partner'){
                
                            if(!empty($settings[0]['sale_commission'])){
                                $commision  = $settings[0]['sale_commission'];
                                $broker_fee = (floatval($pay_total) * $commision ) / 100;
                            }
                            else
                            {
                                $broker_fee = 0;
                            }
                
                            $data = array(
                                'currency' => strtolower($credentails[0]['payment_currency']),
                                'items' => array($defaultObj,
                                    array(
                                        'type' => 'broker_fee',
                                        'schedule' => array(
                                        array(
                                                'payer_customer' => $seller_data[0]['escrow_email'],
                                                'amount' => $broker_fee,
                                                'beneficiary_customer' => 'me',
                                            ),
                                        ),
                                    ),
                                ),
                                'description' => 'The sale of '.$listing_info[0]['listing_type'].' '.$listing_info[0]['website_BusinessName'],
                                'parties' => array(
                                    array(
                                        'customer' => 'me',
                                        'role' => 'broker',
                                    ),
                                    array(
                                        'customer' => $buyer_data[0]['escrow_email'],
                                        'role' => 'buyer',
                                    ),
                                    array(
                                        'customer' => $seller_data[0]['escrow_email'],
                                        'role' => 'seller',
                                    ),
                                ),
                            );
                        }

                        if($run_as === 'seller'|| $run_as === 'broker' || $run_as === 'partner'){

                            $returned_data = $this->_execute_escrow($data);

                            if(!empty($returned_data)){
                                $returned_data = json_decode($returned_data,true);

                                $escrowdata = array(
                                    'payment_type' =>$run_as,
                                    'transaction_id' =>$returned_data['id'],
                                    'buyer_id' =>$buyer_data[0]['user_id'],
                                    'seller_id' =>$seller_data[0]['user_id'],
                                    'status' => '0'
                                );


                                $contractArr= array(
                                    'user_id' =>$seller_data[0]['user_id'],
                                    'domain_id' =>0,
                                    'contract_id' =>$contract_id,
                                    'listing_id' =>$listing_info[0]['id'],
                                    'amount' =>$listing_info[0]['website_buynowprice'],
                                    'invoice_id' =>$escrowdata['transaction_id'],
                                    'contract_method' =>'escrow',
                                );

                                if($trans_type === 'bid'){

                                    $data_open = array(
                                        'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
                                        'listing_id' => $bid[0]['listing_id'],
                                        'bid_id' => $bid[0]['id'],
                                        'type' => $trans_type,
                                        'customer_id' => $bid[0]['bidder_id'],
                                        'owner_id' => $seller_data[0]['user_id'],
                                        'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing_info[0]['deliver_in']." day")),
                                        'delivery' =>$listing_info[0]['deliver_in'],
                                        'status' => 0,
                                        'date' => date('Y-m-d H:i:s'),
                                        'contract_method'=>'escrow' 
                                    );
                                }
                                else if($trans_type === 'offer'){
                                    $data_open = array(
                                        'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
                                        'listing_id' => $bid[0]['listing_id'],
                                        'bid_id' => $bid[0]['id'],
                                        'type' => $trans_type,
                                        'customer_id' => $bid[0]['bidder_id'],
                                        'owner_id' => $bid[0]['owner_id'],
                                        'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing_info[0]['deliver_in']." day")),
                                        'delivery' =>$listing_info[0]['deliver_in'],
                                        'status' => 0,
                                        'date' => date('Y-m-d H:i:s'),
                                        'contract_method'=>'escrow' 
                                    );
                                }

                                $insert_id = $this->database->_insert_to_DB('tbl_opens',$data_open);

                                if(!empty($insert_id)){

                                    $contractArr['contract_id'] = $insert_id;
                                    $this->database->_insert_to_table('tbl_contracts',$contractArr);

                                    if($trans_type === 'bid'){
                                        $this->database->_update_to_table('tbl_bids',array('bid_status'=>'6'),array('id'=>$bid[0]['id']));
                                        if($datas['settings'][0]['email_notifications'] === '1'){
                                            //$this->email_op->_user_email_notification('won-bid',$data_open);
                                        }  
                                    }
                                    else if($trans_type === 'offer'){
                                        $this->database->_update_to_table('tbl_offers',array('offer_status'=>'6'),array('id'=>$bid[0]['id']));

                                        if($datas['settings'][0]['email_notifications'] === '1'){
                                            //$this->email_op->_user_email_notification('accept-offer',$data_open);
                                        }  
                                    }
                                    
                                    if(!empty($insert_id)){
                                        redirect('user/contract/'.$insert_id);
                                        return;
                                    }
                                }
                            }
                        }
                    }

                }
                else
                {
                    exit('No seller details found');
                }
            }

            
            
        }
        else
        {
            exit('No products found');
        }
    }

    /*Create Direct Transaction*/
	public function _create_transaction($run_as='seller'){
		$credentails 	= $this->DatabaseOperationsHandler->_get_row_data('tbl_payment_settings',array('id'=>4,'status'=>1));
		$settings  		= $this->database->getSettingsData();

		if($settings[0]['escrow_run_as_broker'] === '1'){
			$run_as='broker';
		}

        if(!empty($settings[0]['mark_as_completed'])){
            $inspection_period = intval($settings[0]['mark_as_completed']) * 86400;
        }
        else
        {
            $inspection_period = 259200;
        }

		if(!empty($this->input->post('txt_id'))){
			$listing_info 	= $this->DatabaseOperationsHandler->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_id')));
			if(!empty($listing_info)){
				$seller_data 	= $this->database->getUserData($listing_info[0]['user_id']);
				if(empty($seller_data[0]['escrow_email'])){
					exit('No seller escrow email found');
				}
			}
			else
			{
				exit('No seller details found');
			}
		}
		else
		{
			exit('No products found');
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->common->_generate_paymentID();
		}

		if(!empty($this->input->post('txt_type'))){
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale ='direct';
        			break;
        		case 'contract':
					$sale ='contract';
        			break;
    			default:
    				return ;
			}
		}

		if(!empty($user_data) && !empty($this->input->post('escrow_buyer_email'))){

            $with_content = false;
            $type = 'domain_name';
            
            if(!empty($listing_info)){

                if($listing_info[0]['listing_type'] === 'website'){
                    $with_content = true;
                    $type = 'domain_name';
                }
                else if($listing_info[0]['listing_type'] === 'app'){
                    $with_content = true;
                    $type = 'general_merchandise';
                }

                if($run_as === 'seller' || $seller_data[0]['escrow_email'] === $credentails[0]['username']){
                    $beneficiary_customer = 'me';
                }
                else
                {
                    $beneficiary_customer = $seller_data[0]['escrow_email'];
                }

                $itemobj = array(
                    'description' => $this->input->post('txt_description'),
                    'schedule' => array(
                        array(
                            'payer_customer' => $this->input->post('escrow_buyer_email'),
                            'amount' => $this->input->post('txt_paytotal'),
                            'beneficiary_customer' => $beneficiary_customer,
                        ),
                    ),
                    'title' => $this->input->post('txt_description'),
                    'inspection_period' => $inspection_period,
                    'type' => $type,
                    'quantity' => '1',
                    'extra_attributes' => array(
                        'concierge' => false,
                        'with_content' => $with_content,
                    ),
                );

                $appobj = array(
                    'description' => $this->input->post('txt_description'),
                    'schedule' => array(
                        array(
                            'payer_customer' => $this->input->post('escrow_buyer_email'),
                            'amount' => $this->input->post('txt_paytotal'),
                            'beneficiary_customer' => $beneficiary_customer,
                        ),
                    ),
                    'title' => $this->input->post('txt_description'),
                    'inspection_period' => $inspection_period,
                    'type' => $type,
                    'quantity' => '1',
                );

                $defaultObj = $itemobj;

                if($listing_info[0]['listing_type'] === 'website'){
                    $defaultObj = $itemobj;
                }
                else if($listing_info[0]['listing_type'] === 'app'){
                    $defaultObj = $appobj;
                }
                else if($listing_info[0]['listing_type'] === 'domain'){
                    $defaultObj = $itemobj;
                }
            }

			if(!empty($credentails)){

			if($run_as === 'seller' || $seller_data[0]['escrow_email'] === $credentails[0]['username']){

                $run_as = 'seller';

				$data = array(
            		'currency' => strtolower($credentails[0]['payment_currency']),
            		'items' => array($defaultObj),
            		'description' => 'The sale of '.$listing_info[0]['listing_type'].' '.$this->input->post('txt_description'),
            		'parties' => array(
                		array(
                    		'customer' => $this->input->post('escrow_buyer_email'),
                    		'role' => 'buyer',
                		),
                		array(
                    		'customer' => 'me',
                    		'role' => 'seller',
               	 		),
            		),
        		);
        	}
        	else if($run_as === 'broker' || $run_as === 'partner'){

        		if(!empty($settings[0]['sale_commission'])){
        			$commision 	= $settings[0]['sale_commission'];
        			$broker_fee = (floatval($this->input->post('txt_paytotal')) * $commision ) / 100;
        		}
        		else
        		{
        			$broker_fee = 0;
        		}
        		
        		$data = array(
            		'currency' => strtolower($credentails[0]['payment_currency']),
            		'items' => array($defaultObj,
                		    array(
                    		  'type' => 'broker_fee',
                    		  'schedule' => array(
                        	   array(
                            	   'payer_customer' => $seller_data[0]['escrow_email'],
                            	   'amount' => $broker_fee,
                            	   'beneficiary_customer' => 'me',
                        	   ),
                    	   ),
                        ),
                	),
            		'description' => 'The sale of '.$listing_info[0]['listing_type'].' '.$this->input->post('txt_description'),
            		'parties' => array(
            			array(
                    		'customer' => 'me',
                    		'role' => 'broker',
                		),
                		array(
                    		'customer' => $this->input->post('escrow_buyer_email'),
                    		'role' => 'buyer',
                		),
                		array(
                    		'customer' => $seller_data[0]['escrow_email'],
                    		'role' => 'seller',
               	 		),
            		),
        		);
        	}
		}
			if($run_as === 'seller'|| $run_as === 'broker' || $run_as === 'partner'){

				$returned_data = $this->_execute_escrow($data);

				if(!empty($returned_data)){

					$returned_data = json_decode($returned_data,true);

                    if(!isset($returned_data['id'])){
                        $dataes['PAYMENT']  = $data;
                        $dataes['REASON']   = 'Sorry, Cannot Connect With Escrow';
                        $this->load->view('payments/fail',$dataes);
                    }

					$escrowdata = array(
						'payment_type' =>'seller',
						'transaction_id' =>$returned_data['id'],
						'buyer_id' =>$user_data[0]['user_id'],
						'seller_id' =>$seller_data[0]['user_id'],
                    	'status' => '0'
					);

					$contract = array(
                		'user_id' =>$user_data[0]['user_id'],
                		'domain_id' =>0,
                		'listing_id' =>$listing_info[0]['id'],
                		'amount' =>$listing_info[0]['website_buynowprice'],
                		'invoice_id' =>$escrowdata['transaction_id'],
                	);

                	$contract_id = $this->common->open_direct_contract($contract['listing_id'],'escrow');

                	$Arr['contract_id'] = $contract_id;

                	$contractArr= array(
                		'user_id' =>$user_data[0]['user_id'],
                		'domain_id' =>0,
                		'contract_id' =>$contract_id,
                		'listing_id' =>$contract['listing_id'],
                		'amount' =>$listing_info[0]['website_buynowprice'],
               	 		'invoice_id' =>$escrowdata['transaction_id'],
               	 		'contract_method' =>'escrow',
                	);

                	if($this->database->_update_to_table('tbl_listings',array('sold_status' => 0),array('id'=>$contract['listing_id']))){
                    	if(!empty($contract_id)){
                        	if($this->database->_insert_to_table('tbl_contracts',$contractArr)){
                                $contract_seq   = $this->database->_get_single_data('tbl_opens',array('id'=>$contract_id,'contract_method'=>'escrow'),'contract_id');
        						$successURL = base_url().'user/contract/'.$contract_seq;
        						redirect($successURL);   
                        	}
                    	}
                	}
				}
			}
		}
	}

    /*Execute Escrow*/
	public function _execute_escrow($arr,$urltype='transaction',$custom=false){
		$credentails = $this->DatabaseOperationsHandler->_get_row_data('tbl_payment_settings',array('id'=>4,'status'=>1));

		if(!empty($credentails)){
			
			if($credentails[0]['sandbox']){
				$url = 'https://api.escrow-sandbox.com/2017-09-01/';
			}
			else
			{
				$url = 'https://api.escrow.com/2017-09-01/';
			}

			$curl = curl_init();
			if(!empty($arr)){
				curl_setopt_array($curl, array(
    			CURLOPT_URL => $url.$urltype,
    			CURLOPT_RETURNTRANSFER => 1,
    			CURLOPT_USERPWD => $credentails[0]['username'].':'.$credentails[0]['signature'],
    			CURLOPT_HTTPHEADER => array(
        			'Content-Type: application/json'
    			),
    			CURLOPT_POSTFIELDS =>json_encode($arr)));
			}
			else
			{
                if($custom){
				    curl_setopt_array($curl, array(
    			     CURLOPT_URL => $url.$urltype,
    			     CURLOPT_RETURNTRANSFER => 1,
    			     CURLOPT_USERPWD => $credentails[0]['username'].':'.$credentails[0]['signature'],
    			     CURLOPT_HTTPHEADER => array(
        			     'Content-Type: application/json'
    			     ),
                        CURLOPT_CUSTOMREQUEST => 'POST'
                    ));
                }
                else
                {
                     curl_setopt_array($curl, array(
                     CURLOPT_URL => $url.$urltype,
                     CURLOPT_RETURNTRANSFER => 1,
                     CURLOPT_USERPWD => $credentails[0]['username'].':'.$credentails[0]['signature'],
                     CURLOPT_HTTPHEADER => array(
                         'Content-Type: application/json'
                     )));
                }
			}

    		$output = curl_exec($curl);
    		curl_close($curl);
			return $output;
		}

		return false;
	}
}