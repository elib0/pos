<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once ("secure_area.php");
class Locations extends Secure_area {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Location');
	}

	public function index()
	{
		$data['title'] = 'Administrador de locaciones';
		$data['sub_title'] = 'Tantas locaciones registradas';
		// $data['location'] = $this->session->userdata('dblocation');
		$data['locations'] = $this->Location->get_all_locations();

		$this->load->view('location/manage', $data);
	}

	public function view($location_id = 0){
		$data['data'] = $this->Location->get_location($location_id);
		$data['dbdrivers'] = array('mysql'=>'mysql','mysqli'=>'mysqli','postgre'=>'postgre','odbc'=>'odbc','sqlite'=>'sqlite','oci8'=>'oci8');

		$this->load->view('location/form', $data);
	}

	public function save($location_id=-1){
		$location_data = array(
		'name'=>$this->input->post('location'),
		'hostname'=>$this->input->post('hostname'),
		'username'=>$this->input->post('username'),
		'password'=>$this->input->post('password'),
		'database'=>$this->input->post('database'),
		'dbdriver'=>$this->input->post('dbdriver'),
		'dbprefix'=>$this->input->post('dbprefix'),
		'active'=>$this->input->post('active')?1:0
		);

		if($this->Location->save($location_data,$location_id))
		{
			//New location
			if($location_id==-1)
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_adding').' '.
				$location_data['name'],'item_id'=>$location_data['item_id']));
				$location_id = $location_data['item_id'];
			}
			else //previous location
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_updating').' '.
				$location_data['name'],'item_id'=>$location_id));
			}
		}
		else//failure
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('items_error_adding_updating').' '.
			$location_data['name'],'item_id'=>-1));
		}
	}

	public function delete(){
		// $response = array('status'=>0, 'message'=>'No se han podido borrar');
		$this->Location->delete( $this->input->get_post('location') );
		redirect('locations');
	}
}

/* End of file locations.php */
/* Location: ./application/controllers/locations.php */