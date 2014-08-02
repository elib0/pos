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
				a.model_id AS id,
				a.model_name AS name,
				b.brand_name AS brand


				

			FROM ospos_model a JOIN ospos_brand b ON a.brand_id = b.brand_id

			$where 

			
			GROUP BY a.model_id, a.model_name, b.brand_name

			ORDER BY a.model_name
			$limit
		");
		return $query->result_array();
	}	
}

?>