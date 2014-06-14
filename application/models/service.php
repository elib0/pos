<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Model { 

	var $con;

	public function __construct()
	{
		parent::__construct();
		$db = $this->session->userdata('dblocation');
        if($db)
            $this->con = $this->load->database($db, true);
        else
            $this->con = $this->db;
	}

	public function exists($service_id){
		$this->con->from('service_log');
		$this->con->where('service_id', $service_id);
		$this->con->limit(1);
		$query = $this->con->get();
		if ($query->num_rows() == 1) {
			return true;
		}
		return false;
	}

	public function save($service_data, $service_id = 0){
		if ( !$brand_id || !$this->exists_model($brand_id) ) {
			$this->con->insert('service_log', $service_data);
			return $this->con->insert_id();
		}else{
			$this->con->where('service_id', $service_id);
			return $this->con->update('service_log', $service_data);
		}

		return false;
	}
 
	public function get_all($limit = 5000, $offset = 5){
		$this->con->from('service_log');
		$this->con->join('model', 'model.model_id = service_log.model_id');
		$this->con->join('brand', 'model.brand_id = brand.brand_id');
		$this->con->join('people', 'people.person_id = service_log.person_id');
		$this->con->limit($limit);
		$this->con->offset($offset);
		return  $this->con->get();
	}

	public function count_all()
	{
		$this->con->from('service_log')->where('deleted',0);
		return $this->con->count_all_results();
	}

	public function get_info($service_id = 0){
		$this->con->from('service_log');
		$this->con->join('model', 'model.model_id = service_log.model_id');
		$this->con->join('brand', 'model.brand_id = brand.brand_id');
		$this->con->join('people', 'people.person_id = service_log.person_id');
		$this->con->where('service_log.service_id', $service_id);
		$this->con->limit(1);
		$query = $this->con->get();

		if ($query->num_rows() == 1) {
			return $query->row();
		}

		return false;
	}

	public function suggest($search = ''){
		$search = $this->con->escape($search);

		$this->con->from('service_log');
		$this->con->join('people', 'people.person_id = service_log.person_id');
		$this->con->join('model', 'service_log.model_id = model.model_id');
		$this->con->where("CONCAT(service_log.phone_imei, ' ', people.first_name, ' ',people.last_name, ' ',  model.model_name) LIKE '%$search%'");
		return $this->con->get();
	}

}

/* End of file service.php */
/* Location: ./application/models/service.php */