<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPhoneModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function get_seek($where="",$limit=" LIMIT 12")
	{
		$query = $this->db->query("
			SELECT 
				model_id AS id,
				model_name AS name
			FROM ospos_model
			$where 		
			GROUP BY model_id, model_name
			ORDER BY model_name
			$limit
		");
		return $query->result_array();
	}	
}

?>