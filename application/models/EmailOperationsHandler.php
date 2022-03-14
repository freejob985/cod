<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailOperationsHandler extends CI_Model
{
	private static $data = array();

  function __construct() {
    $this->load->database();
    parent::__construct();
    $this->load->helper(array('helperssl'));
    $this->load->model('chat/ChatOperationsHandler', 'chat');
    $this->load->model('DatabaseOperationsHandler', 'database');
    $this->load->model('CommonOperationsHandler', 'common');

    /*Load Defaults*/
    self::$data['settings']               =   $this->database->getSettingsData();
    self::$data['languages']              =   $this->database->load_all_languages();
    self::$data['default_currency']       = $this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'symbol');
    self::$data['selectedLanguage']       =   $this->common->is_language();
    self::$data['imagesData']             =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
    self::$data['email']                  =   $this->database->_get_row_data('tbl_email_settings',array('id'=>1));


    /*email configuration*/
    $this->load->library('email');
    $config = array();
    $config['protocol']     = self::$data['email'][0]['mail_sending_option']; 
    $config['smtp_host']    = self::$data['email'][0]['mail_smtp_server'];
    $config['smtp_user']    = self::$data['email'][0]['mail_smtp_user'];  
    $config['smtp_pass']    = self::$data['email'][0]['mail_smtp_password']; 
    $config['smtp_port']    = self::$data['email'][0]['mail_smtp_port'];
    $config['smtp_crypto']  = self::$data['email'][0]['mail_smtp_encryption'];
    $config['smtp_timeout'] = 5;   
    $config['mailtype']   = 'html';   
    $config['charset']    = 'iso-8859-1';
    $this->load->library('email', $config);
    $this->email->set_mailtype("html");
    $this->email->set_newline("\r\n");
  }

  public function languageDefine() {

    $data = array();
    $data['welcome']                =   $this->lang->line('lang_email_welcome');
    $data['onBoard1']               =   $this->lang->line('lang_email_onboard_1');
    $data['onBoard2']               =   $this->lang->line('lang_email_onboard_2');
    $data['activateAccount']        =   $this->lang->line('lang_email_activate_account');
    $data['newFeatures']            =   $this->lang->line('lang_email_new_features');
    $data['newFeaturesDsc']         =   $this->lang->line('lang_email_new_features_desc');
    $data['viewPricing']            =   $this->lang->line('lang_email_new_view_pricing');
    $data['viewBrowser']            =   $this->lang->line('lang_email_new_view_browser');
    $data['unsubscribe']            =   $this->lang->line('lang_email_new_unsubscribe');
    $data['footerCopyrights']       =   $this->lang->line('lang_email_new_footer_coprights');
    $data['contactBtn']             =   $this->lang->line('lang_email_new_contact');
    $data['invoiceHeader']          =   $this->lang->line('lang_email_account_invoice');
    $data['invoiceAmount']          =   $this->lang->line('lang_email_account_amount');
    $data['thanksPay']              =   $this->lang->line('lang_email_account_thanks');
    $data['viewAccount']            =   $this->lang->line('lang_email_new_view_account');
    $data['getInTouch']             =   $this->lang->line('lang_email_new_get_in_touch');
    $data['feedback']               =   $this->lang->line('lang_email_new_feedback');
    $data['titleFacebook']          =   $this->lang->line('lang_email_new_facebook');
    $data['titleTwitter']           =   $this->lang->line('lang_email_new_twitter');
    $data['titleSupport']           =   $this->lang->line('lang_email_new_support');
    $data['titleNotification']      =   $this->lang->line('lang_email_new_notific');
    $data['titleCheckNow']          =   $this->lang->line('lang_email_check_now');
    $data['titleInvoice']           =   $this->lang->line('lang_email_invoice_title');

    $data['invThankyou']            =   $this->lang->line('lang_email_invoice_thankyou');
    $data['invReview']              =   $this->lang->line('lang_email_invoice_review');

    $data['invPlan']                =   $this->lang->line('lang_email_invoice_header_plan');
    $data['invPeriod']              =   $this->lang->line('lang_email_invoice_header_period');
    $data['invAmount']              =   $this->lang->line('lang_email_invoice_header_amount');

    $data['btnResetPassword']       =   $this->lang->line('lang_email_reset_password');
    $data['ResetPasswordTitle']     =   $this->lang->line('lang_email_reset_password_title');
    $data['ResetPasswordDesc']      =   $this->lang->line('lang_email_reset_password_desc');

    $data['titleAmountOf']          =   $this->lang->line('lang_email_amount_of');
    $data['titlePaymentMethod']     =   $this->lang->line('lang_email_payment_method');
    $data['titleFeelFree']          =   $this->lang->line('lang_email_feel_free');
    $data['titleRegardInvoice']     =   $this->lang->line('lang_email_regard_invoice');
    $data['sincerely']              =   $this->lang->line('lang_email_sincerely');

    return $data;
 }

 public function getEmailTemplate($email,$token,$templates){
  $data = array();
  $data = $this->languageDefine();
  $template             = $this->load->view($templates, $data, TRUE);
  $settingsData         = $this->DatabaseOperationsHandler->getSettingsData();
  $imageData            = $this->DatabaseOperationsHandler->_get_row_data('tbl_siteimages',array('id'=>1));
  $data['template']     = $template;

  $data['sitename']       = $this->lang->line('site_name') ;

  $data['facebook']       = $settingsData[0]['user_facebook'];
  $data['instagram']      = $settingsData[0]['user_twitter'];
  $data['twitter']        = $settingsData[0]['user_Instagram'];
  $data['gihub']          = $settingsData[0]['user_github'];

  if(isset($imageData['sitelogo']) && !empty($imageData['sitelogo'])){
    $data['logo']         = base_url().'assets/img/'.$imageData['sitelogo'];
  }
  else
  {
    $data['logo']         = "n/a";
  }

  if($templates === 'templates/confirmation_email.tpl'){
    $data['activation_link'] = base_url().'activate/'.$token;
  }
  else
  {
    $data['activation_link'] = base_url().'reset/'.$token;
  }

  $emptyCheck  = trim($data['template']);

  if(isset($data['template']) && !empty($emptyCheck))
  {
   foreach($data as $key => $value)
   {
     $template = str_replace('{{ '.$key.' }}', $value, $template);
   }

   return $template;
 }
 else
 {
   return 'false';
 }

 return $template;
}

