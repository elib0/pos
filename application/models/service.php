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

	public function exists_model($model_id,$brand_id){
		$this->con->from('model');
		$this->con->where(array('model_name'=>$model_id,'brand_id'=>$brand_id));
		$this->con->limit(1);
		$query = $this->con->get();
		if ($query->num_rows() == 1) { return $query->row()->model_id; }
		return false;
	}
	public function exists_brand($brand_id){
		$this->con->from('brand');
		$this->con->where('brand_name', $brand_id);
		$this->con->limit(1);
		$query = $this->con->get();
		if ($query->num_rows() == 1) { return $query->row()->brand_id; }
		return false;
	}

	public function save($service_data, $service_id = 0){
		if (!$this->exists_brand($service_data['brand_id'])) 
			$service_data['brand_id']=$this->save_brand($service_data['brand_id']);	
		if (!$this->exists_model($service_data['model_id'],$service_data['brand_id'])) 
			$service_data['model_id']=$this->save_brand($service_data['model_id'],$service_data['brand_id']);
			unset($service_data['brand_id']);		
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
			return (Object) array('service_id'=>-1,'first_name'=>'','last_name'=>'', 'phone_imei'=>'','brand_name'=>'','status'=>'','model_name'=>'','comments'=>'');
		}
	}

	public function suggest($search = ''){
		$search = $this->con->escape($search);

		$this->con->from('service_log');
		$this->con->join('people', 'people.person_id = service_log.person_id');
		$this->con->join('model', 'service_log.model_id = model.model_id');
		$this->con->where("CONCAT(service_log.phone_imei, ' ', people.first_name, ' ',people.last_name, ' ',  model.model_name) LIKE '%$search%'");
		return $this->con->get();
	}
	public function suggest_model($search='',$brand=''){
		$suggestions = array();
		$this->con->from('model');
		$this->con->distinct();
		$this->con->like('model_name', $search);
		$this->con->where('brand_id', $brand);
		$this->con->order_by("model_id","asc");
		$by_model = $this->con->get();
		foreach($by_model->result() as $row){ $suggestions[]=$row->model_name; }
		return $suggestions;
	}
	public function suggest_brand($search=''){
		$suggestions = array();
		$this->con->from('brand');
		$this->con->distinct();
		$this->con->like('brand_name', $search);
		$this->con->order_by("brand_id","asc");
		$by_model = $this->con->get();
		foreach($by_model->result() as $row){ $suggestions[]=$row->brand_name; }
		// return $this->con->last_query();
		return $suggestions;
	}
	public function suggest_owner($search=''){
		$suggestions = array();
		$this->con->from('customers');
		$this->con->join('people','people.person_id=customers.person_id');
		$this->con->distinct();
		$this->con->like('first_name', $search);
		$this->con->like('last_name', $search);
		$this->con->order_by("first_name","asc");
		$by_model = $this->con->get();
		foreach($by_model->result() as $row){ $suggestions[]=$row->first_name.' '.$row->last_name; }
		return $suggestions;
	}

}

/* End of file service.php */
/* Location: ./application/models/service.php */