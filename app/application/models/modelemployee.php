<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelEmployee extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function get_seek($where="",$limit=" LIMIT 12")
	{
		$query = $this->db->query("
			SELECT 
				b.person_id AS id,
				b.first_name AS first_name,
				b.last_name AS last_name,
				b.phone_number AS phone_number,
				b.email AS email,
				b.address_1 AS address_1,
				b.address_2 AS address_2

			FROM ospos_employees a JOIN ospos_people b ON a.person_id = b.person_id
			$where 
			ORDER BY b.first_name, b.first_name
			$limit
		");
		return $query->result_array();
	}	
}

?>