public function buildPurchaseEmailTemplate($email,$data,$template){
  $settingsData   = $this->DatabaseOperationsHandler->getSettingsData();
  $imageData      = $this->DatabaseOperationsHandler->_get_row_data('tbl_siteimages',array('id'=>1));
  $template       = $this->load->view($template, $data, TRUE);

  $data['template']       = $template;
  $data['date']           = date('Y-m-d');
  $data['expireDate']     = date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$data['period']."day"));
  $data['plan']           = $membershipData[0]['membership_name'] .'- ('.$membershipData[0]['membership_price'].' '.$data['currency'] .' )' ;
  $data['pmethod']        = $data['payment_method'];
  $data['sitename']       = $this->lang->line('site_name') ;

  $data['facebook']       = $settingsData[0]['user_facebook'];
  $data['instagram']      = $settingsData[0]['user_twitter'];
  $data['twitter']        = $settingsData[0]['user_Instagram'];
  $data['gihub']          = $settingsData[0]['user_github'];

  if(isset($imageData['sitelogo']) && !empty($imageData['sitelogo'])){
    $data['logo']         = base_url().'assets/img/'.$imageData['sitelogo'];
  }
  else
  {
    $data['logo']         = "n/a";
  }

  $emptyCheck=trim($data['template']);

  if(isset($data['template']) && !empty($emptyCheck))
  {
    foreach($data as $key => $value)
    {
      $template = str_replace('{{ '.$key.' }}', $value, $template);
    }

    return $template;
  }
  else
  {
    return 'false';
  }

  return $template;
}

public function sendUserActivationmail($email,$token){
  $datas  = self::$data;
  $emailBody = $this->getEmailTemplate($email,$token,'templates/confirmation_email.tpl');

  $this->email->to($email);
  if(isset($datas['settings'][0]['admin_email_copy'])){
    $this->email->bcc($datas['settings'][0]['admin_email_copy']);
  }

  $this->email->from($datas['email'][0]['site_email'],$datas['email'][0]['site_email_name']);
  $this->email->subject($this->lang->line('lang_email_account_activation_sub'));
  $this->email->message($emailBody);

  if($this->email->send())
  {
    $this->email->print_debugger();
  }
  else
  {
    $this->email->print_debugger();
  }
}

