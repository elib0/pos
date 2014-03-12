<?php
class Employee extends Person
{
	var $con;

    function __construct()
    {
    	$this->load->helper('date'); //Cargo helper de codeignier para las fechas

        parent::__construct();
        //Seleccion de DB
        // $this->session->set_userdata(array('dblocation'=>'other'));
        $db = $this->session->userdata('dblocation');
        if($db)
            $this->con = $this->load->database($db, true);
        else
            $this->con = $this->db;
    }
	/*
	Determines if a given person_id is an employee
	*/
	function exists($person_id)
	{
		$this->con->from('employees');
		$this->con->join('people', 'people.person_id = employees.person_id');
		$this->con->where('employees.person_id',$person_id);
		$query = $this->con->get();

		return ($query->num_rows()==1);
	}

	/*
	Returns all the employees
	*/
	function get_all($limit=10000, $offset=0)
	{
		$this->con->from('employees');
		$this->con->where('deleted',0);
		$this->con->join('people','employees.person_id=people.person_id');
		$this->con->order_by("last_name", "asc");
		$this->con->limit($limit);
		$this->con->offset($offset);
		return $this->con->get();
	}

	function count_all()
	{
		$this->con->from('employees');
		$this->con->where('deleted',0);
		return $this->con->count_all_results();
	}

	function get_worked_details($person_id, $year=0){
		$format = ($year>1970) ? '%M' : '%Y';
		$this->con->select("DATE_FORMAT(date,'".$format."') AS data", false);
		$this->con->from('employees_schedule');
		$this->con->where('logout IS NOT NULL');

		if ($year > 1970) {
			$this->con->where('YEAR(date) = '.$year);		
		}

		$this->con->where('employee_id', $person_id);
		$this->con->group_by("DATE_FORMAT(date,'".$format."')");

		return $this->con->get();
	}

	function get_working_hours($person_id=0, $date=false){
		$this->con->select('day,TIMEDIFF(`out`, `in`) AS total_hours', false);
		$this->con->select('SUM( TIME_TO_SEC(`out`) - TIME_TO_SEC(`in`) ) AS total_segs_work', false);
		$this->con->from('schedules');
		$this->con->where('person_id', $person_id);
		$this->con->where('day', date('l',strtotime($date)));
		$query = $this->con->get();

		if($query->num_rows()==1){
			return $query->row();
		}else{
			return false;
		}
	}

	function get_worked_days($person_id, $day=0){
		$this->con->select('date, SEC_TO_TIME(SUM(TIME_TO_SEC(logout) - TIME_TO_SEC(login))) AS worked_hours, location', false);
		$this->con->select('SUM( TIME_TO_SEC(logout) - TIME_TO_SEC(login) ) AS total_segs_worked', false);
		$this->con->group_by('date');
		$this->con->from('employees_schedule');
		if ($day > 0) {
			$this->con->where('DAY(day) = '.$day);
		}
		$this->con->where('employee_id', $person_id);

		return $this->con->get();
	}

	function get_all_working(){
		$this->con->from('employees_schedule');
		$this->con->join('people', 'employees_schedule.employee_id = people.person_id');
		$this->con->where('employees_schedule.date = CURDATE()');
		$this->con->where('employees_schedule.logout IS NULL');
		$query = $this->con->get();

		if ($query->num_rows > 0) {
			return $query;
		}
		return false;
	}

