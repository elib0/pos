<?php
require_once ("person_controller.php");
class Employees extends Person_controller
{
	function __construct()
	{
		parent::__construct('employees');
	}

	function index()
	{
		$config['base_url'] = site_url('/employees/index');
		$config['total_rows'] = $this->Employee->count_all();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_people_manage_table( $this->Employee->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->view('people/manage',$data);
	}

	/*
	Returns employee table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_people_manage_table_data_rows($this->Employee->search($search),$this);
		echo $data_rows;
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		$suggestions = $this->Employee->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}

	/*
	Loads the employee edit form
	*/
	function view($employee_id=-1)
	{
		$data['person_info']=$this->Employee->get_info($employee_id);
		// $data['person_schedule']=$this->Schedule->get_schedule($employee_id);
		$data['all_modules']=$this->Module->get_all_modules();
		$this->load->view("employees/form",$data);
	}

	/*
	Inserts/updates an employee
	*/
	function save($employee_id=-1)
	{
		//Horario personal
		$days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$person_schedule = array();
		foreach ($days as $day) {
			$status = ($this->input->post( strtolower($day) )!='') ? true : false;
			if($status)
				$person_schedule[] = array('day'=>$day,'in'=>$this->input->post('in'.$day).':00:00','out'=>$this->input->post('out'.$day).':00:00');
		};

		$person_data = array(
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'email'=>$this->input->post('email'),
			'phone_number'=>$this->input->post('phone_number'),
			'address_1'=>$this->input->post('address_1'),
			'address_2'=>$this->input->post('address_2'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'zip'=>$this->input->post('zip'),
			'country'=>$this->input->post('country'),
			'comments'=>$this->input->post('comments')
		);
		$permission_data = $this->input->post("permissions")!=false ? $this->input->post("permissions"):array();
		$full_permission_data = array();
		foreach ($permission_data as $subpermission) {
			$subpermissions = $this->input->post($subpermission)!=false? $this->input->post($subpermission):array();
			$full_permission_data[$subpermission] = ( count($subpermissions) > 0 ) ? implode(',', $subpermissions) : 'none';
		}

		//Password has been changed OR first time password set
		if($this->input->post('password')!='')
		{
			$employee_data=array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password'))
			);
		}
		else //Password not changed
		{
			$employee_data=array('username'=>$this->input->post('username'));
		}

		if($id = $this->Employee->save($person_data,$employee_data,$full_permission_data,$employee_id))
		{
			//New employee
			if($employee_id==-1)
			{
				if($this->Schedule->save($person_schedule, $id)){
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('employees_successful_adding').' '.
					$person_data['first_name'].' '.$person_data['last_name'],'person_id'=>$employee_data['person_id']));
				}
			}
			else //previous employee
			{
				if($this->Schedule->save($person_schedule, $employee_id)){
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('employees_successful_updating').' '.
					$person_data['first_name'].' '.$person_data['last_name'],'person_id'=>$employee_id));
				}
			}
		}
		else//failure
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('employees_error_adding_updating').' '.
			$person_data['first_name'].' '.$person_data['last_name'],'person_id'=>-1));
		}
	}

	/*
	This deletes employees from the employees table
	*/
	function delete()
	{
		$employees_to_delete=$this->input->post('ids');

		if($this->Employee->delete_list($employees_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('employees_successful_deleted').' '.
			count($employees_to_delete).' '.$this->lang->line('employees_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('employees_cannot_be_deleted')));
		}
	}
	/*
	get the width for the add/edit form
	*/
	function get_form_width()
	{
		return 650;
	}

	function json_calendar($person_id=0){
		$year = date('Y');
		$month = date('m');
		$events_status = array('incomplete'=>'#CA1C1C', 'notwork'=>'#000', 'working'=>'#0063C6');
		$response = array();

		$month = $this->Employee->get_worked_days($person_id);

		foreach ($month->result() as $day) {
			$color = '';
			$week_day = $this->Employee->get_working_hours($person_id, $day->date);

			//Porcentage de horas trabajas
			$title = ceil(($day->total_segs_worked/$week_day->total_segs_work)*100).'%';
			if ($day->total_segs_worked < $week_day->total_segs_work) {
				$color = $events_status['incomplete'];
			}elseif ($title == '') {
				$color = $events_status['working'];
				$title = 'Working Now';
			}
			array_push($response, array(
				'title'=>$title.' of '.substr($week_day->total_hours, 0, -3).'Hrs',
				'start'=>$day->date,
				'color'=>$color
			));
		}

		echo json_encode($response);
	}

	function worked_report_inputs(){
		$months_worked = array();
		$person_id = $this->input->get('id');
		$year = (isset($_GET['year'])) ? $this->input->get('year') : 0 ;
		$months = $this->Employee->get_worked_details($person_id, $year);

		foreach ($months->result() as $data) {
			array_push($months_worked, array());
		}

		echo json_encode($months_worked);
	}

	function report(){
		if (isset( $_POST['submit'] )) {
			$employee_id= $this->input->post('search');
			$person = $this->Employee->get_info($employee_id);
			$data = array(
				'employee'=>$person->first_name.' '.$person->last_name,
				'employee_id'=>$employee_id,
				'year'=> $this->input->post('year'),
				'month'=> $this->input->post('month')
			);
			$this->load->view("reports/schedule", $data);
		}else{
			foreach (range(date('Y'), date('Y')-10) as $year) {
				$years[$year] = $year;
			}
			$data = array(
				'controller_name'=>'employees',
				'months_of_year'=> array('January','February','March','April','May','June','July','August','September','October','November','December'),
				'years'=>$years,
				'labels_attrib' => array('class'=>'required') 
			);
			$this->load->view("reports/date_input_schedule", $data);
		}
		
	}

	function assistance(){
		$data = array(
			'controller_name' => 'employees',
			'employees_working' => $this->Employee->get_all_working()
		);
		$this->load->view('employees/assistance', $data);
	}


	function open_day(){
		$username = $this->input->post('name');
		$password = $this->input->post('password');

		//Respuesta
		$response = array('message'=>'Invalid User', 'status'=>0);

		$row = $this->Employee->login_($username, $password);
		if($row){
			if ($this->Employee->can_work($row->person_id)) {
				if ( $this->Employee->open_day($row->person_id) ){
					$response['message'] = $row->username;
					$response['user'] = $row->person_id;
					$response['status'] = 1;
				}
			}else{
				$response['message'] = 'Out of Schedule';
				$response['status'] = -1;
			}
		}
		
		die(json_encode($response));
	}

	function close_day()
	{
		$person_id = $this->input->post('id');
		$password = $this->input->post('logoutpass');
		if ( $this->Employee->close_day( $person_id ) ) {
			echo 1;
		}else{
			echo 0;
		}
	}

}
?>
