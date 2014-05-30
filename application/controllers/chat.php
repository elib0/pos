<?php
class Chat extends CI_Controller{
	//Global variable
	public $outputData;//Holds the output data for each view
	public $user=array();
	private $con=false;
	private $chat=false;

	function __construct(){
		parent::__construct();
		//Load the chat users model
		$this->load->model('chat_model');
		$_logged=$this->chat_model->is_logged();
		$this->con=$this->chat_model->getCon();
		$this->user=$this->chat_model->getUser();
		//Load the session library
		$this->load->library('session');
		$this->chat=$this->session->userdata('chat');
		if(!$this->chat) $this->chat=array();
	}
	function __destruct(){
		if(count($this->chat)){
			$this->load->library('session');
			$this->session->set_userdata('chat',$this->chat);
		}
	}
	public function print_json($json){
		if(is_array($json)) $json['online']=$this->is_online();
		$this->load->view('partial/json',array('json'=>$json));
	}
	private function is_online(){
		return $this->chat_model->is_logged();
	}
	public function index(){
		if($this->is_online())
			$this->load->view('chat/chat',$this->getUsersList());
		else
			redirect('..');
	}
	function islogged(){
		$this->print_json(array(
			'logged'=>$this->chat_model->logged,
			'status'=>$this->chat_model->getUser()->status_name,
		));
	}
	function startchatsession(){
		$items=array();
		if(!empty($this->chat['openBoxes'])){
			foreach($this->chat['openBoxes'] as $chatbox=>$void){
				foreach($this->chatBoxSession($chatbox) as $item){
					$items[]=$item;
				}
			}
		}
		$data=array(
			'userid'=>$this->user->chat_id,
			'username'=>$this->user->user,
			'items'=>$items,
		);
		$this->print_json($data);
	}
	function closechat(){
		$chatbox = $this->input->post('chatbox');
		unset($this->chat['openBoxes'][$chatbox]);
		$id=$this->chat_model->getLoggedUser()->chat_id;
		$this->chat_model->setStatus($id,0);
		$this->chat_model->cleanTyping();
		$this->chat['status']='offline';
		$this->print_json(1);
	}

	public function disable(){
		$this->chat_model->disableUser(true);
		$this->print_json(1);
	}
	public function enable(){
		$this->chat_model->disableUser(false);
		$this->print_json(1);
	}
	public function chatheartbeat(){
		$items = array();
		$typing = array();
		$chatBoxes = array();
		foreach($this->chat_model->getChats() as $chat){
			if(!isset($this->chat['openBoxes'][$chat->from_id]) && isset($this->chat['history'][$chat->from_id])){
				$items = $this->chat['history'][$chat->from_id];
			}
			$items[]=array(
				's'=>0,
				'f'=>$chat->from_id,
				'u'=>$chat->from,
				'm'=>$this->sanitize($chat->message),
			);
			if(!isset($this->chat['history'][$chat->from_id])){
				$this->chat['history'][$chat->from_id] = '';
			}
			$this->chat['history'][$chat->from_id][]=array(
				's'=>0,
				'f'=>$chat->from_id,
				'u'=>$chat->from,
				'm'=>$chat->message,
			);
			unset($this->chat['tsBoxes'][$chat->from_id]);
			$this->chat['openBoxes'][$chat->from_id] = $chat->sent;
		}
		if(!empty($this->chat['openBoxes'])){
			foreach ($this->chat['openBoxes'] as $chatbox => $time){
				if(!isset($this->chat['tsBoxes'][$chatbox])){
					$now = time()-strtotime($time);
					$time = date('g:iA M dS',strtotime($time));
					$message = "Sent at $time";
					if($now > 180){
						$items[]=array(
							's'=>2,
							'f'=>$chatbox,
							'm'=>$message,
						);
						if(!isset($this->chat['history'][$chatbox])){
							$this->chat['history'][$chatbox] = '';
						}
						$this->chat['history'][$chatbox][]=array(
							's'=>2,
							'f'=>$chatbox,
							'm'=>$message,
						);
						$this->chat['tsBoxes'][$chatbox] = 1;
					}
				}
			}
		}
		$this->con->where('recd',0);
		$this->con->where('to_id',$this->user->chat_id);
		$query=$this->con->update('chat',array('recd'=>1));
		$data=array(
			'ty'=>$typing,
			'items'=>$items,
		);
		$this->print_json($data);
	}
	public function friendslist($update=false){
		$update=$this->input->post('update');
		if(!$this->chat_model->logged) $this->print_json(array());
		$list=$this->chat_model->getChatUsers($update);
		$data=array(
			'a'=>1,
			'f'=>$list?$list->result_array():array(),
			'u'=>$update,
		);
		$this->print_json($data);
	}
	public function starttyping(){
		$to = $this->input->post('to');
		$this->print_json(
			$this->chat_model->setTyping($to,1)
		);
	}
	public function stoptyping(){
		$to = $this->input->post('to');
		$this->print_json(
			$this->chat_model->setTyping($to,0)
		);
	}
	function sendchat(){
		$from = $this->user->chat_id;
		$to = $this->input->post('to');
		$usr = $this->chat_model->getUser($to);
		$name_to = "$usr->username ($usr->location)";
		$message = $this->input->post('message');

		$this->chat['openBoxes'][$to] = date('Y-m-d H:i:s');

		$messagesan = $this->sanitize($message);

		if(!isset($this->chat['history'][$to])){
			$this->chat['history'][$to] = array();
		}

		$this->chat['history'][$to][]=array(
			's'=>1,
			'f'=>$to,
			'u'=>$name_to,
			'm'=>$message,
		);
		unset($this->chat['tsBoxes'][$to]);

		$this->con->set(array(
			'from_id'=>$from,
			'to_id'=>$to,
			'message'=>$message,
		));
		$this->con->insert('chat');
		$this->print_json(1);
	}

	private function chatBoxSession($chatbox){
		$items='';
		if (isset($this->chat['history'][$chatbox])) {
			$items = $this->chat['history'][$chatbox];
			// var_dump($items);
		}
		return $items;
	}
	private function getUsersList(){
		$users=$this->chat_model->getUsers();
		return array(
			'listOfUsers'=>$users,
			'user'=>$this->chat_model->getLoggedUser(),
		);
	}
	private function get_db(){
		include('application/config/database.php');
		return $db;
	}
	private function getCon(){
		$this->load->model('chat_model');
		return $this->chat_model->con;
	}
	private function sanitize($text){
		$text = htmlspecialchars($text, ENT_QUOTES);
		$text = str_replace("\r\n","\n",$text);
		$text = str_replace("\n\r","\n",$text);
		$text = str_replace("\n","<br/>",$text);
		return $text;
	}
}
