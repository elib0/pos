<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelZips extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function get_seek($where="",$limit=" LIMIT 12")
	{
		$query = $this->db->query("
			SELECT 
				a.id AS id,
				a.state AS state,
				a.city AS city,
				a.zip AS zip

			FROM ospos_zips a 
			$where 
			ORDER BY a.state, a.city
			$limit
		");
		return $query->result_array();
	}	
}

?>