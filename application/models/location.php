<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Model {

	public $con;
	private $dbs = array();
	private $dbgroup = 'centralized';

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$db = $this->session->userdata('dblocation');
 //        if($db)
 //            $this->con = $this->load->database($db, true);
 //        else
 //        	$this->con = $this->db;
	// }
	 function __construct()
    {
        parent::__construct();

        include('application/config/database.php');
        if (isset( $db[$this->dbgroup] )){
            $this->con = $this->load->database($this->dbgroup, true); //Unica base de dato centralizada
        }else{
            show_error('Please set the Connection group and database '.$this->dbgroup);
        }
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

	function exists($location_name)
	{
		$this->con->from('locations')->where('name', $location_name);
		$query = $this->con->get();

		return ($query->num_rows()==1);
	}

	public function save(&$location_data,$location_id=0){
		$conn = @mysql_connect($location_data['hostname'], $location_data['username'], $location_data['password']);

		if ($location_id < 1)
		{
			$b = 0;
			if ($conn) {
				if (!$this->exists($location_data['name'])) {
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
									$this->con->dbprefix('employees'),
									$this->con->dbprefix('employees_schedule'),
									$this->con->dbprefix('people'),
									$this->con->dbprefix('permissions'),
									$this->con->dbprefix('employees_profile'),
									$this->con->dbprefix('items'),
									$this->con->dbprefix('items_taxes')
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
								//Stock en 0
								mysql_query('UPDATE ospos_items SET `quantity` = 0, `deleted` = 0, broken_quantity = 0;',$conn);

								//Limpieza de empleados
								mysql_query('DELETE FROM ospos_people WHERE person_id != 1;',$conn);
								mysql_query('DELETE FROM ospos_employees WHERE person_id != 1;',$conn);
								mysql_query('DELETE FROM ospos_employees_schedule WHERE employee_id != 1;',$conn);
								mysql_query('DELETE FROM ospos_permissions WHERE person_id != 1;',$conn);
								mysql_close($conn);
								
								$b = $location_id; //Correcto
							}
						}else{
							$b = -2; //nose creo la tabla
						}
					}else{
						$b = -1; //error al insertar datos del servidor
					}
				}
			}
			return $b;
		}

		if ($conn) {
			$this->con->where('id', $location_id);
			return $this->con->update('locations',$location_data);
		}else{
			return false;
		}
	}

	public function toggle_enable($location_id = null, $value = 0){
		if ($location_id) {
			$data = array('active'=>$value);
			$this->con->where_in('id', $location_id);
			return $this->con->update('locations', $data);
		}

		return false;
	}

	function search($search)
	{
		$this->con->from('locations');
		$this->con->where("name LIKE '%".$this->con->escape_like_str($search)."%'");
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

	public function get_select_option_list($empty_option=false, $show_all=false){
		include('application/config/database.php');
		$dbs = array();
		if ($empty_option) $dbs = array('...'=>'...');
		$show_all = (!$show_all) ? $this->session->userdata('dblocation') : '...';

		foreach ($db as $key => $value){
			if ($key != $show_all && $key != $this->dbgroup) {
				$dbs[$key] = ucwords($key); //Creo arreglo para mis <option>
			}
		}

		return $dbs;
	}

	public function available(){
        $this->load->dbutil();

        return $this->dbutil->database_exists('possp_'.$this->dbgroup) && $this->con;
    }

}

/* End of file location.php */
/* Location: ./application/models/location.php */