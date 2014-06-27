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
	public function exists_person($person_id){
		$this->con->from('customers');
		$this->con->join('people','people.person_id=customers.person_id');
		$this->con->where('CONCAT(first_name," ",last_name)=', $person_id);
		$this->con->limit(1);
		$query = $this->con->get();
		if ($query->num_rows() == 1) { return $query->row()->person_id; }
		return false;
	}

	public function toggle_delete($service_id = null, $value = 1){
		if ($service_id) {
			$data = array('deleted'=>$value);
			$this->con->where_in('service_id',$service_id);
			return $this->con->update('service_log',$data);
		}
		return false;
	}
	public function delete_items($service_id=false,$item_id=false){
		if($service_id&&$this->exists($service_id)&&$item_id){
			$this->con->where('service_id',$service_id);
			if(is_array($item_id)){
				$this->con->where_in('item_id',$item_id);
			}elseif($item_id!==true){
				$this->con->where('item_id',$item_id);
			}
			return $this->con->delete('service_items');
		}
		return false;
	}

	public function save($service_data, $service_id = -1){
		if (!$this->exists($service_id) ) {
			$brand_id=$this->exists_brand($service_data['brand_id']);
			if (!$brand_id)
				$brand_id=$this->save_brand(array('brand_name'=>$service_data['brand_id']));
			$model_id=$this->exists_model($service_data['model_id'],$brand_id);
			if (!$model_id)
				$model_id=$this->save_model(array('model_name'=>$service_data['model_id'],'brand_id'=>$brand_id));
			unset($service_data['brand_id']);
			$service_data['model_id']=$model_id;
			$this->con->insert('service_log', $service_data);
			return $this->con->insert_id();
			// return $this->con->last_query();
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
	public function save_items($service_id=false,$items=array()){
		if($service_id&&$this->exists($service_id)&&is_array($items)&&count($items)>0){
			foreach($items as $item){
				$this->con->insert('service_items',array('service_id'=>$service_id,'item_id'=>$item));
			}
		}else
			return false;
	}
	public function get_all($limit = 5000, $offset = 5){
		$this->con->from('service_log');
		$this->con->join('model','model.model_id = service_log.model_id');
		$this->con->join('brand','model.brand_id = brand.brand_id');
		$this->con->join('people','people.person_id = service_log.person_id');
		$this->con->limit($limit);
		$this->con->offset($offset);
		return $this->con->get()->result();
	}

	public function get_all_filtered($data= array())
	{
		if(is_array($data)&&count($data)>0){

			$this->con->from('service_log');

			$this->con->join('model','model.model_id = service_log.model_id');
			$this->con->join('brand','model.brand_id = brand.brand_id');
			$this->con->join('people','people.person_id = service_log.person_id');

			if (isset($data['filter_today'])&&$data['filter_today']!='')
			{
				$this->con->where('DATE(date_received) = CURDATE()');
			}

			if (isset($data['filter_yesterday'])&&$data['filter_yesterday']!='')
			{
				$this->con->where('DATE(date_received) = DATE(CURDATE()-1)');
			}
			if (isset($data['filter_lastweek'])&&$data['filter_lastweek']!='' )
			{
				$this->con->where('date_received between date_sub(now(),INTERVAL 1 WEEK) and now()');
			}

			if (isset($data['filter_status'])&&$data['filter_status']!=''&&$data['filter_status']!=0 )
			{
				$this->con->where('service_log.status',$data['filter_status']);
			}

			$this->con->where('deleted',0);
			$this->con->order_by('date_received', 'asc');
			return $this->con->get()->result();

		}else return false;

	}
	public function get_items($service_id=false){
		if($service_id&&$this->exists($service_id)){
			$array=array();
			$this->con->select('service_items.item_id AS id,items.name AS text');
			$this->con->where('service_items.service_id',$service_id);
			$this->con->join('items', 'service_items.item_id = items.item_id');
			$query=$this->con->get('service_items');
			if($query->num_rows()>0){
				$array=$query->result_array();
			}
			return $array;
		}
		return false;
	}
	public function get_id_items($service_id=false){
		$array=array();
		if($service_id&&$this->exists($service_id)){
			$this->con->select('item_id');
			$this->con->where('service_id',$service_id);
			$query=$this->con->get('service_items');
			if($query->num_rows()>0){
				foreach($query->result() as $row){
					$array[]=$row->item_id;
				}
			}
		}
		return $array;
	}

	public function search($service_id, $term, $limit = 5000, $offset = 5){

		$this->con->from('service_log');
		$this->con->join('model','model.model_id = service_log.model_id');
		$this->con->join('brand','model.brand_id = brand.brand_id');
		$this->con->join('people','people.person_id = service_log.person_id');
		$this->con->where('service_log.service_id',$service_id);
		$by_id=$this->con->get();
		$by_term=$this->suggest2($term,$service_id);

		$by_id	= $by_id?$by_id->result():array();
		$by_term= $by_term?$by_term->result():array();

		return array_merge($by_id,$by_term);
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
		//$this->con->where("CONCAT($table1.phone_imei, ' ', $table2.first_name, ' ',$table2.last_name, ' ', $table3.model_name) LIKE '$search'");
		//$this->con->like("CONCAT($table1.phone_imei, ' ', $table2.first_name, ' ',$table2.last_name)", $search);
		$this->db->where('phone_imei', $search);
		$this->db->limit($limit);
		$query = $this->con->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$suggestions[] = $row->service_id.'|'.$row->first_name.' '.$row->last_name;
			}
		}

		return $suggestions;
	}

	public function suggest2($search = '', $without=false){
		$suggestions = array();
		$this->con->from('service_log');
		$this->con->join('people', 'service_log.person_id = people.person_id ');
		$this->con->join('model', 'service_log.model_id = model.model_id');
		$this->con->join('brand', 'model.brand_id = brand.brand_id');

		$searches = explode(' ', $search);
		foreach ($searches as $key=>$word) {
			$this->con->like('CONCAT_WS(" ",first_name,last_name,phone_number,model_name,brand_name)', $word);
		}
		if($without)$this->con->where('service_id !=', $without);
		$query = $this->con->get();

		if($query->num_rows()>0){
			return $query;
		}
		return false;
	}

	public function count_all()
	{
		$this->con->from('service_log')->where('deleted',0);
		return $this->con->count_all_results();
	}

	public function get_info($service_id = 0){
		$this->con->from('service_log');
		$this->con->join('model','model.model_id = service_log.model_id');
		$this->con->join('brand','model.brand_id = brand.brand_id');
		$this->con->join('people','people.person_id = service_log.person_id');
		$this->con->where('service_log.service_id', $service_id);
		$this->con->limit(1);
		$query = $this->con->get();

		if ($query->num_rows() == 1) {

			$info=$query->row();

			return $info;
		}else{
			return (Object) array(
				'service_id'=>-1,
				'first_name'=>'',
				'last_name'=>'',
				'serial'=>'',
				'brand_name'=>'',
				'status'=>'',
				'model_name'=>'',
				'comments'=>'',
				'person_id'=>'',
				'items'=>array()
			);
		}
	}

	public function suggest_model($search='',$brand=''){
		$suggestions = array();
		$this->con->select('model_name');
		$this->con->from('model');
		$this->con->join('brand','ospos_brand.brand_id=ospos_model.brand_id');
		$this->con->distinct();
		$this->con->like('model_name', $search);
		if ($brand!='') $this->con->where('brand_name', $brand);
		$this->con->order_by('model_id','asc');
		$by_model = $this->con->get();
		foreach($by_model->result() as $row) $suggestions[]=$row->model_name;
		return $suggestions;
		// return $this->con->last_query();
	}
	public function suggest_brand($search=''){
		$suggestions = array();
		$this->con->select('brand_name');
		$this->con->from('brand');
		$this->con->distinct();
		$this->con->like('brand_name', $search);
		$this->con->order_by('brand_id','asc');
		$by_model = $this->con->get();
		foreach($by_model->result() as $row) $suggestions[]=$row->brand_name;
		// return $this->con->last_query();
		return $suggestions;
	}
	public function suggest_owner($search=''){
		$suggestions = array();
		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where('(first_name LIKE "%'.$this->con->escape_like_str($search).'%" or
		last_name LIKE "%'.$this->con->escape_like_str($search).'%" or
		CONCAT(`first_name`," ",`last_name`) LIKE "%'.$this->con->escape_like_str($search).'%") and deleted=0');
		$this->con->order_by('last_name','asc');
		$by_model = $this->con->get();

		foreach($by_model->result() as $row){ $suggestions[]=$row->first_name.' '.$row->last_name; }
		// return $this->con->last_query();
		return $suggestions;
	}

}

/* End of file service.php */
/* Location: ./application/models/service.php */