public function sendPasswordResetEmail($email,$token){
  $datas  = self::$data;
  $emailBody = $this->getEmailTemplate($email,$token,'templates/reset_email.tpl');

  $this->email->to($email);
  if(isset($datas['settings'][0]['admin_email_copy']))
  {
    $this->email->bcc($datas['settings'][0]['admin_email_copy']);
  }
  $this->email->from($datas['email'][0]['site_email'],$datas['email'][0]['site_email_name']);
  $this->email->subject($this->lang->line('lang_email_account_password_reset'));
  $this->email->message($emailBody);

  if($this->email->send())
  {
    $this->email->print_debugger();
  }
  else
  {
    $this->email->print_debugger();
  }
}

public function _send_invoice_email($type,$tempdata,$meth=''){
  $datas  = self::$data;

  $data                   = $this->languageDefine();
  $data['siteurl']        = base_url();
  $data['contact_us']     = base_url().'contact';
  $data['date']           = date('Y-m-d');
  $data['sitename']       = $this->lang->line('site_name');
  $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
  $data['facebook']       = $datas['settings'][0]['user_facebook'];
  $data['twitter']        = $datas['settings'][0]['user_Instagram'];
  $data['office_add1']    = $datas['settings'][0]['office_add1'];
  $data['office_add2']    = $datas['settings'][0]['office_add2'];
  $data['office_tel']     = $datas['settings'][0]['office_tel'];
  $data['office_email']   = $datas['settings'][0]['office_email'];
  $data['currency']       = $datas['default_currency'];

  switch ($type) {
    case 'payment':
    if(!empty($tempdata)){
      $emailtemp              = 'templates/invoice_email.tpl'; 
      $customer               = $this->database->getUserData($tempdata['user_id']);   
      $listing                = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
      $data['customer_name']  = $customer[0]['username'];
      $recipient              = $customer[0]['email'];
      $data['invoice']        = $tempdata['transactionId'];
      $data['subject']        = $this->lang->line('lang_email_account_payment_recived');
      $data['detail']         = $this->lang->line('lang_email_account_payment_dt_1') .$data['currency'].$tempdata['amount'].$this->lang->line('lang_email_account_payment_dt_2').$tempdata['transactionId'];
      $data['template']       = $this->load->view('templates/invoice_email.tpl', $data, TRUE);
      $template               = $data['template']; 
      $data['header_domain']  = $this->lang->line('lang_email_account_domain_website');
      $data['domain']         = $listing[0]['website_BusinessName'];
      $data['header_qty']     = $this->lang->line('lang_email_account_domain_website');
      $data['type']           = $listing[0]['listing_type'];
      $data['amount']         = $data['currency'].$tempdata['amount'];
      $this->_email_creator($data,$template,$recipient,$data['subject']);

      if($meth === 'direct'){
        $this->_user_email_notification('direct-purchase',$tempdata);
        $this->_user_email_notification('notify-owner',$tempdata);
      }
      else
      {
        $this->_user_email_notification('notify-owner',$tempdata);
      }
    }
    break;
    case 'listing':
    if(!empty($tempdata)){
      $emailtemp              = 'templates/invoice_email.tpl'; 
      $customer               = $this->database->getUserData($tempdata['user_id']);   
      $listing                = $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$tempdata['plan_header']),true);
      $data['customer_name']  = $customer[0]['username'];
      $recipient              = $customer[0]['email'];
      $data['invoice']        = $tempdata['invoice_id'];
      $data['subject']        = $this->lang->line('lang_email_account_activate_listing');
      $data['detail']         = $this->lang->line('lang_email_account_activate_dt_1').$data['currency'].$listing[0]['listing_price'].$this->lang->line('lang_email_account_activate_dt_2').$tempdata['invoice_id'];
      $data['template']       = $this->load->view('templates/invoice_email.tpl', $data, TRUE);
      $template               = $data['template']; 
      $data['header_domain']  = $this->lang->line('lang_email_account_listing_type');
      $data['domain']         = $listing[0]['listing_name'];
      $data['header_qty']     = $this->lang->line('lang_email_account_validty_period');
      $data['type']           = date('F d Y',strtotime($tempdata['purchase_date'])) .' - '.date('F d Y',strtotime($tempdata['expire_date']));
      $data['amount']         = $data['currency'].$listing[0]['listing_price'];
      $this->_email_creator($data,$template,$recipient,$data['subject']);
    }
    break;
  }
}

