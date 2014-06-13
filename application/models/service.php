<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Model {

	public $con;

	public function __construct()
	{
		parent::__construct();
	}

	public function exists($service_id){
		$this->db->from('service_log');
		$this->db->where('service_id', $service_id);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return true;
		}
		return false;
	}

	public function save($service_data, $service_id = 0){
		if ( !$brand_id || !$this->exists_model($brand_id) ) {
			$this->db->insert('service_log', $service_data);
			return $this->db->insert_id();
		}else{
			$this->db->where('service_id', $service_id);
			$this->db->update('service_log', $service_data);
		}

		return false;
	}

	public function get_all($limit = 5000, $offset = 5){
		$this->db->get('service_log', $limit, $offset);
	}

	public function get_info($service_id = 0){
		$this->db->from('service_log');
		$this->db->join('model_phone', 'model_phone.model_id = service_log.model_id');
		$this->db->where('service_id', $service_id);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result()->row();
		}

		return false;
	}

	function get_autocomplete($search,$limit=25)
	{
		$suggestions = array();

		$this->con->from('items');
		$this->con->where('deleted',0);
		$this->con->where('item_id >',0);
		$this->con->like('name', $search);
		$this->con->order_by("name", "asc");
		$this->con->limit($limit);
		$by_name = $this->con->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->item_id.'|'.$row->name;
		}

		$this->con->from('items');
		$this->con->where('deleted',0);
		$this->con->where('item_id >',0);
		$this->con->like('item_number', $search);
		$this->con->order_by("item_number", "asc");
		$this->con->limit($limit);
		$by_item_number = $this->con->get();
		foreach($by_item_number->result() as $row)
		{
			$suggestions[]=$row->item_id.'|'.$row->item_number;
		}

		return $suggestions;

	}

}

/* End of file service.php */
/* Location: ./application/models/service.php */