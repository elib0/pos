<?php
class Chat_model extends CI_Model{
	/**
	 * Constructor
	 *
	 */
	public $logged=false;
	private $usr=false;
	private $loggedUsr=false;
	private $con=false;
	private $dbgroup='centralized';
	private $table='chat_users';
	private $view='chat_users_view';
	private $chat_view='chat_view';
	private $typing='chat_user_typing';
	private $prefix='';
	private $chat_id=false;

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//Redirect if not logged
		$this->logged=(!!$this->session->userdata('person_id'));
		$this->getCon();
		if($this->logged) $this->usr=$this->getUser();
	}

	// --------------------------------------------------------------------

	function cleanTyping($id=false){
		if(!$id) $id=$this->getUser()->chat_id;
		$this->con->where('from_id',$id);
		$query=$this->con->delete($this->typing);
		return $query?true:false;
	}
	function disableUser($disabled=false){
		$id=$this->getUser()->chat_id;
		$this->con->set('disabled',$disabled?1:0);
		$this->con->where('chat_id',$id);
		$this->con->update($this->table);
	}
	function isDisabledUser($id=false,$disabled=false){
		if(!$id) return false;
		$this->con->set('disabled',$disabled?0:1);
		$this->con->where('chat_id',$id);
		$this->con->update($this->table);
	}
	function getChatId($id,$location)
	{
		if(!$user) return false;
		$this->con->where('user_id',$id);
		$this->con->where('location',$location);
		$query=$this->con->get($this->table);
		if($query->num_rows() > 0)
			return $query->row()->chat_id;
		return false;
	}
	function getChats()
	{
		$this->con->where('recd',0);
		$this->con->where('to_id',$this->user->chat_id);
		$this->con->order_by('id','asc');
		$query=$this->con->get($this->chat_view);
		return $query->result();
	}
	function getChatUsers($update=false){
		$this->updateUsers();
		if($update) $this->updateLoggedUser();
		$this->con->select('chat_id AS c,user AS u,username AS n,location AS l,status_name AS t');
		$this->con->where('disabled',0);
		$this->con->order_by('user_id','asc');
		$query=$this->con->get($this->view);
		if($query->num_rows()>0) return $query;
		return false;
	}
	function getCon($conditions=array(),$fields='')
	{
		if($this->con) return $this->con;
		include('application/config/database.php');
		if (isset( $db[$this->dbgroup] )){
			$this->con = $this->load->database($this->dbgroup,true);
			//a typing se le agrega el prefijo debido a que se realiza una consulta especial
			$this->prefix=$db[$this->dbgroup]['dbprefix'];
		}else{
			show_error('Please set the Connection group and database transactions');
		}
		return $this->con;
	}
	function getUser($id=false)
	{
		if(!$id&&!$this->usr){
			$user=$this->Employee->get_logged_in_employee_info();
			// var_dump($user);
			$id=$this->setChatId($user->person_id,$user->location);
		}elseif(!$id&&$this->usr){
			return $this->usr;
		}elseif(!$id) return false;
		$this->con->where('chat_id',$id);
		$query=$this->con->get($this->view);
		return $query?$query->row():false;
	}//End of getUser Function
	function getUsers($conditions=array(),$fields='')
	{
		$this->updateLoggedUser();
		$this->updateUsers();

		if(count($conditions)>0){
			$this->con->where($conditions);
		}

		$this->con->order_by('user_id','asc');

		if($fields!='')
			$this->con->select($fields);

		$result = $this->con->get($this->view);

		return $result;
	}//End of getUsers Function
	function is_logged()
	{
		if(!$this->logged){
			return false;
		}else{
			return $this->usr->status_id!=0;
		}
	}
	function setChatId($id=false,$location=false)
	{
		if(!$id) $id=$this->getChatId($id,$location);
		if($id) return $id;
		$this->con->set('user_id',$id);
		$this->con->set('location',$location);
		$this->con->set('status',1);
		$this->con->set('disabled',0);
		$this->con->insert($this->table);
		$id=$this->con->insert_id();
		return $id?$id:false;
	}
	function setStatus($chat_id=false,$status=1){
		if(!$chat_id) return false;
		$this->con->set('status',$status);
		$this->con->where('chat_id',$chat_id);
		$this->con->update($this->table);
	}
	function setTyping($to=false,$status=true){
		if(!$to) return false;
		$this->updateLoggedUser();
		$status=$status?1:0;
		$from=$this->getUser()->chat_id;
		$query=$this->con->query("
			INSERT INTO $this->prefix$this->typing SET
				from_id=$from,
				to_id=$to,
				typing=$status
			ON DUPLICATE KEY UPDATE typing=$status
		");
		return $query?true:false;
	}
	function updateUsers()
	{
		$this->con->set('status',0);
		$this->con->where('status in (1,2)');
		$this->con->where('timediff(now(),last_action) > "00:30"');
		$this->con->update($this->table);

		$this->con->set('status',2);
		$this->con->where('status',1);
		$this->con->where('timediff(now(),last_action) > "00:05"');
		$this->con->update($this->table);

		$this->con->set('typing',0);
		$this->con->where('timediff(now(),date) > "00:05"');
		$this->con->update($this->typing);
	}
	function updateLoggedUser()
	{
		$id=$this->user->user_id;
		$location=$this->user->location;
		$data=array(
			'username'=>$this->user->username,
			'status'=>1,
		);
		$this->con->where('user_id',$id);
		$this->con->where('location',$location);
		$query=$this->con->get($this->table);

		if($query->num_rows()>0){
			$this->con->where('user_id',$id);
			$this->con->where('location',$location);
			$this->con->update($this->table,$data);
		}else{
			$this->con->set('user_id',$id);
			$this->con->set('location',$location);
			$this->con->insert($this->table,$data);
		}

	}//End of updateLoggedUser Function
}