/*Send contact email*/
public function _send_contact_email(){
  $data  = self::$data;
  $this->email->to($data['settings'][0]['office_email']);
  if(isset($data['settings'][0]['admin_email'])){
    $this->email->bcc($data['settings'][0]['admin_email']);
  }

  $this->email->from($this->input->post('contact_email'));
  $this->email->subject($this->lang->line('site_name').' Contact Form -'.$this->input->post('contact_subject'));
  $this->email->message($this->input->post('contact_msg'));

  if($this->email->send()){
    return true;
  }
  else
  {
    return $this->email->print_debugger();
  }
}

/*Admin Email Notifications*/
public function _admin_email_notification($notification,$tempdata){
  $datas  = self::$data;

  $data                   = $this->languageDefine();
  $data['siteurl']        = base_url();
  $data['date']           = date('Y-m-d');
  $data['sitename']       = $this->lang->line('site_name');
  $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
  $data['facebook']       = $datas['settings'][0]['user_facebook'];
  $data['twitter']        = $datas['settings'][0]['user_Instagram'];
  $data['office_add1']    = $datas['settings'][0]['office_add1'];
  $data['office_add2']    = $datas['settings'][0]['office_add2'];
  $data['office_tel']     = $datas['settings'][0]['office_tel'];
  $data['office_email']   = $datas['settings'][0]['office_email'];
  $data['currency']       = $datas['default_currency'];

  if(!empty($notification)){
    switch ($notification) {
      case 'withdraw-request':
      $emailtemp          = 'templates/notification_email.tpl'; 
      $customer           = $this->database->getUserData($tempdata['user_id']);
      $data['subject']    = 'You have received a new withdrawal request!';
      $data['detail']     = 'You have received a withdrawal request from '.$customer[0]['username'].' withdrawal amount after fee deduction of <b> '.$data['currency'].$tempdata['fee'].'</b> is as follows ';
      $data['amount']     = $tempdata['final_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
      $template           = $data['currency'].$data['template'];
      $recipient          = $data['office_email'];
      break;
    }
  }

  $emptyCheck  = trim($data['template']);
  if(!empty($data['template']) && !empty($emptyCheck)){
    foreach($data as $key => $value){
      $template = str_replace('{{ '.$key.' }}', $value, $template);
    }
    return $this->_send_email($recipient,$data['subject'],$template);
  }
  return;
}

/*User Email Notifications*/
public function _user_email_notification($notification,$tempdata){
  $datas  = self::$data;

  $data                   = $this->languageDefine();
  $data['siteurl']        = base_url();
  $data['date']           = date('Y-m-d');
  $data['sitename']       = $this->lang->line('site_name');
  $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
  $data['facebook']       = $datas['settings'][0]['user_facebook'];
  $data['twitter']        = $datas['settings'][0]['user_Instagram'];
  $data['office_add1']    = $datas['settings'][0]['office_add1'];
  $data['office_add2']    = $datas['settings'][0]['office_add2'];
  $data['office_tel']     = $datas['settings'][0]['office_tel'];
  $data['office_email']   = $datas['settings'][0]['office_email'];
  $data['currency']       = $datas['default_currency'];

  if(!empty($notification)){
    switch ($notification) {
      case 'place-bid':
      $emailtemp          = 'templates/notification_email.tpl'; 
      $customer           = $this->database->getUserData($tempdata['bidder_id']);
      $owner              = $this->database->getUserData($tempdata['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_new_bid');
      $data['detail']     = $this->lang->line('lang_email_new_bid_dt_1').$customer[0]['username'].$this->lang->line('lang_email_new_bid_dt_2').$listing[0]['listing_type'].$this->lang->line('lang_email_new_bid_dt_3').'<b>'.$listing[0]['website_BusinessName'].'</b>';
      $data['amount']     = $tempdata['bid_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
      $template           = $data['template'];
      $recipient          = $owner[0]['email'];

      if($this->database->_check_user_has_pending_bids($tempdata['listing_id'],$tempdata['bidder_id'],'1') > 0){
        $previousbidders    = $this->database->_get_lower_bidders($tempdata['listing_id'],$tempdata['bid_amount'],$tempdata['bidder_id']);
        if(!empty($previousbidders) && count($previousbidders) > 0){
          $this->_user_bulk_emails($previousbidders,$tempdata['bid_amount'],$tempdata['listing_id']);
        }
      }
      break;
      case 'place-offer':
      $emailtemp          = 'templates/notification_email.tpl';
      $customer           = $this->database->getUserData($tempdata['customer_id']);
      $owner              = $this->database->getUserData($tempdata['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_new_offer');
      $data['detail']     = $this->lang->line('lang_email_new_offer_dt_1').$customer[0]['username'].$this->lang->line('lang_email_new_offer_dt_2').$listing[0]['listing_type'].$this->lang->line('lang_email_new_offer_dt_3').'<b>'.$listing[0]['website_BusinessName'].'</b>';
      $data['amount']     = $tempdata['offer_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $owner[0]['email'];
      break;
      case 'accept-bidder':
      $emailtemp          = 'templates/notification_email.tpl';
      $bid_info           = $this->database->_get_row_data('tbl_bids',array('id'=>$tempdata['id']),true);
      $customer           = $this->database->getUserData($bid_info[0]['bidder_id']);
      $owner              = $this->database->getUserData($bid_info[0]['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$bid_info[0]['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_bids_approved_1').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_bids_approved_2');
      $data['detail']     = $this->lang->line('lang_email_bids_approved_dt_1').$listing[0]['listing_type'].$this->lang->line('lang_email_bids_approved_dt_2').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_bids_approved_dt_3').$owner[0]['username'].$this->lang->line('lang_email_bids_approved_dt_4');
      $data['amount']     = $bid_info[0]['bid_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 

      if($this->database->_check_user_has_pending_bids($bid_info[0]['listing_id'],$bid_info[0]['bidder_id'],'0') > 0){
        $previousbidders    = $this->database->_get_lower_bidders($bid_info[0]['listing_id'],$bid_info[0]['bid_amount'],$bid_info[0]['bidder_id']);
        if(!empty($previousbidders) && count($previousbidders) > 0){
          $this->_user_bulk_emails($previousbidders,$bid_info[0]['bid_amount'],$bid_info[0]['listing_id']);
        }
      }
      break;
      case 'reject-bid':
      $emailtemp          = 'templates/notification_email.tpl';
      $bid_info           = $this->database->_get_row_data('tbl_bids',array('id'=>$tempdata['id']),true);
      $customer           = $this->database->getUserData($bid_info[0]['bidder_id']);
      $owner              = $this->database->getUserData($bid_info[0]['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$bid_info[0]['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_bids_rejected_1').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_bids_rejected_2');
      $data['detail']     = $this->lang->line('lang_email_bids_rejected_dt_1').$listing[0]['listing_type'].$this->lang->line('lang_email_bids_rejected_dt_2').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_bids_rejected_dt_3').$owner[0]['username'];
      $data['amount']     = $bid_info[0]['bid_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'reject-offer':
      $emailtemp          = 'templates/notification_email.tpl';
      $offer_info         = $this->database->_get_row_data('tbl_offers',array('id'=>$tempdata['id']),true);
      $customer           = $this->database->getUserData($offer_info[0]['customer_id']);
      $owner              = $this->database->getUserData($offer_info[0]['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$offer_info[0]['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_offers_rejected_1').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_offers_rejected_2');
      $data['detail']     = $this->lang->line('lang_email_offers_rejected_dt_1').$listing[0]['listing_type'].$this->lang->line('lang_email_offers_rejected_dt_2').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_offers_rejected_dt_3').$owner[0]['username'];
      $data['amount']     = $offer_info[0]['offer_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'accept-offer':
      $emailtemp          = 'templates/notification_email.tpl';
      $offer_info         = $this->database->_get_row_data('tbl_offers',array('id'=>$tempdata['bid_id']),true);
      $customer           = $this->database->getUserData($offer_info[0]['customer_id']);
      $owner              = $this->database->getUserData($offer_info[0]['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$offer_info[0]['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_offers_rejected_1').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_bids_approved_2');
      $data['detail']     = $this->lang->line('lang_email_offers_approved_dt_1').$listing[0]['listing_type'].$this->lang->line('lang_email_offers_rejected_dt_2').'<b>'.$listing[0]['website_BusinessName'].'</b>'.$this->lang->line('lang_email_bids_approved_dt_3').$owner[0]['username'].$this->lang->line('lang_email_open_contract_dt_1').'<b>'.$this->lang->line('lang_email_contract_id').': #'.$tempdata['contract_id'].'</b>';
      $data['amount']     = $offer_info[0]['offer_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'won-bid':
      $emailtemp          = 'templates/notification_email.tpl';
      $bid_info           = $this->database->_get_row_data('tbl_bids',array('id'=>$tempdata['bid_id']),true);
      $customer           = $this->database->getUserData($bid_info[0]['bidder_id']);
      $owner              = $this->database->getUserData($bid_info[0]['owner_id']);
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$bid_info[0]['listing_id']),true);
      $data['subject']    = $this->lang->line('lang_email_bids_approved_1').$listing[0]['website_BusinessName'].$this->lang->line('lang_email_bids_won_sub');
      $data['detail']     = $this->lang->line('lang_email_bids_approved_dt_1').$listing[0]['listing_type'].$this->lang->line('lang_email_bids_approved_dt_2').'<b>'.$listing[0]['website_BusinessName'].'</b>'.$this->lang->line('lang_email_bids_won_sub_dt_1').$owner[0]['username'].$this->lang->line('lang_email_bids_won_sub_dt_2').'<b>'. $this->lang->line('lang_email_bids_won_sub_dt_3') .$tempdata['contract_id'].'</b>';
      $data['amount']     = $bid_info[0]['bid_amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'direct-purchase':
      $emailtemp          = 'templates/notification_email.tpl';
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
      $customer           = $this->database->getUserData($tempdata['user_id']);
      $owner              = $this->database->getUserData($listing[0]['user_id']);
      $contract_id        = $this->database->_get_single_data('tbl_opens',array('id'=>$tempdata['contract_id']),'contract_id');
      $data['subject']    = $this->lang->line('lang_email_purcahsed').$listing[0]['website_BusinessName'].'!';
      $data['detail']     = $this->lang->line('lang_email_purcahsed_dt_1').$listing[0]['listing_type'].' <b>'.$listing[0]['website_BusinessName'].'</b>'.$this->lang->line('lang_email_purcahsed_dt_2').$owner[0]['username'].$this->lang->line('lang_email_purcahsed_dt_3').'<b>'. $this->lang->line('lang_email_purcahsed_dt_4') .$contract_id.'</b>';
      $data['amount']     = $tempdata['amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'notify-owner':
      $emailtemp          = 'templates/notification_email.tpl';
      $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
      $customer           = $this->database->getUserData($tempdata['user_id']);
      $owner              = $this->database->getUserData($listing[0]['user_id']);
      $contract_id        = $this->database->_get_single_data('tbl_opens',array('id'=>$tempdata['contract_id']),'contract_id');
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_has_purcahsed').$listing[0]['website_BusinessName'].'!';
      $data['detail']     = $this->lang->line('lang_email_payment_made').$customer[0]['username'].$this->lang->line('lang_email_payment_made_dt_1') .$listing[0]['listing_type'].' <b>'.$listing[0]['website_BusinessName'].'</b>'.$this->lang->line('lang_email_payment_made_dt_2').'<b>'.date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")).'</b>'.$this->lang->line('lang_email_payment_made_dt_3').'<b>'. $this->lang->line('lang_email_purcahsed_dt_4') .$contract_id.'</b>';
      $data['amount']     = $tempdata['amount'];
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $owner[0]['email']; 
      break;
      case 'mark-delivered':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $owner[0]['username'].$this->lang->line('lang_email_contract_delivered').$contract_info[0]['contract_id'].$this->lang->line('lang_email_contract_delivered_dt_1');
      $data['detail']     = $owner[0]['username'].$this->lang->line('lang_email_contract_delivered').'<b>'.$contract_info[0]['contract_id'].'</b>'.$this->lang->line('lang_email_contract_delivered_dt_2').$datas['settings'][0]['mark_as_completed'].$this->lang->line('lang_email_contract_delivered_dt_3').$datas['settings'][0]['mark_as_completed'].$this->lang->line('lang_email_contract_delivered_dt_4');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'mark-revision':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_contract_revision');
      $data['detail']     = $customer[0]['username'].$this->lang->line('lang_email_contract_revision_dt_1').'<b>'.$contract_info[0]['contract_id'].'</b>'.$this->lang->line('lang_email_contract_revision_dt_2');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $owner[0]['email']; 
      break;
      case 'mark-accepted':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $invoice_id         = $this->database->_get_single_data('tbl_contracts',array('contract_id'=>$tempdata),'invoice_id');
      $invoice            = $this->database->_get_row_data('tbl_invoices',array('invoice_id'=>$invoice_id),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_accept_delivery');
      $data['detail']     = $this->lang->line('lang_email_payment_made').$customer[0]['username'].$this->lang->line('lang_email_accept_delivery_dt_1').$contract_info[0]['contract_id']. $this->lang->line('lang_email_accept_delivery_dt_2') .'<b>'.$this->lang->line('lang_email_purcahsed_dt_4').$tempdata['contract_id'].'</b>'.$this->lang->line('lang_email_accept_delivery_dt_3') ;
      $data['amount']     = $invoice[0]['withdraw_amount'];
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $owner[0]['email']; 
      break;
      case 'cancel-contract':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract');
      $data['detail']     = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract').'<b>#'.$contract_info[0]['contract_id'].'</b>'.$this->lang->line('lang_email_cancel_contract_dt_1');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $owner[0]['email']; 
      break;
      case 'accept-cancel':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract_accpt');
      $data['detail']     = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract_accpt').'<b>'.$contract_info[0]['contract_id'].'</b> ,'.$this->lang->line('lang_email_cancel_contract_accpt_dt_2');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'reject-cancel':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract_rjct');
      $data['detail']     = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract_rjct').'<b>#'.$contract_info[0]['contract_id'].'</b> , '.$this->lang->line('lang_email_cancel_contract_rjct_dt_2');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      break;
      case 'admin-cancel':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $this->lang->line('lang_email_cancel_contract_rjct_ad');
      $data['detail']     = $this->lang->line('lang_email_cancel_contract_rjct_ad').'<b>#'.$contract_info[0]['contract_id'].'</b> ,'.$this->lang->line('lang_email_cancel_contract_rjct_ad_dt_2');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $customer[0]['email']; 
      case 'raised-dispute':
      $emailtemp          = 'templates/notifications_email.tpl';
      $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
      $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
      $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
      $data['subject']    = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract_dispute');
      $data['detail']     = $customer[0]['username'].$this->lang->line('lang_email_cancel_contract_dispute').'<b>#'.$contract_info[0]['contract_id'].'</b> , '.$data['sitename'].$this->lang->line('lang_email_cancel_contract_dispute_dt_2');
      $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
      $template           = $data['template'];
      $recipient          = $owner[0]['email'];
      break;
      case 'withdraw-change':
      $emailtemp          = 'templates/notification_email.tpl';
      $withdraw_info      = $this->database->_get_row_data('tbl_withdrawals',array('id'=>$tempdata['id']),true);
      $withdraw_method    = $this->database->_get_row_data('tbl_withdrawal_methods',array('id'=>$withdraw_info[0]['method']),true);
      $customer           = $this->database->getUserData($withdraw_info[0]['user_id']);

      if($tempdata['status'] === '2'){
        $status           = $this->lang->line('lang_email_withdrawal_approved');
        $data['detail']   = $this->lang->line('lang_email_withdrawal_approved_dt_2').'<b>#'.$withdraw_info[0]['withdrawal_id'].'</b>'.$this->lang->line('lang_email_withdrawal_has_been').$status.$this->lang->line('lang_email_withdrawal_approved_dt_3').'<b>'.$withdraw_method[0]['method'].'</b> . | <b>'.$this->lang->line('lang_email_withdrawal_fee') .':'.$data['currency'].$withdraw_info[0]['fee'].'</b> |'.$this->lang->line('lang_email_withdrawal_amount');
      }
      else if($tempdata['status'] === '3'){
        $status           = $this->lang->line('lang_email_withdrawal_rejected');
        $data['detail']   = $this->lang->line('lang_email_withdrawal_approved_dt_2').'<b>#'.$withdraw_info[0]['withdrawal_id'].'</b>'.$this->lang->line('lang_email_withdrawal_has_been'). $status .$this->lang->line('lang_email_withdrawal_contact_support');
      }

      $data['subject']    = $this->lang->line('lang_email_withdrawal_request_status').$status;
      $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);
      $data['amount']     = $withdraw_info[0]['final_amount'];  
      $template           = $data['template'];
      $recipient          = $customer[0]['email'];
      break;
      default:
      return ;
    }

    $emptyCheck  = trim($data['template']);
    if(!empty($data['template']) && !empty($emptyCheck)){
      foreach($data as $key => $value){
        $template = str_replace('{{ '.$key.' }}', $value, $template);
      }
      $this->_send_email($recipient,$data['subject'],$template);
    }
    return;
  }
}

/* Email Creator*/
public function _email_creator($data,$template,$recipient,$subject){
  $emptyCheck  = trim($template);
  if(!empty($template) && !empty($emptyCheck)){
    foreach($data as $key => $value){
      $template = str_replace('{{ '.$key.' }}', $value, $template);
    }
    $this->_send_email($recipient,$subject,$template);
  }
}

/*send email*/
public function _send_email($recipient,$subject,$template){
  $data  = self::$data;
  $this->email->to($recipient);
  $this->email->from($data['email'][0]['site_email'],$data['email'][0]['site_email_name']);
  $this->email->subject($subject);
  $this->email->message($template);

  if($this->email->send()){
    $this->email->print_debugger();
    return;
  }
  else
  {
    return $this->email->print_debugger();
  }
}

/*Send Bulk Emails*/
public function _user_bulk_emails($bidders,$highestbid,$listing_id){
  $datas  = self::$data;

  $data                   = $this->languageDefine();
  $data['siteurl']        = base_url();
  $data['date']           = date('Y-m-d');
  $data['sitename']       = $this->lang->line('site_name');
  $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
  $data['facebook']       = $datas['settings'][0]['user_facebook'];
  $data['twitter']        = $datas['settings'][0]['user_Instagram'];
  $data['office_add1']    = $datas['settings'][0]['office_add1'];
  $data['office_add2']    = $datas['settings'][0]['office_add2'];
  $data['office_tel']     = $datas['settings'][0]['office_tel'];
  $data['office_email']   = $datas['settings'][0]['office_email'];
  $data['currency']       = $datas['default_currency'];
  $listing                = $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id),true);

  foreach ($bidders as $bidder) {
    $emailtemp          = 'templates/notification_email.tpl'; 
    $customer           = $this->database->getUserData($bidder['bidder_id']);
    $data['subject']    = $this->lang->line('lang_email_higher_bid');
    $data['detail']     = $this->lang->line('lang_email_higher_bid_dt_1').$data['currency'].' '.$highestbid.' for '.$listing[0]['listing_type'].' listing '.$listing[0]['website_BusinessName'].$this->lang->line('lang_email_higher_bid_dt_2').$data['currency'].' '.$highestbid.$this->lang->line('lang_email_higher_bid_dt_3');
    $data['amount']     = $bidder['bid_amount'];
    $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
    $template           = $data['template'];
    $recipient          = $customer[0]['email'];

    $emptyCheck  = trim($data['template']);
    if(!empty($data['template']) && !empty($emptyCheck)){
      foreach($data as $key => $value){
        $template = str_replace('{{ '.$key.' }}', $value, $template);
      }
      $this->_send_email($recipient,$data['subject'],$template);
    }
  }
}


/*Message Email Notifications*/
    public function _message_email_notification($notification,$tempdata){
      $datas  = self::$data;

      $data['siteurl']        = base_url();
      $data['date']           = date('Y-m-d');
      $data['sitename']       = $this->lang->line('site_name');
      $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
      $data['facebook']       = $datas['settings'][0]['user_facebook'];
      $data['twitter']        = $datas['settings'][0]['user_Instagram'];
      $data['office_add1']    = $datas['settings'][0]['office_add1'];
      $data['office_add2']    = $datas['settings'][0]['office_add2'];
      $data['office_tel']     = $datas['settings'][0]['office_tel'];
      $data['office_email']   = $datas['settings'][0]['office_email'];
      $data['currency']       = $datas['default_currency'];

      if(!empty($notification)){
        switch ($notification) {
          case 'message-notification':
            $emailtemp          = 'templates/notification_email.tpl'; 
            $sender             = $this->database->getUserData($tempdata['from']);
            $reciever           = $this->database->getUserData($tempdata['to']);
            $data['subject']    = $this->lang->line('lang_email_message_subject');
            $data['detail']     = $this->lang->line('lang_email_message_new') .$sender[0]['username'].' '.$this->lang->line('lang_email_message_login_to_view');
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
            $template           = $data['currency'].$data['template'];
            $recipient          = $reciever[0]['email'];
            break;
          }
      }

      $emptyCheck  = trim($data['template']);
      if(!empty($data['template']) && !empty($emptyCheck)){
        foreach($data as $key => $value){
          $template = str_replace('{{ '.$key.' }}', $value, $template);
        }
        return $this->_send_email($recipient,$data['subject'],$template);
      }
        return;
    }

}