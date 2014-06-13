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
			return $this->db->update('service_log', $service_data);
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
			return $query->row();
		}

		return false;
	}

	public function suggest($search = ''){
		$search = $this->db->escape($search);

		$this->db->from('service_log');
		$this->db->join('person', 'person.person_id = service_log.person_id');
		$this->db->join('model_phone', 'service_log.model_id = model_phone.model_id');
		$this->db->where("CONCAT(service_log.phone_imei, ' ', person.first_name, ' ',person.last_name, ' ',  model_phone.model_name) LIKE '%$search%'");
		return $this->db->get();
	}

}

/* End of file service.php */
/* Location: ./application/models/service.php */