<?php
// require_once ("secure_area.php");
// class Services extends Secure_area
class Services extends CI_Controller
{
	function __construct()
	{
		parent::__construct('items');
	}

	function index()
	{
		$config['base_url'] = site_url('/items/index');
		$config['total_rows'] = $this->Item->count_all();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		
		$data['items_location']= $this->set_location();
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_items_manage_table( $this->Item->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->view('items/manage',$data);
	}

	function refresh()
	{
		$low_inventory=$this->input->post('low_inventory');
		$is_serialized=$this->input->post('is_serialized');
		$no_description=$this->input->post('no_description');
		$location = $this->input->post('dblocation')!=false? $this->input->post('dblocation'): 'default';

		$data['items_location']= $this->set_location();

		$data['search_section_state']=$this->input->post('search_section_state');
		$data['low_inventory']=$this->input->post('low_inventory');
		$data['is_serialized']=$this->input->post('is_serialized');
		$data['no_description']=$this->input->post('no_description');
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();

		//Paginacion para filtro
		$config['base_url'] = site_url('/items/index');
		$config['total_rows'] = $this->Item->get_all_filtered($low_inventory,$is_serialized,$no_description, $location)->num_rows();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);


		$data['manage_table']=get_items_manage_table($this->Item->get_all_filtered($low_inventory,$is_serialized,$no_description, $location),$this);
		$this->load->view('items/manage',$data);
	}

	function find_item_info()
	{
		$item_number=$this->input->post('scan_item_number');
		echo json_encode($this->Item->find_item_info($item_number));
	}

	function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_items_manage_table_data_rows($this->Item->search($search),$this);
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

	function item_search()
	{
		$suggestions = $this->Item->get_item_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}

	function get_row()
	{
		$item_id = $this->input->post('row_id');
		$data_row=get_item_data_row($this->Item->get_info($item_id),$this);
		echo $data_row;
	}

	function view($item_id=-1)
	{
		$data['item_info']=$this->Item->get_info($item_id);
		$data['item_tax_info']=$this->Item_taxes->get_info($item_id);
		$suppliers = array('' => $this->lang->line('items_none'));
		foreach($this->Supplier->get_all()->result_array() as $row)
		{
			$suppliers[$row['person_id']] = $row['company_name'] .' ('.$row['first_name'] .' '. $row['last_name'].')';
		}

		$data['suppliers']=$suppliers;
		$data['selected_supplier'] = $this->Item->get_info($item_id)->supplier_id;
		$data['default_tax_1_rate']=($item_id==-1) ? $this->Appconfig->get('default_tax_1_rate') : '';
		$data['default_tax_2_rate']=($item_id==-1) ? $this->Appconfig->get('default_tax_2_rate') : '';
		$this->load->view("items/form",$data);
	}

	function count_details($item_id=-1)
	{
		$data['item_info']=$this->Item->get_info($item_id);
		$this->load->view("items/count_details",$data);
	} //------------------------------------------- Ramel

	function save($item_id=-1)
	{
		$item_data = array(
		'is_locked'=>$this->input->post('is_locked')?1:0,
		'name'=>$this->input->post('name'),
		'description'=>$this->input->post('description'),
		'category'=>$this->input->post('category'),
		'supplier_id'=>$this->input->post('supplier_id')==''?null:$this->input->post('supplier_id'),
		'item_number'=>$this->input->post('item_number')==''?null:$this->input->post('item_number'),
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
		$cur_item_info = $this->Item->get_info($item_id);


		if($this->Item->save($item_data,$item_id))
		{
			if ($item_id!=-1){
				$id=$item_id;
				$msg_post_subt=$this->lang->line('employees_successful_adding');
				if (!is_dir('./images/items/'.md5($this->session->userdata('dblocation').'-'.$id).'/')){
					mkdir('./images/items/'.md5($this->session->userdata('dblocation').'-'.$id).'/');
					$a=false;
				}else{ $a=true; }
			}else{
				$id=$item_data['item_id'];
				mkdir('./images/items/'.md5($this->session->userdata('dblocation').'-'.$id).'/');
				$a=false; 
			}
			//for ($i=0; $i < 5; $i++) { 
				$dat[]=$this->uploadImagen_photo(md5($this->session->userdata('dblocation').'-'.$id),$a);			
			//}
			//New item
			if($item_id==-1)
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_adding').' '.
				$item_data['name'],'item_id'=>$item_data['item_id'],'pictures'=>$dat));
				// $item_id = $item_data['item_id'];
			}
			else //previous item
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_updating').' '.
				$item_data['name'],'item_id'=>$id,'pictures'=>$dat));
			}

			$inv_data = array
			(
				'trans_date'=>date('Y-m-d H:i:s'),
				'trans_items'=>$id,
				'trans_user'=>$employee_id,
				'trans_comment'=>$this->lang->line('items_manually_editing_of_quantity'),
				'trans_inventory'=>$cur_item_info ? $this->input->post('quantity') - $cur_item_info->quantity : $this->input->post('quantity')
			);
			$this->Inventory->insert($inv_data);
			$items_taxes_data = array();
			$tax_names = $this->input->post('tax_names');
			$tax_percents = $this->input->post('tax_percents');
			for($k=0;$k<count($tax_percents);$k++)
			{
				if (is_numeric($tax_percents[$k]))
				{
					$items_taxes_data[] = array('name'=>$tax_names[$k], 'percent'=>$tax_percents[$k] );
				}
			}
			$this->Item_taxes->save($items_taxes_data, $id);
		}
		else//failure
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('items_error_adding_updating').' '.
			$item_data['name'],'item_id'=>-1));
		}

	}

	
	function uploadImagen_photo($id,$e){ $a=0;
		//carga de imagen
		$config['upload_path'] = './images/items/'.$id;
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
		if (file_exists('./images/items/'.md5($this->session->userdata('dblocation').'-'.$id).'/'.md5($this->session->userdata('dblocation').'-'.$id).'_'.$i.'.jpg')){
			if (unlink('./images/items/'.md5($this->session->userdata('dblocation').'-'.$id).'/'.md5($this->session->userdata('dblocation').'-'.$id).'_'.$i.'.jpg'))
				echo json_encode( array('success'=>true));
			else echo json_encode( array('success'=>false, 'message'=>'Error'));
		}else echo json_encode( array('success'=>false, 'message'=>'no file'));
	}
	/*
	get the width for the add/edit form
	*/
	function get_form_width(){ return '660/height:465'; }

}
