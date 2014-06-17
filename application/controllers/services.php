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


	public function delete(){
		$this->Service->toggle_delete( $this->input->post('services') );
		redirect('services');
	}

	function save($service_id=-1){
		$person_id=$this->Service->exists_person($this->input->post('name'));
		if (!$person_id && $this->input->post('name'))
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_person'),'service_id'=>-1,'noOw'=>true));
		else{
			if ($service_id!=-1){
				$service_data = array(
					'comments'=>$this->input->post('comments'),
					'status'=>$this->input->post('status')
				);
			}else{
				$data=true;
				if ($this->input->post('first_name')){ 
					$data=false;
					$person_data = array(
						'first_name'=>$this->input->post('first_name'),
						'last_name'=>$this->input->post('last_name'),
						'email'=>$this->input->post('email'),
						'phone_number'=>$this->input->post('phone_number'),
						'address_1'=>'','address_2'=>'','city'=>'',
						'state'=>'','zip'=>'','country'=>'','comments'=>''
					);
					$customer_data=array('account_number'=>null,'taxable'=>0 );
					if($this->Customer->save($person_data,$customer_data,-1)){
						$data=true;
						$person_id=$customer_data['person_id'];
					} 
				}
				if (!$data) echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_person'),'service_id'=>-1,'noAddOw'=>true));
				elseif(is_array($data)) $person_id=isset($data['add'])?$data['add']:$data['update'];
				$service_data = array(
				'person_id'=>$person_id,
				'serial'=>$this->input->post('codeimei'),
				'comments'=>$this->input->post('comments'),
				'brand_id'=>$this->input->post('brand'),
				'model_id'=>$this->input->post('model'),
				'status'=>$this->input->post('status')
				);
			}
			// $cur_service_info = $this->Service->get_info($service_id);
			$service=$this->Service->save($service_data,$service_id);
			if($service){
				if($service_id==-1){ //New service
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_adding'),'service_id'=>$service));
				}else{ //previous service
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_updating'),'service_id'=>$service_id));
				}
			}else{ //failure
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_updating').' '.$service_data['person_id'],'service_id'=>-1));
			}
		}
	}
	function suggest_models($brand=''){
		$suggestions = $this->Service->suggest_model($this->input->post('q'),$brand);
		echo implode("\n",$suggestions);
		// echo $suggestions;	
	}
	function suggest_brand($module=''){
		$suggestions = $this->Service->suggest_brand($this->input->post('q'));
		// echo $suggestions.'hoooooola-'.$this->input->post('q');
		echo implode("\n",$suggestions);
	}
	function suggest_owner($module=''){
		$suggestions = $this->Service->suggest_owner($this->input->post('q'));
		// echo $suggestions;
		echo implode("\n",$suggestions);
	}
	/*
	get the width for the add/edit form
	*/
	function get_form_width(){ return '660/height:465'; }

}
