<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefferralOperationsHandler extends CI_Model
{
	function __construct(){
		parent::__construct();
        $this->load->database();
        $this->load->model('DatabaseOperationsHandler', 'database');
        $this->load->model('CommonOperationsHandler', 'common');
        $this->load->model('EmailOperationsHandler', 'email_op');
    }

    public function load_refferers_listings($sales_count = '1'){
        $this->db->select('* ,tu.firstname as firstname, tu.date as date, COUNT(tp.user_id) as eligible_count , tu.referrer as referrer , tur.firstname as reffererName');
        $this->db->from('tbl_users tu');
        $this->db->join('tbl_purchases tp', 'tu.user_id = tp.user_id');
        $this->db->join('tbl_users tur', 'tu.referrer = tur.user_id' , 'left');
        $this->db->where('tu.user_status = "2"');
        $this->db->where('tu.user_id != tu.referrer');
        $this->db->where('tu.referrer != "0"');
        $this->db->where('tu.referrer not in (select tr.user_id from tbl_refferal as tr WHERE tr.status = "1" OR tr.status = "2")');
        $this->db->group_by('tu.referrer');
        $this->db->having('COUNT(tp.user_id) > '.$this->db->escape($sales_count));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function load_refferers_listings_userwise($sales_count = '1' ,$user_id){
        $this->db->select('* ,tu.user_id as user_group,tu.firstname as firstname, tu.date as date, COUNT(tp.user_id) as eligible_count , tu.referrer as referrer , tur.firstname as reffererName');
        $this->db->from('tbl_users tu');
        $this->db->join('tbl_purchases tp', 'tu.user_id = tp.user_id');
        $this->db->join('tbl_users tur', 'tu.referrer = tur.user_id' , 'left');
        $this->db->where('tu.user_status = "2"');
        $this->db->where('tu.user_id != tu.referrer');
        $this->db->where('tu.referrer != "0"');
        $this->db->where('tu.referrer', $user_id);
        $this->db->where('tu.user_status', 2);
        $this->db->where('tu.referrer not in (select tr.user_id from tbl_refferal as tr WHERE tr.status = "1" OR tr.status = "2")');
        $this->db->group_by('tu.referrer');
        $this->db->having('COUNT(tp.user_id) > '.$this->db->escape($sales_count));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function load_refferals($user_id,$status){
        $this->db->select('*,tr.user_id as user_group,tur.firstname as userGroupname , SUM(tr.ref_commission) as commission');
        $this->db->from('tbl_refferal tr');
        $this->db->join('tbl_users tur', 'tr.refer = tur.user_id' , 'left');
        $this->db->where('tr.refer', $user_id);
        $this->db->where('tr.status',$status);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function load_admin_pending_payments($status = 0){
        $this->db->select('*,tr.user_id as user_group,tur.firstname as firstname,tup.firstname as userGroupname ');
        $this->db->from('tbl_refferal tr');
        $this->db->join('tbl_users tur', 'tr.refer = tur.user_id' , 'left');
        $this->db->join('tbl_users tup', 'tr.user_id = tup.user_id' , 'left');
        $this->db->where('tr.status', $status);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function load_user_payments($user_id){
        $this->db->select('*,tr.user_id as user_group,tur.firstname as userGroupname ');
        $this->db->from('tbl_refferal tr');
        $this->db->join('tbl_users tur', 'tr.refer = tur.user_id' , 'left');
        $this->db->where('tr.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function load_total_pending_payments($user_id){
        $this->db->select('*, SUM(payment_amount) as totalAmount');
        $this->db->from('tbl_refferal');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->result_array()[0]['totalAmount'];
    }

    public function create_refferal_eligable_record($data , $payment_amount){

        foreach ($data as $row) {
           $data = array(
            'user_id' =>$row['user_id'],
            'refer'=>$row['refer'],
            'eligible_count' => $row['eligible_count'],
            'status' => $row['status'],
            'ref_type' => $row['ref_type'],
            'payment_amount' => $row['payment_amount'],
            'ref_commission'=>$row['ref_commission']
        );

           $records = $this->database->_get_row_data('tbl_refferal', $data);

           if(!count($records) > 0){
             $this->database->_insert_to_table('tbl_refferal',$data); 
         }
         else
         {
            $this->database->_update_to_DB('tbl_refferal', $data , $records[0]['id']);
        }
    }
}

    public function create_refferal_record($row , $payment_amount){

        $data = array(
            'user_id' =>$row['user_id'],
            'refer'=>$row['refer'],
            'description' => $row['description'],
            'status' => $row['status'],
            'ref_type' => $row['ref_type'],
            'payment_amount' => $row['payment_amount'],
            'ref_commission'=>$row['ref_commission']
        );

        $this->database->_insert_to_table('tbl_refferal',$data); 
    }

    /*Get Withdrawals Data*/
    public function _withdrawals_data_ref($status){
        $this->db->select('*,(tbl_withdrawals_ref.id) as id,(tbl_withdrawal_methods.method) as methodw, (tbl_withdrawals_ref.status) as statusw , (tbl_withdrawals_ref.fee) as fee');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_withdrawals_ref.user_id');
        $this->db->join('tbl_withdrawal_methods', 'tbl_withdrawals_ref.method = tbl_withdrawal_methods.id','left');
        $this->db->where('tbl_withdrawals_ref.status',$status);
        $this->db->order_by('tbl_withdrawals_ref.created_date','asc');
        $query = $this->db->get('tbl_withdrawals_ref');
        return $query->result_array();
    }

    /*Get Withdrawal Statements data*/
    public function _get_withdrawals_ref($user_id,$status='',$limit=5,$start=0){
        $this->db->select('*,(tbl_withdrawal_methods.method) AS w_method ,(tbl_withdrawals_ref.status) AS status');
        $this->db->join('tbl_withdrawal_methods', 'tbl_withdrawal_methods.id = tbl_withdrawals_ref.method');
        $this->db->where('tbl_withdrawals_ref.user_id',$user_id);
        if(!empty($status)){
            $this->db->where('tbl_withdrawals_ref.status',$status);
        }

        if($start !== 0){
            $start = $limit * ($start - 1);
        }

        $this->db->limit($limit,$start);
        $query = $this->db->get('tbl_withdrawals_ref');
        return $query->result_array();
    }

    /*Available to withdraw funds*/
    public function _user_availableto_withdraw($user_id,$inv_type=1){
        $available = 0; $total =0; $earnings =0; $refunds =0;
        $this->db->select('*, SUM(ref_commission) AS earnings');
        $this->db->where('refer',$user_id);
        $this->db->where('status',1);
        $this->db->group_by("refer");
        $query = $this->db->get('tbl_refferal');

        if(isset($query->result_array()[0]['earnings'])){
            $earnings = $query->result_array()[0]['earnings'];
        }

        $balance = ($earnings - $this->_user_withdrawals($user_id));
        return $balance;
    }

    /*Get User Withdrawals*/
    public function _user_withdrawals($user_id){
        $this->db->select('*, SUM(amount) AS withdrawals');
        $this->db->where('user_id',$user_id);
        $this->db->group_start();
        $this->db->where('status',0);
        $this->db->or_where('status',1);
        $this->db->or_where('status',2);
        $this->db->group_end();
        $this->db->group_by("user_id");
        $query = $this->db->get('tbl_withdrawals_ref');
        if(isset($query->result_array()[0]['withdrawals'])){
            return $query->result_array()[0]['withdrawals'];
        }
        return 0;
    }

}