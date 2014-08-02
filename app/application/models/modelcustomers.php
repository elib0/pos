<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCustomers extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function get_seek($where="",$limit=" LIMIT 12")
	{
		$query = $this->db->query("
			SELECT 
				a.person_id AS id,
				a.first_name AS first_name,
				a.last_name AS last_name,
				a.phone_number AS phone_number,
				a.email AS email,
				a.address_1 AS address_1,
				a.address_2 AS address_2

			FROM ospos_people a JOIN ospos_customers b ON a.person_id = b.person_id
			$where 
			ORDER BY a.first_name, a.first_name
			$limit
		");
		return $query->result_array();
	}	
}

?>