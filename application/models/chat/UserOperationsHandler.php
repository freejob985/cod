<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserOperationsHandler extends MY_Model
{
	public $_table = 'tbl_users';
	
	/*add message*/
	public function add_message($data){
		if($this->db->insert('tbl_message',$data)) {
			return $this->db->insert_id();
		}
	}

	/*add message*/
	public function add_notification($data){
		if($this->db->insert('tbl_message_notifications',$data)) {
			return $this->db->insert_id();
		}
	}

	/*Check message*/
	public function check_notifications($data){

		$results = $this->db->where($data)->get('tbl_message_notifications')->row();

		if(count($results) > 0){
			$dbtimestamp = strtotime($results->timestamp);
			if (time() - $dbtimestamp > 2 * 60) {
    			$this->db->where('id',$results->id)->update('tbl_message_notifications',array('sender'=>$data['sender'] , 'recipient'=>$data['recipient'] ,'timestamp'=>date('Y-m-d H:i:s')));

    			return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$arr = array(
				'sender'=>$data['sender'],
				'recipient'=>$data['recipient'],
				'timestamp'=>date('Y-m-d H:i:s')
			);

			$this->db->insert('tbl_message_notifications',$arr);
			return true;
		}
	}

	/*get message*/
	public function get_message($msg_id){
		return $this->db->where('id', $msg_id)->get('tbl_message')->result();
	}

	/*get user*/
	public function get_user($user_id){
		return $this->db->where('user_id', $user_id)->get('tbl_users')->result();
	}

	/*get contacted users*/
	public function get_contacted_users($user_id){
		$usersArr 			= 	$this->db->where('sender_id', $user_id)->or_where('recipient_id',$user_id)->get('tbl_message')->result_array();
		$sender_users		=	array_column($usersArr, 'sender_id');
		$recipient_users	=	array_column($usersArr, 'recipient_id');
		return array_values(array_unique(array_merge($sender_users,$recipient_users)));
	}

}