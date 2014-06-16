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
		if ($query->num_rows() == 1) { return true; }
		return false;
	}

	public function exists_model($model_id){
		$this->con->from('model');
		$this->con->where('model_id', $model_id);
		$this->con->limit(1);
		$query = $this->con->get();
		if ($query->num_rows() == 1) { return true; }
		return false;
	}
	public function exists_brand($brand_id){
		$this->con->from('brand');
		$this->con->where('brand_id', $brand_id);
		$this->con->limit(1);
		$query = $this->con->get();
		if ($query->num_rows() == 1) { return true; }
		return false;
	}

	public function save($service_data, $service_id = 0){
		
		if (!$this->exists($brand_id) ) {
			
			$this->con->insert('service_log', $service_data);
			return $this->con->insert_id();
		}else{
			$this->con->where('service_id', $service_id);
			return $this->con->update('service_log', $service_data);
		}

		return false;
	}
	public function save_brand($brand_data){
		$this->con->insert('brand', $brand_data);
		return $this->con->insert_id();
	}
	public function save_model($model_data){
		$this->con->insert('model', $model_data);
		return $this->con->insert_id();
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
		}else{
			return (Object) array('service_id'=>-1,'first_name'=>'','last_name'=>'', 'phone_imei'=>'','model_name'=>'','comments'=>'');
		}
	}

	public function suggest($search = '', $limit = 5){
		$suggestions = array();
		$search = $this->con->escape($search);
		$table1 = $this->con->dbprefix('service_log');
		$table2 = $this->con->dbprefix('people');
		$table3 = $this->con->dbprefix('model');

		$this->con->from('service_log');
		$this->con->join('people', 'people.person_id = service_log.person_id');
		//$this->con->join('model', 'service_log.model_id = model.model_id');
		//$this->con->where("CONCAT($table1.phone_imei, ' ', $table2.first_name, ' ',$table2.last_name, ' ',  $table3.model_name) LIKE '$search'");
		//$this->con->like("CONCAT($table1.phone_imei, ' ', $table2.first_name, ' ',$table2.last_name)", $search);
		$this->db->where('phone_imei', $search);
		$this->db->limit($limit);
		$query = $this->con->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$suggestions[] = $row->first_name.' '.$row->last_name;
			}
		}

		return $suggestions;
	}

}

/* End of file service.php */
/* Location: ./application/models/service.php */