<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Model {

	public $con;
	private $dbs = array();

	// //Constantes
	// const PCONNECT = true;
	// const CACHE_ON = false;
	// const CHAR_SET = 'utf8';
	// const DBCOLLAT = 'utf8_general_ci';
	// const SWAP_PRE = '';

	public function __construct()
	{
		parent::__construct();
		$db = $this->session->userdata('dblocation');
        if($db)
            $this->con = $this->load->database($db, true);
        else
        	$this->con = $this->db;
	}

	private function load_locations(){
		$this->con->select('name,id,hostname,username,password,database,dbdriver,dbprefix,active');
		$this->con->from('locations');
		// $this->con->where('active', 1);
		$query = $this->con->get()->result_array();

		if (count($query) > 0) { 
			foreach ($query as $location) {
				foreach ($location as $key => $value) {
					if ($key == 'name')$group_name = $value;
					$this->dbs[$group_name][$key] = $value;
				}
			}
			// $this->dbs[$group_name]['pconnect'] = $this::PCONNECT;
			// $this->dbs[$group_name]['cache_on'] = $this::CACHE_ON;
			// $this->dbs[$group_name]['char_set'] = $this::CHAR_SET;
			// $this->dbs[$group_name]['dbcollat'] = $this::DBCOLLAT;
			// $this->dbs[$group_name]['swap_pre'] = $this::SWAP_PRE;
		}
	}

	public function get_location($location_id = false){
		$this->con->from('locations');
		$this->con->where('id', $location_id);
		$this->con->limit(1);
		$query = $this->con->get();

		return ($query->num_rows() == 1) ? $query->row_array() : array('id'=>'','name'=>'','hostname'=>'localhost','username'=>'root','database'=>'','dbdriver'=>'','dbprefix'=>'','active'=>false);
	}

	public function get_all_locations(){
		$this->load_locations();
		return $this->dbs;
	}

	function exists($location_id)
	{
		$this->con->from('locations')->where('id', $location_id);
		$query = $this->con->get();

		return ($query->num_rows()==1);
	}

	public function save(&$location_data,$location_id=-1){
		//Cargo utilidad de respaldo de DB
		$this->load->dbutil();

		$b = false;
		if ($this->dbutil->database_exists($location_data['database'])) {
			if ($location_id < 1 or !$this->exists($location_id))
			{
				if($this->con->insert('locations',$location_data))
				{
					$location_data['id']=$this->con->insert_id();

					//Creacion de la nueva BD
					// $query = $this->con->query('CREATE DATABASE IF NOT EXISTS '.$location_data['database']);
					// if ($query) {
					// 	$backup =& $this->dbutil->backup( array(
					// 		'format'=>'sql',
			  //               'filename'    => 'temp.sql',    
			  //               'add_drop'    => TRUE,
			  //               'add_insert'  => FALSE
			  //             	)
					// 	);
					// 	$newdb = $this->load->database($location_data['name'], true);

					// 	$backup=preg_replace("/;\s*$/","", $backup);
					// 	$backup=preg_replace("/;\r?\n/", ";#;;;", $backup);
					// 	$res=explode('#;;;',$backup);

					// 	if (is_array($backup)){
					// 		foreach ($backup as $key) {
					// 			if ($key!=''){
					// 				$newdb->query($key);
					// 				if ($newdb->_error_number()!=0){
					// 					$newdb->db_debug = $db_debug;
					// 				}	
					// 			} 	
					// 		}
					// 		$newdb->db_debug = $db_debug;				
					// 		$b = true;	
					// 	}
					// }
				}
				return $location_id;
			}
		}

		$this->con->where('id', $location_id);
		return $this->con->update('locations',$location_data);
	}

	public function delete($location_id = null){
		$data = array('active'=>0);
		$this->con->where_in('id', $location_id);
		$this->con->update('locations', $data);
	}

	public function get_search_suggestions($search,$limit=5){
		$suggestions = array();
		$this->con->from('locations');
		$this->con->where("CONCAT(name, ' ', hostname, ' ', dbdriver) = '".$search."'");
		$this->con->order_by("name", "asc");
		$by_name = $this->con->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->name;
		}

		return $suggestions;
	}

}

/* End of file location.php */
/* Location: ./application/models/location.php */