<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function getRow()
	{
		$query = $this->db->query("SELECT * FROM company WHERE id = '1' LIMIT 1 ");
        return $query->row();
	}

	
}