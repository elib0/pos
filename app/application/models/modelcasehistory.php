<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCaseHistory extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function insert($data)
	{
		$this->db->insert('ospos_case_history',$data);
	}

}

?>