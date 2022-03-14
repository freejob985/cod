<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	private static $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('helperssl'));
		$this->load->helper(array('smiley'));

		$this->load->model('chat/ChatOperationsHandler', 'chat');
		$this->load->model('chat/LastSeenOperationsHandler','last');
		$this->load->model('chat/UserOperationsHandler', 'user');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->common->is_logged();
		self::$data['token'] = 	$this->security->get_csrf_hash();
		self::$data['l_format']	=   $this->database->_get_single_data('tbl_languages',array('status'=>1,'language'=>$this->common->is_language()),'l_format');
    }

    /*Load Chat*/
    public function index(){

    	$userListArr = array();
		$data['languages']						=	$this->DatabaseOperationsHandler->load_all_languages();
		$data['default_currency']				=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies',array('default_status'=>'1'),'currency'),'symbol');
		$data['userdata'] 						= 	$this->DatabaseOperationsHandler->getUserData($this->session->userdata('user_id'));
		$data['imagesData']						=	$this->database->_get_row_data('tbl_siteimages',array('id'=>1));

		$data['cur_user'] 						= 	$this->user->get_by('user_id',$this->session->userdata('user_id'));
		$contacts 	  							= 	$this->user->get_contacted_users($this->session->userdata('user_id'));
		$data['listingCount']					= 	$this->DatabaseOperationsHandler->_count_listings_user_wise('auction');
		$data['listingOfferCount']				= 	$this->database->_count_listings_user_wise('classified');
		$data['messageCount']					= 	$this->chat->get_unviewed_msg($this->session->userdata('user_id'));
		$data['listingOfferCount']				= 	$this->DatabaseOperationsHandler->_count_listings_user_wise('classified');
		$data['openContracts']					= 	$this->DatabaseOperationsHandler->_get_my_contracts();
		$data['closeContracts']					= 	$this->DatabaseOperationsHandler->_get_my_contracts(false);
		$data['openEscrow']						= 	$this->database->_get_my_contracts(true,'escrow');
		$data['closeEscrow']					= 	$this->database->_get_my_contracts(false,'escrow',3);
		$data['platforms']                		=   $this->database->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
		$data['options']                  		=   $this->database->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
		$data['settings'] 						= 	$this->database->getSettingsData();

		if(in_array("website",array_column(self::$data['platforms'], 'platform'))){
		    self::$data['categoriesData']		=	$this->database->_count_listings_categories_wise();
		}

		foreach ($contacts as $key=>$contact) {
			//get unread messages from this user
			$unread 							= 	$this->chat->unread_per_user($contact,$this->session->userdata('user_id')); 
			$userListArr[$key]['from']			= 	$this->session->userdata('user_id');
			$userListArr[$key]['to']			= 	$this->user->get_user($contact);
			$userListArr[$key]['last_msg']		= 	$this->chat->get_last_msg($contact,$this->session->userdata('user_id'));
			if(isset($userListArr[$key]['last_msg']) && !empty($userListArr[$key]['last_msg'])) {
				$userListArr[$key]['ago']			= 	$this->CommonOperationsHandler->time_elapsed_string($userListArr[$key]['last_msg'][0]->timestamp);
			}
			$userListArr[$key]['ago']			=	"";
			$userListArr[$key]['unread']		= 	$unread > 0 ? $unread : null ;
		}

		$data['users'] = $userListArr;
		$data['l_format']						=   $this->database->_get_single_data('tbl_languages',array('status'=>1,'language'=>$this->common->is_language()),'l_format');
		
		$this->load->view('user/messages',$data);
		return;
	}	

	/*Userwise View Bids*/
	public function message()
	{
		$per_page 		= 5;
		$user 			= $this->session->userdata('user_id');
		$recipient 		= $this->input->post('user');
		$limit 			= isset($_POST['limit']) ? $this->input->post('limit') : $per_page ;

		$messages 		= array_reverse($this->chat->load_messages($user, $recipient, $limit));
		$total 			= $this->chat->thread_len($user, $recipient);

		$thread = array();
		foreach ($messages as $message) {
			$owner 	= $this->user->get_by('user_id',$message->sender_id);
			$chat = array(
				'msg' 		=> $message->id,
				'sender' 	=> $message->sender_id, 
				'recipient' => $message->recipient_id,
				'avatar' 	=> $owner->thumbnail != '' ? $owner->thumbnail : 'no-image.jpg',
				'body' 		=> $message->message,
				'time' 		=> date("M j, Y, g:i a", strtotime($message->timestamp)),
				'type'		=> $message->sender_id == $user ? 'out' : 'in',
				'name'		=> $message->sender_id == $user ? 'You' : ucwords($owner->firstname)
				);

			array_push($thread, $chat);
		}

		$recipientUser 	= $this->user->get_by('user_id',$recipient);

		$contact = array(
			'name'=>ucwords($recipientUser->firstname.' '.$recipientUser->lastname),
			'status'=>$recipientUser->online,
			'id'=>$recipientUser->user_id,
			'limit'=>$limit + $per_page,
			'more' => $total  <= $limit ? false : true, 
			'scroll'=> $limit > $per_page  ?  false : true,
			'remaining'=> $total - $limit
		);
			
		$response = array(
			'success' => true,
			'errors'  => '',
			'message' => '',
			'chat'	  => $contact,
			'thread'  => $thread
		);

		//add the header here
		$output['response'] 	= html_escape($this->security->xss_clean($response));
		$output['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode( $output )) ;
	}

	public function save_message(){

		$user 			= $this->session->userdata('user_id');
		$recipient 		= $this->input->post('user');
		$message 		= $this->input->post('message',true);

		if($message != '' && $recipient != '')
		{
			$msg_id = $this->chat->insert(array(
				'sender_id' 		=> $user,
				'recipient_id' 		=> $recipient,
				'message' 			=> $message,
				'view_status ' 		=> 0,
				'status ' 			=> 1
			));

			$msg 	= $this->chat->get($msg_id);
			$owner 	= $this->user->get_by('user_id',$msg->sender_id);

			$chat = array(
				'msg' 		=> $msg->id,
				'sender' 	=> $msg->sender_id, 
				'recipient' => $msg->recipient_id,
				'avatar' 	=> $owner->thumbnail != '' ? $owner->thumbnail : 'no-image.jpg',
				'body' 		=> parse_smileys($msg->message),
				'time' 		=> date("M j, Y, g:i a", strtotime($msg->timestamp)),
				'type'		=> $msg->sender_id == $user ? 'out' : 'in',
				'name'		=> $msg->sender_id == $user ? 'You' : ucwords($owner->firstname)
			);

			$this->_message_notification($msg->sender_id , $msg->recipient_id);

			$response = array(
				'success' => true,
				'message' => $chat	  
			);
		}
		else{
			  $response = array(
				'success' => false,
				'message' => 'Empty fields exists'
				);
		}
		//add the header here
		$output['response'] 	= html_escape($this->security->xss_clean($response));
		$output['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode( $output )) ;
	}

	public function updates(){
	    $new_exists = false;
		$user 		= $this->session->userdata('user_id');
		$last_seen  = $this->chat->get_last_seen_msg('user_id', $user);
		$last_seen  = empty($last_seen) ? 0 : $last_seen->message_id;
		$exists 	= $this->chat->latest_message($user, $last_seen);
		if($exists){
			$new_exists = true;
		}

	    if ($new_exists) {
	        $new_messages = $this->chat->unread($user);
			$thread = array();
			$senders = array();
			foreach ($new_messages as $message) {
				if(!isset($senders[$message->sender_id])){
					$senders[$message->sender_id]['count'] = 1; 
				}
				else{
					$senders[$message->sender_id]['count'] += 1; 
				}
				$owner = $this->user->get_by('user_id',$message->sender_id);
				$chat = array(
					'msg' 		=> $message->id,
					'sender' 	=> $message->sender_id, 
					'recipient' => $message->recipient_id,
					'avatar' 	=> $owner->thumbnail != '' ? $owner->thumbnail : 'no-image.jpg',
					'body' 		=> parse_smileys($message->message),
					'time' 		=> date("M j, Y, g:i a", strtotime($message->timestamp)),
					'type'		=> $message->sender_id == $user ? 'out' : 'in',
					'name'		=> $message->sender_id == $user ? 'You' : ucwords($owner->firstname)
					);
				array_push($thread, $chat);
			}

			$groups = array();
			foreach ($senders as $key=>$sender) {
				$sender = array('user'=> $key, 'count'=>$sender['count']);
				array_push($groups, $sender);
			}
			// END OF THE SECTION THAT NEEDS OVERHAUL DESIGN
			$this->last->update_lastSeen($user);

			$response = array(
				'success' => true,
				'messages' => $thread,
				'senders' =>$groups
			);

			//add the header here
			$output['response'] 	= html_escape($this->security->xss_clean($response));
			$output['token'] 		= $this->security->get_csrf_hash();
			header('Content-Type: application/json');
			exit(json_encode( $output ));
	    } 
	}

	public function mark_read(){
		$this->chat->mark_read();
	}

	public function _message_notification($from , $to){

		$this->load->model('EmailOperationsHandler', '_email');
		if($this->user->check_notifications(array('sender'=>$from,'recipient'=>$to))){

			$this->_email->_message_email_notification('message-notification', array('from'=>$from,'to'=>$to));
		}

	}
}
