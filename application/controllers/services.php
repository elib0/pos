<?php
require_once ("secure_area.php");
class Services extends Secure_area
//class Services extends CI_Controller
{
	function __construct()
	{
		parent::__construct('services');

	}

	function index()
	{
		$config['base_url'] = site_url('/services/index');
		$config['total_rows'] = $this->Service->count_all();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		
		//$data['services_location']= $this->set_location();
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_services_manage_table( $this->Service->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->view('services/manage',$data);
	}

	function refresh()
	{
		$low_inventory=$this->input->post('low_inventory');
		$is_serialized=$this->input->post('is_serialized');
		$no_description=$this->input->post('no_description');
		$location = $this->input->post('dblocation')!=false? $this->input->post('dblocation'): 'default';

		$data['services_location']= $this->set_location();

		$data['search_section_state']=$this->input->post('search_section_state');
		$data['low_inventory']=$this->input->post('low_inventory');
		$data['is_serialized']=$this->input->post('is_serialized');
		$data['no_description']=$this->input->post('no_description');
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();

		//Paginacion para filtro
		$config['base_url'] = site_url('/services/index');
		$config['total_rows'] = $this->Service->get_all_filtered($low_inventory,$is_serialized,$no_description, $location)->num_rows();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);


		$data['manage_table']=get_services_manage_table($this->Service->get_all_filtered($low_inventory,$is_serialized,$no_description, $location),$this);
		$this->load->view('services/manage',$data);
	}

	function find_service_info()
	{
		$service_number=$this->input->post('scan_service_number');
		echo json_encode($this->Service->find_service_info($service_number));
	}

	function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_services_manage_table_data_rows($this->Service->search($search),$this);
		echo $data_rows;
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		$suggestions = $this->Service->suggest($this->input->post('q'));
		echo implode("\n",$suggestions);
	}

	function service_search()
	{
		$suggestions = $this->Service->get_service_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}

	function get_row()
	{
		$service_id = $this->input->post('row_id');
		$data_row=get_service_data_row($this->Service->get_info($service_id),$this);
		echo $data_row;
	}

	function view($service_id=-1)
	{
		$data['service_info']=$this->Service->get_info($service_id);
		$this->load->view("services/form",$data);
	}

	function count_details($service_id=-1)
	{
		$data['service_info']=$this->Service->get_info($service_id);
		$this->load->view("services/count_details",$data);
	} //------------------------------------------- Ramel

	function save($service_id=-1){
		$service_data = array(
		'person_id'=>$this->input->post('name'),
		'phone_imei'=>$this->input->post('description'),
		'codeimei'=>$this->input->post('category'),
		'brand_id'=>$this->input->post('brand'),
		'model_id'=>$this->input->post('model'),
		'status'=>$this->input->post('status')
		);
		// $cur_service_info = $this->Service->get_info($service_id);
		if($this->Service->save($service_data,$service_id)){
			//New service
			if($service_id==-1){
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_adding').' '.$service_data['name'],'service_id'=>$service_data['service_id'],'pictures'=>$dat));
				// $service_id = $service_data['service_id'];
			}else{ //previous service
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_updating').' '.$service_data['name'],'service_id'=>$id,'pictures'=>$dat));
			}
		}else{ //failure
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_updating').' '.$service_data['name'],'service_id'=>-1));
		}

	}
	function suggest_models($brand=''){
		$brand=$this->Service->exists_brand($brand);
		if (!$brand || $brand==='') echo implode("\n",array());
		else{ 
			$suggestions = $this->Service->suggest_model($this->input->post('q'),$brand);
			echo implode("\n",$suggestions);
		}
	}
	function suggest_brand($module=''){
		$suggestions = $this->Service->suggest_brand($this->input->post('q'));
		// echo $suggestions.'hoooooola-'.$this->input->post('q');
		echo implode("\n",$suggestions);
	}
	function suggest_owner($module=''){
		$suggestions = $this->Service->suggest_owner($this->input->post('q'));
		echo implode("\n",$suggestions);
	}
	/*
	get the width for the add/edit form
	*/
	function get_form_width(){ return '660/height:465'; }

}
