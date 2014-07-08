<?php
require_once ('secure_area.php');
class Services extends Secure_area
//class Services extends CI_Controller
{
	function __construct(){
		parent::__construct('services');
	}

	function index(){
		$config['base_url'] = site_url('/services/index');
		$config['total_rows'] = $this->Service->count_all();
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		//$data['services_location']= $this->set_location();
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_services_manage_table( $this->Service->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->view('services/manage',$data);
	}

	function refresh(){

		
		$data['filter_all']=$this->input->post('filters')==0?1:0;
		$data['filter_today']=$this->input->post('filters')==1?1:0;
		$data['filter_yesterday']=$this->input->post('filters')==2?1:0;
		$data['filter_lastweek']=$this->input->post('filters')==3?1:0;
		$data['filter_status']=$this->input->post('filter_status');

		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();

		//Paginacion para filtro
		$config['base_url'] = site_url('/services/index');
		$config['total_rows'] = count($this->Service->get_all_filtered($data));
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		$data['manage_table']=get_services_manage_table($this->Service->get_all_filtered($data),$this);
		$this->load->view('services/manage',$data);
	}

	function find_service_info(){
		$service_number=$this->input->post('scan_service_number');
		echo json_encode($this->Service->find_service_info($service_number));
	}

	function search(){
		$id_service=$this->input->post('search');
		$term=$this->input->post('term');
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_services_manage_table( $this->Service->search($id_service,$term), $this );
		$this->load->view('services/manage',$data);
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest(){
		$suggestions = $this->Service->suggest($this->input->post('q'));
		echo implode("\n",$suggestions);
	}

	/**
	 * [suggest2 Sugerencia para jquery plugin SELECT2]
	 * @return [array] [resultados de sugerencia]
	 */
	function suggest2()
	{
		$services = $this->Service->suggest2($this->input->get('term'));
		$result = array();

		if ($services) {
			foreach ($services->result() as $row) {
				$result[] = array('term'=>$this->input->get('term'),'id'=>$row->service_id, 'text'=>$row->first_name.' '.$row->last_name.', '.$row->brand_name.' - '.$row->model_name);
			}
		}

		die(json_encode($result));
	}

	function get_row(){
		$service_id = $this->input->post('row_id');
		$data_row=get_service_data_row($this->Service->get_info($service_id),$this);
		echo $data_row;
	}

	function view($service_id=-1){
		$data['service_info']=$this->Service->get_info($service_id);
		$data['item_list_json']=json_encode($this->Service->get_items($service_id));
		$data['item_list']=implode(',',$this->Service->get_id_items($service_id));
		$this->load->view('services/form',$data);
	}

	function count_details($service_id=-1){
		$data['service_info']=$this->Service->get_info($service_id);
		$this->load->view('services/count_details',$data);
	}

	public function delete(){
		$this->Service->toggle_delete( $this->input->post('services') );
		redirect('services');
	}

	function save($service_id=-1){
		$person_id=$this->Service->exists_person($this->input->post('name'));
		if (!$person_id && $this->input->post('name')){
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_person'),'service_id'=>-1,'noOw'=>true));
		}else{
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
				$id = ($service_id>0)? $service_id : $service;
				//Save list Items
				$item_list = explode(',', $this->input->post('item_list'));
				$this->Service->delete_items($id, true);
				$this->Service->save_items($id, $item_list);

				if($service_id==-1){//New service
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_adding'),'service_id'=>$service));
				}else{//previous service
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_updating'),'service_id'=>$service_id));
				}
			}else{//failure
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_updating').' '.$service_data['person_id'],'service_id'=>-1));
			}
		}
	}
	function suggest_models($brand=''){
		$suggestions = $this->Service->suggest_model($this->input->post('q'),$brand);
		echo implode("\n",$suggestions);
	}
	function suggest_brand($module=''){
		$suggestions = $this->Service->suggest_brand($this->input->post('q'));
		echo implode("\n",$suggestions);
	}
	function suggest_owner($module=''){
		$suggestions = $this->Service->suggest_owner($this->input->post('q'));
		echo implode("\n",$suggestions);
	}
	function suggest_items(){
		$suggestions = $this->Item->get_item_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		$suggestions = array_merge($suggestions, $this->Item_kit->get_item_kit_search_suggestions($this->input->post('q'),$this->input->post('limit')));
		echo implode("\n",$suggestions);
	}
	function suggest3(){
		$term = $this->input->get('term');
		$items = $this->Item->suggest2($term);
		$item_kits = $this->Item_kit->suggest2($term);
		$result = array();

		if ($item_kits) {
			foreach ($item_kits->result() as $row) {
				$result[] = array('id'=>$row->item_kit_id, 'text'=>'Item Kit: '.$row->name, 'item_kit'=>true);
			}
		}

		if ($items) {
			foreach ($items->result() as $row) {
				$result[] = array('id'=>$row->item_id, 'item_number'=>$row->item_number, 'text'=>$row->name, 'qty'=>$row->quantity, 'reorder_level'=>$row->reorder_level);
			}
		}

		die(json_encode($result));
	}
	/*
	get the width for the add/edit form
	*/
	function get_form_width(){ return '660/height:465'; }

}
