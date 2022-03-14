<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonOperationsHandler extends CI_Model
{
	function __construct()
	{
		parent::__construct();
        $this->load->database();

        $this->load->model('EmailOperationsHandler', 'email_op');
	}

    /*site language*/
    public function is_language(){
        if(!empty($this->session->userdata('site_lang'))){
            return $this->session->userdata('site_lang');
        }
        else{
            return $this->DatabaseOperationsHandler->GetDefaultLanguage()[0]['language'];
        }
    }

    /*ssl check*/
    public function is_ssl(){
        $data['settingsData']               =   $this->DatabaseOperationsHandler->getSettingsData();

        if(isset($data['settingsData'][0]['ssl_enable']) && $data['settingsData'][0]['ssl_enable']==1){
            force_ssl();
        }
    }

    /*login check*/
    public function is_logged($ignore=''){
        if(!empty($this->session->userdata('user_id')) && ($this->session->userdata('user_level') == 1 || $this->session->userdata('user_level') == 3)){
            return $this->session->userdata('user_id');
        }

        if(empty($ignore)){
            redirect(base_url().'login');
        }
        return;
    }

    /*login check*/
    public function is_logged_admin($ignore=''){
        if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') == 0){
            return $this->session->userdata('user_id');
        }

        if(empty($ignore)){
            redirect(base_url().'admin/login');
        }
        return;
    }


    /*Create invoices*/
    public function create_invoice($data,$status=1){
        $settingsData       = $this->database->getSettingsData();
        $sale_commission    = $settingsData[0]['sale_commission'];
        $processing_rate    = $settingsData[0]['processing_fee'];
        $invoice_type       = 1;
        $processing_fee     = 0;
        
        if(!empty($processing_rate) && $processing_rate > 0){
            $processing_fee   = ($data['amount'] / (100 + $processing_rate)) * 100 ;
            $processing_fee   = ($processing_fee * $processing_rate) / 100 ;
        }

        if(!empty($settingsData[0]['sale_commission'])){
            $sale_commission  = (($data['amount'] -  $processing_fee) * $settingsData[0]['sale_commission']) / 100 ;
        }

        $withdraw_amount      = (($data['amount'] - $processing_fee) - $sale_commission);

        if(isset($data['contract_method']) && $data['contract_method'] === 'escrow'){
            $invoice_type = 2;
        }

        $listing_data         = $this->database->_get_row_data('tbl_listings',array('id'=>$data['listing_id']));
        $data = array(
           'invoice_id' =>$data['invoice_id'],
           'paid_by' => $this->session->userdata('user_id'),
           'paid_to' => $listing_data[0]['user_id'],
           'gross_amount' => $data['amount'],
           'processing_fee' => $processing_fee,
           'success_fee' => $sale_commission,
           'withdraw_amount' => $withdraw_amount,
           'listing_id' => $data['listing_id'],
           'status' => $status,
           'invoice_type' => $invoice_type
        );
        return $this->database->_insert_to_table('tbl_invoices',$data);
    }

    /*Change Delivery Dates*/
    public function change_delivery_date($contract_id,$status){
        $listing    = $this->database->_get_row_data('tbl_opens',array('id'=>$contract_id,'status'=>$status));
        $data = array(
        'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['delivery']." day"))
        );
        return $this->database->_update_to_DB('tbl_opens',$data,$contract_id);
    }

    /*Change Contract Status*/
    public function change_contract_status($contract_id,$status){
        $percentage = 0;
        if(!empty($status)){
            switch ($status) {
                case '0':
                    $percentage = 0;
                    break;
                case '1':
                    $percentage = 10;
                    break;
                case '2':
                    $percentage = 10;
                    break;
                case '3':
                    $percentage = 20;
                    break;
                case '4':
                    $percentage = 100;
                    break;
                case '5':
                    $percentage = 75;
                    break;
                case '6':
                    $percentage = 60;
                    break;
                case '7':
                    $percentage = 100;
                    break;
                case '8':
                    $percentage = 75;
                    break;
                case '9':
                    $percentage = 80;
                    break;
                case '10':
                    $percentage = 50;
                    break;
                case '11':
                    $percentage = 80;
                    break;
                default:
                    return ;
            }
        }

        $data = array(
        'status' => $status,
        'date'=>date('Y-m-d H:i:s'),
        'percentage'=>$percentage
        );
        return $this->database->_update_to_DB('tbl_opens',$data,$contract_id);
    }

    /*Open Direct Contract*/
    public function open_direct_contract($listing_id,$contract_method='direct'){
        if(!empty($listing_id)){
            $listing    =   $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id));
            $data = array(
                'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
                'listing_id' => $listing_id,
                'bid_id' => 'direct',
                'type' => 'direct',
                'customer_id' => $this->session->userdata('user_id'),
                'owner_id' => $listing[0]['user_id'],
                'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")),
                'delivery' =>$listing[0]['deliver_in'],
                'status' => 0,
                'date' => date('Y-m-d H:i:s'),
                'contract_method' => $contract_method
            );
            return $this->database->_insert_to_DB('tbl_opens',$data);
        }
        return;
    } 


    /*Unique URL slug Generator*/
    public function _urlSlugGenerator($table,$id,$column,$slug){
        $urlSlug = url_title($slug, '-', TRUE);
        if(isset($urlSlug) && !empty($urlSlug)){
            $this->db->where($column,$urlSlug);
            $query = $this->db->get($table);
            if(isset($query->result_array()[0][$id])){
                return $urlSlug.'-'.$query->result_array()[0][$id];
            }
            else
            {
               return $urlSlug;
            }
        }
       return;
    }

    public function detectVisitorDevice() {
        $this->load->library('user_agent');
        $this->load->library('Mobile_Detect');
        $detect = new Mobile_Detect;

        $data['browser'] = $this->agent->browser();
        $data['browser_version'] = $this->agent->version();
        $data['os'] = $this->agent->platform();
        $data['ip_address'] = $this->input->ip_address();
        $data['mobile'] = $this->agent->mobile();
        $data['mobileorTab'] = $detect->isMobile();

        return $data;
    }

    public function _generate_user_token(){
        do
        {
            $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

            if ($salt === FALSE)
            {
                $salt = hash('sha1', time() . mt_rand());
            }

            $new_key = substr($salt, 0, 40);
        }
        while ($this->_key_exists_token($new_key));

        return $new_key;
    }

    public function _generate_unique_tokens($table,$column='token'){
        do
        {
            $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

            if ($salt === FALSE)
            {
                $salt = hash('sha1', time() . mt_rand());
            }

            $new_key = substr($salt, 0, 40);
        }
        while ($this->_key_exists_check($new_key,$table,$column));

        return $new_key;
    }

    private function _key_exists_token($key){
        return $this->db
            ->where('token', $key)
            ->count_all_results('tbl_users') > 0;
    }

    private function _key_exists_check($key,$table,$column){
        return $this->db
            ->where($column, $key)
            ->count_all_results($table) > 0;
    }

    public function getDomainInCorrectFormat($input){
        $input = trim($input, '/');
        if (!preg_match('#^http(s)?://#', $input)) {
            $input = 'http://' . $input;
        }

        $urlParts   =   parse_url($input);
        $domain     =   preg_replace('/^www\./', '', $urlParts['host']);
        $domain     =   $this->clearHost($domain);
        return $domain;
    }

    /*Clearhost*/
    private function clearHost($host) {   
        $array = explode(".", $host);
        return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "").".".$array[count($array) - 1];
    }

    /*Get Alexa Rank*/
    public function alexaRank($url) {
        $alexaData = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
        $alexa['globalRank']    =  isset($alexaData->SD->POPULARITY) ? $alexaData->SD->POPULARITY->attributes()->TEXT : 0 ;
        $alexa['CountryRank']   =  isset($alexaData->SD->COUNTRY) ? $alexaData->SD->COUNTRY->attributes() : 0 ;
        return json_decode(json_encode($alexa), TRUE);
    }

    public function getSelectBoxData($element,$empty="1")
    {
        $platformData=array();
        if(!empty($this->input->post($element)[0])){
            foreach ($this->input->post($element) as $i => $platform) {
                if(!empty($platform) && !in_array ($platform, $platformData)){
                    array_push($platformData, $platform);
                }
            }
        } 
        else 
        { 
            if($empty == "1") 
            { 
                $platformData = ['all']; 
            } 
            else
            {
                $platformData =[]; 
            } 
        }

        return json_encode($platformData);
    }

    /*Currency Selector*/
    public function getCurrency($cc_code,$object)
    {
        $json = file_get_contents(DATA_FOLDER.'currency.json');
        $obj = json_decode($json);
        return $obj->$cc_code->$object;
    }

    /*Date Difference Calculation*/
    public function DateDiffCalculate($date)
    {
        $datestr    =   $date;
        $date       =   strtotime($datestr);

        $diff       =   $date-time();
        $days       =   floor($diff/(60*60*24));
        $hours      =   round(($diff-$days*60*60*24)/(60*60));

        return array('days'=>$days,'hours'=>$hours);
    }

    /*Convert Big Values to shorter form*/
    public function ConvertToMillions($value){
        if ($value < 1000000) {
            $format = number_format($value);
        } else if ($value < 1000000000) {
            $format = number_format($value / 1000000, 2) . 'M';
        } else {
            $format = number_format($value / 1000000000, 2) . 'B';
        }

        return $format;
    }

    /*Check Google Store URL Validity*/
    public function checkGooglePlayApp($url){
        $val_status = $this->database->_get_single_data('tbl_settings',array('id'=>1),'active_app_verification');
        if($val_status === '1'){
            $domain = $this->get_full_domain_url($url);
            if(in_array($domain, APP_URLS)){
                $socket =@ fsockopen($domain,80,$errno,$errstr,30);
            
                if(!$socket){
                    return false;
                }
                fclose($socket);

                if($this->get_http_response_code($url) !== "200"){
                    return false;
                }

                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }

    /*Read HTTP Response URL*/
    private function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    /*Get full domain*/
    public function get_full_domain_url($url) {
        $host = (parse_url($url, PHP_URL_HOST) != '') ? parse_url($url, PHP_URL_HOST) : $url;
        return preg_replace('/^www\./', '', $host);
    }

    /*Unique Payment ID Generation*/
    public function _generate_paymentID($table='tbl_payments',$column='id'){
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

    /*reviews pagination loader*/
    public function reviews_pagination_loader($userid){
        $config = array();
        $config["base_url"]                     = '#';
        $config["total_rows"]                   = $this->database->get_reviews($userid,"",1,'',''); 
        $config["per_page"]                     = 4;
        $config['use_page_numbers']             = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect">';
        $config['num_tag_close']                = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                = '<li class="pagination-arrow">';
        $config['prev_tag_close']               = '</li>';
        $config['first_tag_open']               = '<li class="ripple-effect">';
        $config['first_tag_close']              = '</li>';
        $config['last_tag_open']                = '<li class="ripple-effect">';
        $config['last_tag_close']               = '</li>';

        $config['prev_link']                    = '<i class=" mdi mdi-chevron-left"></i>';
        $config['prev_tag_open']                = '<li class="pagination-arrow">';
        $config['prev_tag_close']               = '</li>';

        $config['next_link']                    = '<i class=" mdi mdi-chevron-right"></i>';
        $config['next_tag_open']                = '<li class="pagination-arrow">';
        $config['next_tag_close']               = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function time_elapsed_string($datetime, $full = false,  $future = false ) {
        
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        if($future)
        {
            return $string ? implode(', ', $string) . ' to go' : 'to go';
        }
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /*Direct Payments*/
public function direct_payments($data,$paypal_data,$type='outside',$method){

    if(!empty($paypal_data)){
        $data= array(
            'PAYMENT_ID' =>$paypal_data['transactionId'],
            'AMOUNT' =>$paypal_data['amount'],
            'METHOD' =>$method,
            'ACK'=>$data['ACK'],
            'USER_ID'=>$paypal_data['user_id'],
            'PLAN_ID'=>$paypal_data['listing_id'],
            'TOKEN'=>'',
            'PAYMENTINFO_0_TRANSACTIONID'=>$data['TRANSACTIONID'],
            'CORRELATIONID'=>$data['CORRELATIONID'],
            'PAYER_ID'=>$data['CORRELATIONID'],
            'PAYMENTINFO_0_TRANSACTIONTYPE'=>'',
            'PAYMENTINFO_0_FEEAMT'=>'',
            'PAYMENTINFO_0_PAYMENTTYPE'=>'',
            'PAYMENTINFO_0_TAXAMT'=>''
        );

        $this->database->_insert_to_DB('tbl_payments', $data);  

        if($type === 'outside'){

            if(file_exists(APPPATH.'/libraries/Referral_Module.php')){
                $settings =   $this->database->_get_row_data('tbl_settings',array('id'=>1));
                if(!empty($settings[0]['ref_sale_com'])){

                    $reffer = $this->database->_get_row_data('tbl_users',array('user_id'=>$this->session->userdata('user_id')));

                    if(!empty($reffer[0]['referrer'])){
                        $ref_amount = ( $paypal_data['amount'] * $settings[0]['ref_sale_com']) / 100;
                        $reffArr = array(
                            'user_id' =>$this->session->userdata('user_id'),
                            'refer'=>$reffer[0]['referrer'],
                            'description' => $paypal_data['description'],
                            'status' => 0,
                            'ref_type' => 0,
                            'payment_amount' => $paypal_data['amount'],
                            'ref_commission'=> $ref_amount
                        );

                        $this->load->model('RefferralOperationsHandler', 'refferalModel');  
                        $this->refferalModel->create_refferal_record( $reffArr , PAYMENT_PER_REF);
                    }
                }
            }

            $this->InsertDomainPurchaseData($paypal_data['user_id'],$paypal_data);  
        }
        else
        {
            if(!empty( $this->session->userdata('listing_data'))){
                $listing_data = $this->session->userdata('listing_data');
            }

            $settings =   $this->database->_get_row_data('tbl_settings',array('id'=>1));

            foreach ($listing_data as $key) {


                if(!empty($settings[0]['ref_plan_com'])){

                    $reffer = $this->database->_get_row_data('tbl_users',array('user_id'=>$this->session->userdata('user_id')));

                    if(!empty($reffer[0]['referrer'])){
                        $ref_amount = ( $key['amount'] * $settings[0]['ref_plan_com']) / 100;
                        $reffArr = array(
                            'user_id' =>$this->session->userdata('user_id'),
                            'refer'=>$reffer[0]['referrer'],
                            'description' => $key['description'],
                            'status' => 0,
                            'ref_type' => 1,
                            'payment_amount' => $key['amount'],
                            'ref_commission'=> $ref_amount
                        );


                        $this->load->model('RefferralOperationsHandler', 'refferalModel');  
                        $this->refferalModel->create_refferal_record( $reffArr , PAYMENT_PER_REF);
                    }
                }

                $this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
            }
        }

        return;
    }
}
    

    /*Purchase Data Insertions*/
    public function InsertDomainPurchaseData($user_id,$Arr){

        $datas['settings'] =   $this->database->_get_row_data('tbl_settings',array('id'=>1));
        if(!empty($Arr['domain_list'])){
            foreach (json_decode($Arr['domain_list'],true) as $domain) {
            $domain_id  =   $this->database->_get_single_data('tbl_listings',array('id'=>$domain['id']),'domain_id');

            if($domain['sale'] === 'direct'){

                $data= array(
                    'user_id' =>$user_id,
                    'domain_id' =>$domain_id,
                    'listing_id' =>$domain['id'],
                    'amount' =>$domain['price'],
                    'invoice_id' =>$Arr['transactionId'],
                );

                $contract_id = $this->open_direct_contract($data['listing_id']);

                $Arr['contract_id'] = $contract_id;

                $contractArr= array(
                    'user_id' =>$user_id,
                    'domain_id' =>$domain_id,
                    'contract_id' =>$contract_id,
                    'listing_id' =>$domain['id'],
                    'amount' =>$domain['price'],
                    'invoice_id' =>$Arr['transactionId'],
                );

                if($this->database->_update_to_DB('tbl_listings',array('sold_status' => 1),$data['listing_id'])){
                    if(!empty($contract_id)){
                        $this->database->_insert_to_table('tbl_domain_purchases',$data);
                        if($this->database->_insert_to_table('tbl_contracts',$contractArr)){
                            $this->change_contract_status($contract_id,1);
                            $this->change_delivery_date($contract_id,1);
                            $this->create_invoice($contractArr);
                            /*email notification*/
                            if($datas['settings'][0]['email_notifications'] === '1'){
                                $this->email_op->_send_invoice_email('payment',$Arr,'direct');
                            }
                            /**/   
                        }
                    }
                }
            }
            else
            {

                $data= array(
                'user_id' =>$user_id,
                'domain_id' =>$domain_id,
                'contract_id' =>$Arr['contratc_id_var'],
                'listing_id' =>$domain['id'],
                'amount' =>$domain['price'],
                'invoice_id' =>$Arr['transactionId'],
                );

                $Arr['contract_id'] = $Arr['contratc_id_var'];

                if($this->database->_update_to_DB('tbl_listings',array('sold_status'=>1),$data['listing_id'])){

                    if($this->database->_insert_to_table('tbl_contracts',$data)){
  

                        $this->change_contract_status($Arr['contratc_id_var'],1);

                        $this->change_delivery_date($Arr['contratc_id_var'],1);
                        $this->create_invoice($data);
                        /*email notification*/
                        if($datas['settings'][0]['email_notifications'] === '1'){
                            $this->email_op->_send_invoice_email('payment',$Arr,'contract');
                        }
                        /**/   
                    }
                }
            }
            }
        }
    }

    /*Insert Listing Purchase Data*/
    public function InsertPurchaseData($user_id,$Arr){
        $datas['settings'] =   $this->database->_get_row_data('tbl_settings',array('id'=>1));
        $data= array(
            'invoice_id'=>$this->_generate_paymentID('tbl_purchases','invoice_id'),
            'user_id' =>$user_id,
            'plan_id' =>$Arr['user_membership_id'],
            'plan_header' =>$Arr['plan_header'],
            'listing_type' =>$Arr['listing_type'],
            'purchase_date'=>$Arr['user_membership_timestamp'],
            'expire_date'=>$Arr['user_membership_timestamp_expiry']
        );

        /*email notification*/
        if($datas['settings'][0]['email_notifications'] === '1'){
            $this->email_op->_send_invoice_email('listing',$data,'admin');
        }
        /**/   

        if($this->database->_update_to_DB('tbl_listings',array('status'=>1),$Arr['user_membership_id'])){
            return $this->database->_insert_to_DB('tbl_purchases',$data);
        }
    }

    /*Upload Payment Plugins*/
    public function upload_plugins(){
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = PLUGINS_UPLOAD;
        $config['allowed_types'] = 'zip|ZIP';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = true;

        if (!$this->upload->do_upload('fileToUpload')) 
        {
            $error = array('error' => $this->upload->display_errors());
            if(isset($error['error']))
            {
                exit(json_encode($error['error']));
            }
        }
        else
        {
            $plugin_data = $this->upload->data();
            $upload_plugin_name = $plugin_data['file_name'];
            $full_path = $plugin_data['full_path'];
            $this->load->library('zip');
            if(isset($full_path))
            {
                $zip = new ZipArchive;
                if ($zip->open($full_path) === TRUE) 
                {
                    if(!$zip->extractTo(PLUGINS_UPLOAD))
                    {
                        exit(json_encode('Sorry, We cannot activate this due to a licence issue. Please contact script support team'));
                    }

                    $zip->close();
                    unlink($full_path);
                    if($this->readPluginFile($upload_plugin_name))
                    {
                        exit();
                    }
                    else
                    {
                        exit(json_encode('Sorry Something Went Wrong !!'));
                    }
                }
            }
        } 
    }

    public function readPluginFile($filename)
    {
        $plugin_info = array(
            'id' => 'Plugin Id',
            'method' => 'Plugin Name',
            'paymentgateway_id' => 'Gateway Id',
            'description' => 'Description',
            'payment_currency' => 'Currency',
            'icon_url' => 'Platform Icon',
            'card_status' => 'Card Status',
            'back_status' => 'Back Status',
            'email_only' => 'Email Only',
            'is_fixed' => 'Fixed',
            'fields' => 'Fields'
        );
                                
        $plugin_data = $this->readEncryptedFile( PLUGINS_UPLOAD.'/install.php', $plugin_info, 'plugin' );

        if(isset($plugin_data))
        {
            if($this->database->_update_payment_plugins($plugin_data))
            {
                unlink(PLUGINS_UPLOAD.'/install.php');
                return true;
            }
            else
            {
                unlink(PLUGINS_UPLOAD.'/install.php');
                return false;
            }

        }
    }

    private function readEncryptedFile( $file, $plugin_info, $context = '' ) 
    {
        $fp = fopen( $file, 'r' );
        $file_data = fread( $fp, 8192 );
        fclose( $fp );
        $file_data = str_replace( "\r", "\n", $file_data );

        if ( $context && $extra_headers = $this->apply_filters( "extra_{$context}_headers", array() ) ) 
        {
            $extra_headers = array_combine( $extra_headers, $extra_headers ); 
            $all_headers = array_merge( $extra_headers, (array) $plugin_info );
        } else 
        {
            $all_headers = $plugin_info;
        }

        foreach ( $all_headers as $field => $regex )
        {
            if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) && $match[1] )
            {
                $all_headers[ $field ] = $this->_remove_header_comment( $match[1] );
            }
            else
            {
                $all_headers[ $field ] = '';
            }
        }

        return $all_headers;
    }


    private function apply_filters( $tag, $value ) 
    {
        $args = array();

        if ( isset($wp_filter['all']) ) 
        {
            $wp_current_filter[] = $tag;
            $args = func_get_args();
            PHP_call_all_hook($args);
        }

        if ( !isset($wp_filter[$tag]) ) 
        {
            if ( isset($wp_filter['all']) )
                array_pop($wp_current_filter);
            return $value;
        }

        if ( !isset($wp_filter['all']) )
        {
            $wp_current_filter[] = $tag;
        }

        if ( empty($args) )
        {
            $args = func_get_args();
        }

        array_shift( $args );

        $filtered = $wp_filter[ $tag ]->apply_filters( $value, $args );

        array_pop( $wp_current_filter );

        return $filtered;
    }

    private function _remove_header_comment( $str ) 
    {
        return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
    }

    public function RemovePlugin($id,$type='')
    {
        if(empty($type))
        {
            $this->load->helper("file");
            $this->db->select('paymentgateway_id');
            $this->db->where('id',$id);
            $query = $this->db->get('tbl_payment_settings');

            if(isset($query->result_array()[0]['paymentgateway_id']))
            {
                $plugin = $query->result_array()[0]['paymentgateway_id'];
                if(file_exists(APPPATH.PLUGINS_UPLOAD.$plugin))
                {
                    if(delete_files(PLUGINS_UPLOAD.$plugin,TRUE))
                    {
                        $this->db->where('id',$id);
                        exit(json_encode($this->db->delete('tbl_payment_settings')));
                    }
                }
                else
                {
                    $this->db->where('id',$id);
                    exit(json_encode($this->db->delete('tbl_payment_settings')));
                }
            }
            exit();
        }
    }


    /*************************************************************************************************************/
    
    /**
    * Create a web friendly URL slug from a string.
    * 
    * Although supported, transliteration is discouraged because
    *     1) most web browsers support UTF-8 characters in URLs
    *     2) transliteration causes a loss of information
    *
    * @author Sean Murphy <sean@iamseanmurphy.com>
    * @copyright Copyright 2012 Sean Murphy. All rights reserved.
    * @license http://creativecommons.org/publicdomain/zero/1.0/
    * http://iamseanmurphy.com/creating-seo-friendly-urls-in-php-with-url-slug/
    * @param string $str
    * @param array $options
    * @return string
    */
    public function urlslug($str, $options = array()) {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => 100,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );
        // Merge options
        $options = array_merge($defaults, $options);
    
        $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
        'ß' => 'ss', 
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
        'ÿ' => 'y', 'é' => 'e',

        // Latin symbols
        '©' => '(c)',

        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',

        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
        'Ž' => 'Z', 
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z', 

        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
        'Ż' => 'Z', 
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',

        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
    
        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    
        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
    
        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    
        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    
        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    
        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);
    
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
}

