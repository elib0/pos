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
		$suggestions = $this->Service->suggest($this->input->post('q'),$this->input->post('limit'));
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

	function save($service_id=-1)
	{
		$service_data = array(
		'is_locked'=>$this->input->post('is_locked')?1:0,
		'name'=>$this->input->post('name'),
		'description'=>$this->input->post('description'),
		'category'=>$this->input->post('category'),
		'supplier_id'=>$this->input->post('supplier_id')==''?null:$this->input->post('supplier_id'),
		'service_number'=>$this->input->post('service_number')==''?null:$this->input->post('service_number'),
		'cost_price'=>$this->input->post('cost_price'),
		'unit_price'=>$this->input->post('unit_price'),
		'is_service'=>$this->input->post('is_service')?1:0,
		//'quantity'=>$this->input->post('is_service')?0:$this->input->post('quantity'),
		'reorder_level'=>$this->input->post('is_service')?0:$this->input->post('reorder_level'),
		'location'=>$this->input->post('location'),
		'allow_alt_description'=>$this->input->post('allow_alt_description'),
		'is_serialized'=>$this->input->post('is_serialized')
		);

		$employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		$cur_service_info = $this->Service->get_info($service_id);


		if($this->Service->save($service_data,$service_id))
		{
			if ($service_id!=-1){
				$id=$service_id;
				$msg_post_subt=$this->lang->line('employees_successful_adding');
				if (!is_dir('./images/services/'.md5($this->session->userdata('dblocation').'-'.$id).'/')){
					mkdir('./images/services/'.md5($this->session->userdata('dblocation').'-'.$id).'/');
					$a=false;
				}else{ $a=true; }
			}else{
				$id=$service_data['service_id'];
				mkdir('./images/services/'.md5($this->session->userdata('dblocation').'-'.$id).'/');
				$a=false; 
			}
			//for ($i=0; $i < 5; $i++) { 
				$dat[]=$this->uploadImagen_photo(md5($this->session->userdata('dblocation').'-'.$id),$a);			
			//}
			//New service
			if($service_id==-1)
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_adding').' '.
				$service_data['name'],'service_id'=>$service_data['service_id'],'pictures'=>$dat));
				// $service_id = $service_data['service_id'];
			}
			else //previous service
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('services_successful_updating').' '.
				$service_data['name'],'service_id'=>$id,'pictures'=>$dat));
			}

			$inv_data = array
			(
				'trans_date'=>date('Y-m-d H:i:s'),
				'trans_services'=>$id,
				'trans_user'=>$employee_id,
				'trans_comment'=>$this->lang->line('services_manually_editing_of_quantity'),
				'trans_inventory'=>$cur_service_info ? $this->input->post('quantity') - $cur_service_info->quantity : $this->input->post('quantity')
			);
			$this->Inventory->insert($inv_data);
			$services_taxes_data = array();
			$tax_names = $this->input->post('tax_names');
			$tax_percents = $this->input->post('tax_percents');
			for($k=0;$k<count($tax_percents);$k++)
			{
				if (is_numeric($tax_percents[$k]))
				{
					$services_taxes_data[] = array('name'=>$tax_names[$k], 'percent'=>$tax_percents[$k] );
				}
			}
			$this->Service_taxes->save($services_taxes_data, $id);
		}
		else//failure
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('services_error_adding_updating').' '.
			$service_data['name'],'service_id'=>-1));
		}

	}

	
	function uploadImagen_photo($id,$e){ $a=0;
		//carga de imagen
		$config['upload_path'] = './images/services/'.$id;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '3600';
		$config['max_height']  = '2800';
		//$config['file_name']  = $id."_".$i.".jpg";
		for ($i=0; $i < 5; $i++){ $name[$i]=$id."_".$i.".jpg";
			if ($this->input->post('photo_hi_'.$i)!==false){
				$config['file_name'][$a++]  = $name[$i];
				if ($e && file_exists($config['upload_path'].'/'.$name[$i]))
					rename($config['upload_path'].'/'.$name[$i],$config['upload_path'].'/temp_'.$name[$i]);
			} 
		}
		$this->load->library('upload');
		try {
			$this->upload->initialize($config);
			$this->upload->do_multi_upload("photo");
			$nameLogo=$this->upload->get_multi_upload_data();
			if(count($nameLogo)>0){
				for ($i=0; $i < 5; $i++) { 
					if ($e && file_exists($config['upload_path'].'/temp_'.$name[$i])){
						if (file_exists($config['upload_path'].'/'.$name[$i])){
							unlink($config['upload_path'].'/temp_'.$name[$i]);
						}else{
							rename($config['upload_path'].'/temp_'.$name[$i],$config['upload_path'].'/'.$name[$i]);
						} 
					}
				}
				$data = array('upload_status' => 1,'upload_message' => $nameLogo);
			}else{
				$data = array('upload_status' => 2,'upload_message' => 'vacio');
				for ($i=0; $i < 5; $i++) {
					if (file_exists($config['upload_path'].'/temp_'.$name[$i])){
						rename($config['upload_path'].'/temp_'.$name[$i],$config['upload_path'].'/'.$name[$i]);
					}
				}				
			}
		} catch (Exception $e) {
			for ($i=0; $i < 5; $i++) {
				if (file_exists($config['upload_path'].'/temp_'.$name[$i])){
					rename($config['upload_path'].'/temp_'.$name[$i],$config['upload_path'].'/'.$name[$i]);
				}
			}
			$data = array('upload_status' => -1,'upload_message' => 'no se cargo');
		}
		//redimension
		if (isset($nameLogo) && is_array($nameLogo)){
			$this->load->library('image_lib');
			$configR['image_library'] = 'GD2';
			$configR['maintain_ratio'] = true;
			$configR['width']	 = 250;
			$configR['height']	= 250;
			for ($i=0; $i < count($nameLogo); $i++) { 	
				$configR['source_image']	= $config['upload_path'].'/'.$nameLogo[$i]['file_name'];
	//			$configR['create_thumb'] = false;
				$this->image_lib->initialize($configR);  
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		}
		return $data;
	}
	function delete_picture($id,$i){
		if (file_exists('./images/services/'.md5($this->session->userdata('dblocation').'-'.$id).'/'.md5($this->session->userdata('dblocation').'-'.$id).'_'.$i.'.jpg')){
			if (unlink('./images/services/'.md5($this->session->userdata('dblocation').'-'.$id).'/'.md5($this->session->userdata('dblocation').'-'.$id).'_'.$i.'.jpg'))
				echo json_encode( array('success'=>true));
			else echo json_encode( array('success'=>false, 'message'=>'Error'));
		}else echo json_encode( array('success'=>false, 'message'=>'no file'));
	}
	/*
	get the width for the add/edit form
	*/
	function get_form_width(){ return '660/height:465'; }

}
