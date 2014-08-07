<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelTracking extends CI_Model {
	private $last_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
		$this->last_id = '';	
	}

	public function insert($data)
	{
		$this->db->insert('ospos_service_log',$data);
		$this->last_id = $this->db->insert_id();
	}

	public function get_last_id(){
		return $this->last_id;
	}
}

?>