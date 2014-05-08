<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Model {

	public $con;
	private $dbs = array();

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
		$query = $this->con->get()->result_array();

		if (count($query) > 0) { 
			foreach ($query as $location) {
				foreach ($location as $key => $value) {
					if ($key == 'name')$group_name = $value;
					$this->dbs[$group_name][$key] = $value;
				}
			}
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

	public function save(&$location_data,$location_id=0){
		if ($location_id < 1 or !$this->exists($location_id))
		{
			$b = 0;
			$conn = mysql_connect($location_data['hostname'], $location_data['username'], $location_data['password']);
			if ($conn) {
				if ($this->con->insert('locations',$location_data)) {
					$location_id = $this->con->insert_id();
					$query = $this->con->query('CREATE DATABASE IF NOT EXISTS '.$location_data['database']);
					if ($query) {
						if (mysql_select_db($location_data['database'], $conn)) {
							//Cargo mi base de datos sin datos para la nueva location
							$this->load->dbutil();
							$tables = array(
								$this->con->dbprefix('app_config'),
								$this->con->dbprefix('modules'),
								$this->con->dbprefix('employees_profile')
							);
							$backup1 =& $this->dbutil->backup(array('format'=>'sql','tables'=>$tables,'add_drop'=>false));
							$backup2 =& $this->dbutil->backup(array('format'=>'sql','add_insert'=>FALSE,'add_drop'=>false, 'ignore'=>$tables));
							$backup = $backup1.$backup2;
							//A continuacion limpiamos la cadena sql y la separamos a un arreglo
							$backup=preg_replace("/;\s*$/","", $backup);
							$backup=preg_replace("/;\r?\n/", ";#;;;", $backup);
							$res=explode('#;;;',$backup);

							foreach ($res as $query) {
								if ($query!=''){
									$result = mysql_query($query,$conn);
								}
							}
							mysql_close($conn);

							//inserta el usuario en sesion
							$person = $this->Employee->get_logged_in_employee_info();
							$person_data = array(
								'first_name'=>$person->first_name,
								'last_name'=>$person->last_name,
								'email'=>$person->email,
								'phone_number'=>$person->phone_number,
								'address_1'=>$person->address_1,
								'address_2'=>$person->address_2,
								'city'=>$person->city,
								'state'=>$person->state,
								'zip'=>$person->zip,
								'country'=>$person->country,
								'comments'=>$person->comments
							);

							$employee_data=array(
							'username'=>$person->username,
							'password'=>$person->password,
							'type_employees'=>$person->employee_profile_type
							);

							// $new_db_group = $this->load->database($location_data['name'], true);
							$this->Employee->set_location($location_data['name'])->save($person_data, $employee_data,array());
							
							$b = $location_id; //Correcto
						}
					}else{
						$b = -2; //nose creo la tabla
					}
				}else{
					$b = -1; //error al insertar datos del servidor
				}
			}
			return $b;
		}

		$this->con->where('id', $location_id);
		return $this->con->update('locations',$location_data);
	}

	public function delete($location_id = null){
		$data = array('active'=>0);
		$this->con->where_in('id', $location_id);
		$this->con->update('locations', $data);
	}

	function search($search)
	{
		$this->con->from('locations');
		$this->con->where("(name LIKE '%".$this->con->escape_like_str($search)."%' or
		hostname LIKE '%".$this->con->escape_like_str($search)."%' or
		dbdriver LIKE '%".$this->con->escape_like_str($search)."%')");
		$this->con->order_by("name", "asc");
		return $this->con->get();
	}

	public function get_search_suggestions($search,$limit=5){
		$suggestions = array();
		$this->con->from('locations');
		// $this->con->where("CONCAT(name, ' ', hostname, ' ', dbdriver) = '".$search."'");
		$this->con->where('name', $search);
		$this->con->order_by("name", "asc");
		$query = $this->con->get();
		foreach($query->result() as $row)
		{
			$suggestions[]=$row->name;
		}

		return $suggestions;
	}

}

/* End of file location.php */
/* Location: ./application/models/location.php */