	/*
	Gets information about a particular employee
	*/
	function get_info($employee_id)
	{
		$this->con->from('employees');
		$this->con->join('people', 'people.person_id = employees.person_id');
		$this->con->where('employees.person_id',$employee_id);
		$query = $this->con->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $employee_id is NOT an employee
			$person_obj=parent::get_info(-1);

			//Get all the fields from employee table
			$fields = $this->con->list_fields('employees');

			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			return $person_obj;
		}
	}

	/*
	Gets information about multiple employees
	*/
	function get_multiple_info($employee_ids)
	{
		$this->con->from('employees');
		$this->con->join('people', 'people.person_id = employees.person_id');
		$this->con->where_in('employees.person_id',$employee_ids);
		$this->con->order_by("last_name", "asc");
		return $this->con->get();
	}

	/*
	Inserts or updates an employee
	*/
	function save(&$person_data, &$employee_data,&$permission_data,$employee_id=false)
	{
		$success=false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->con->trans_start();

		if($idaux = parent::save($person_data,$employee_id))
		{
			if (!$employee_id or !$this->exists($employee_id))
			{
				$employee_data['person_id'] = $employee_id = $person_data['person_id'];
				if( $this->con->insert('employees',$employee_data) ) $success = $employee_data['person_id'];
			}
			else
			{
				$this->con->where('person_id', $employee_id);
				$success = $this->con->update('employees',$employee_data);
			}

			//We have either inserted or updated a new employee, now lets set permissions.
			if($success)
			{
				//First lets clear out any permissions the employee currently has.

				//Now insert the new permissions
				if($this->con->delete('permissions', array('person_id' => $employee_id))) //Borra permisos actuales
				{
					foreach($permission_data as $allowed_module => $privileges)
					{
						$this->con->insert('permissions',
						array(
						'module_id'=>$allowed_module,
						'person_id'=>$employee_id,
						'privileges'=>$privileges
						));
					}
				}
			}

		}

		$this->con->trans_complete();
		return $success;
	}

	/*
	Deletes one employee
	*/
	function delete($employee_id)
	{
		$success=false;

		//Don't let employee delete their self
		if($employee_id==$this->get_logged_in_employee_info()->person_id)
			return false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->con->trans_start();

		//Delete permissions
		if($this->con->delete('permissions', array('person_id' => $employee_id)))
		{
			$this->con->where('person_id', $employee_id);
			$success = $this->con->update('employees', array('deleted' => 1));
		}
		$this->con->trans_complete();
		return $success;
	}

	/*
	Deletes a list of employees
	*/
	function delete_list($employee_ids)
	{
		$success=false;

		//Don't let employee delete their self
		if(in_array($this->get_logged_in_employee_info()->person_id,$employee_ids))
			return false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->con->trans_start();

		$this->con->where_in('person_id',$employee_ids);
		//Delete permissions
		if ($this->con->delete('permissions'))
		{
			//delete from employee table
			$this->con->where_in('person_id',$employee_ids);
			$success = $this->con->update('employees', array('deleted' => 1));
		}
		$this->con->trans_complete();
		return $success;
 	}

	/*
	Get search suggestions to find employees
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->con->from('employees');
		$this->con->join('people','employees.person_id=people.person_id');
		$this->con->where("(first_name LIKE '%".$this->con->escape_like_str($search)."%' or
		last_name LIKE '%".$this->con->escape_like_str($search)."%' or
		CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->con->escape_like_str($search)."%') and deleted=0");
		$this->con->order_by("last_name", "asc");
		$by_name = $this->con->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->person_id.'|'.$row->first_name.' '.$row->last_name;
		}

		$this->con->from('employees');
		$this->con->join('people','employees.person_id=people.person_id');
		$this->con->where('deleted', 0);
		$this->con->like("email",$search);
		$this->con->order_by("email", "asc");
		$by_email = $this->con->get();
		foreach($by_email->result() as $row)
		{
			$suggestions[]=$row->email;
		}

		$this->con->from('employees');
		$this->con->join('people','employees.person_id=people.person_id');
		$this->con->where('deleted', 0);
		$this->con->like("username",$search);
		$this->con->order_by("username", "asc");
		$by_username = $this->con->get();
		foreach($by_username->result() as $row)
		{
			$suggestions[]=$row->username;
		}


		$this->con->from('employees');
		$this->con->join('people','employees.person_id=people.person_id');
		$this->con->where('deleted', 0);
		$this->con->like("phone_number",$search);
		$this->con->order_by("phone_number", "asc");
		$by_phone = $this->con->get();
		foreach($by_phone->result() as $row)
		{
			$suggestions[]=$row->phone_number;
		}


		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}

	/*
	Preform a search on employees
	*/
	function search($search)
	{
		$this->con->from('employees');
		$this->con->join('people','employees.person_id=people.person_id');
		$this->con->where("(first_name LIKE '%".$this->con->escape_like_str($search)."%' or
		last_name LIKE '%".$this->con->escape_like_str($search)."%' or
		email LIKE '%".$this->con->escape_like_str($search)."%' or
		phone_number LIKE '%".$this->con->escape_like_str($search)."%' or
		username LIKE '%".$this->con->escape_like_str($search)."%' or
		CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->con->escape_like_str($search)."%') and deleted=0");
		$this->con->order_by("last_name", "asc");

		return $this->con->get();
	}

	function can_work($person_id=0){
		$b = 1;
		$this->con->select('SUM(TIME_TO_SEC(ospos_employees_schedule.`logout`) - TIME_TO_SEC(ospos_employees_schedule.`login`)) AS trabajado,SUM(TIME_TO_SEC(ospos_schedules.`out`) - TIME_TO_SEC(ospos_schedules.`in`)) AS trabajar', false);
		$this->con->from('employees_schedule');
		$this->con->join('schedules', 'employees_schedule.employee_id = schedules.person_id');
		$this->con->where('employees_schedule.date = CURDATE()');
		$this->con->where("schedules.`day` = DATE_FORMAT(CURDATE(),'%W')");
		$this->con->where('employees_schedule.employee_id', $person_id);
		$query = $this->con->get();

		if ($query->num_rows()==1) {
			$rs = $query->row();
			if ($rs->trabajado != '') {						//Fixes devuelve valores nulls
				if ($rs->trabajado >= $rs->trabajar) {
					$b = 0;
				}
			}
		}

		return $b;
	}

	/*
	Attempts to login employee and set session. Returns boolean based on outcome.
	*/
	function login($username, $password)
	{
		$this->con->from('employees');
		$this->con->join('schedules','employees.person_id=schedules.person_id');
		$this->con->where( array('employees.username' => $username,'employees.password'=>md5($password)) );
		$this->con->where( 'employees.deleted', 0 );
		$this->con->where( array('schedules.day'=>date('l')) ); //Verifica que trabaje ese dia
		$this->con->where( 'CURTIME() BETWEEN ospos_schedules.in AND ospos_schedules.out' ); //Verifica que este en su horario
		$employee = $this->con->get();

		if ($employee->num_rows() ==1)
		{
			$row=$employee->row();
			if ($this->can_work($row->person_id)) {
				$this->session->set_userdata('person_id', $row->person_id);
				return true;
			}
		}
		return false;
	}

	function login_($username, $password)
	{
		$this->con->from('employees');
		$this->con->join('schedules','employees.person_id=schedules.person_id');
		$this->con->where( array('employees.username' => $username,'employees.password'=>md5($password)) );
		$this->con->where( 'employees.deleted', 0 );
		$this->con->where( array('schedules.day'=>date('l')) ); //Verifica que trabaje ese dia
		$this->con->where( 'CURTIME() BETWEEN ospos_schedules.in AND ospos_schedules.out' ); //Verifica que este en su horario
		$employee = $this->con->get();
		
		if ($employee->num_rows() ==1)
		{
			return $employee->row();
		}
		return false;
	}

	/**
	 * Abre Log de hora trabajadas por dia y localidad
	 * @param  INT $employee_id Id del empleado o persona
	 * @return [boolean]              [True o False segun sea]
	 */
	function open_day($employee_id){
		$b = 0;
		$data = array(
			'employee_id' => $employee_id,
			'date'      => date('Y-m-d'),
			'login'     => date('H:i:s'),
			'location'  => $_SESSION['dblocation']
		);

		$ewn = ( $this->session->userdata('employees_working_now') ) ? $this->session->userdata('employees_working_now') :  array(0);

		//Si el registro se inserta satisfactoriamente resultadod = true
		if ( !in_array($employee_id, $ewn) ) {
			if ( $this->con->insert('employees_schedule', $data) ){
				$b = 1;
				array_push($ewn, $employee_id);
				$this->session->set_userdata('employees_working_now', $ewn);
			}
		}else{
			$b = 3;
		}

		return $b;
	}

	/**
	 * Cierra el log del dia trabajado por localidad
	 * @param  INT $employee_id Id del empleado o persona a registrar
	 * @return [boolean]              [True o False segun sea]
	 */
	function close_day($employee_id){
		$b = false;
		$this->con->where('employee_id', $employee_id); 				//Que sea el empleado logueado
		$this->con->where('date = CURDATE()');							//Que la fecha sea hoy
		$this->con->where('logout IS NULL');							//Que no tenga marcada la salida ya
		$this->con->where("location = '".$_SESSION['dblocation']."'"); 	//Que sea la misma location

		if ( $this->db->update('employees_schedule', array('logout'=>date('H:i:s'))) ){
			$b = true;
			$ewn = $this->session->userdata('employees_working_now');
			unset($ewn[array_search($employee_id, $ewn)]);
			$this->session->set_userdata('employees_working_now', $ewn);
		}

		return $b;
	}

	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	function logout($otherUser = '')
	{
		$pageRedirect = 'login/index';
		if($otherUser != '') $pageRedirect .= '/'.$otherUser;
		$employee = $this->get_logged_in_employee_info();
		if ( $employee = $this->close_day( $employee->person_id ) ) {
			$this->session->sess_destroy();
			unset($_SESSION['dblocation']);
			redirect( $pageRedirect );
		}
	}

	/*
	Determins if a employee is logged in
	*/
	function is_logged_in()
	{
		return $this->session->userdata('person_id')!=false;
	}

	/*
	Gets information about the currently logged in employee.
	*/
	function get_logged_in_employee_info()
	{
		if($this->is_logged_in())
		{
			return $this->get_info($this->session->userdata('person_id'));
		}

		return false;
	}

	/*
	Determins whether the employee specified employee has access the specific module.
	*/
	function has_permission($module_id,$person_id)
	{
		//if no module_id is null, allow access
		if($module_id==null)
		{
			return true;
		}

		$query = $this->con->get_where('permissions', array('person_id' => $person_id,'module_id'=>$module_id), 1);
		return $query->num_rows() == 1;


		return false;
	}

}
?>
