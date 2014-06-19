<?php
require_once ("secure_area.php");
require_once ("interfaces/idata_controller.php");
class Items extends Secure_area implements iData_controller
{
	function __construct()
	{
		parent::__construct('items');
	}

	function set_location(){
		$location = $this->session->userdata('dblocation');
		if($this->input->post('items_location')!=false){
			$location = $this->input->post('items_location');
		}elseif ($this->session->userdata('items_location')!=false) {
			$location = $this->session->userdata('items_location');
		}

		//Establezco variable de session 
		$this->session->set_userdata('items_location', $location);

		//Llamado ajax
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			die($location);
		}else{
			return $location;
		}
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
		$suggestions = $this->Item->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}


	function suggest2()
	{
		$term = $this->input->get('term');
		$items = $this->Item->suggest2($term);
		$item_kits = $this->Item_kit->suggest2($term);
		$result = array();

		if ($item_kits) {
			foreach ($item_kits->result() as $row) {
				$result[] = array('id'=>$row->item_kit_id, 'text'=>$row->name);
			}
		}

		if ($items) {
			foreach ($items->result() as $row) {
				$result[] = array('id'=>$row->item_id, 'text'=>$row->name);
			}
		}

		die(json_encode($result));
	}

	function item_search()
	{
		$suggestions = $this->Item->get_item_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest_category()
	{
		$suggestions = $this->Item->get_category_suggestions($this->input->post('q'));
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

	//Ramel Inventory Tracking
	function inventory($item_id=-1)
	{
		$data['item_info']=$this->Item->get_info($item_id);
		$this->load->view("items/inventory",$data);
	}

	function count_details($item_id=-1)
	{
		$data['item_info']=$this->Item->get_info($item_id);
		$this->load->view("items/count_details",$data);
	} //------------------------------------------- Ramel

	function generate_barcodes($item_ids)
	{
		$result = array();

		$item_ids = explode(':', $item_ids);
		foreach ($item_ids as $item_id)
		{
			$item_info = $this->Item->get_info($item_id);

			$result[] = array('name' =>$item_info->name, 'id'=> $item_id);
		}

		$data['items'] = $result;
		$this->load->view("barcode_sheet", $data);
	}

	function bulk_edit()
	{
		$data = array();
		$suppliers = array('' => $this->lang->line('items_none'));
		foreach($this->Supplier->get_all()->result_array() as $row)
		{
			$suppliers[$row['person_id']] = $row['first_name'] .' '. $row['last_name'];
		}
		$data['suppliers'] = $suppliers;
		$data['allow_alt_desciption_choices'] = array(
			''=>$this->lang->line('items_do_nothing'),
			1 =>$this->lang->line('items_change_all_to_allow_alt_desc'),
			0 =>$this->lang->line('items_change_all_to_not_allow_allow_desc'));

		$data['serialization_choices'] = array(
			''=>$this->lang->line('items_do_nothing'),
			1 =>$this->lang->line('items_change_all_to_serialized'),
			0 =>$this->lang->line('items_change_all_to_unserialized'));
		$this->load->view("items/form_bulk", $data);
	}

	function save($item_id=false)
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

	//Ramel Inventory Tracking
	function save_inventory($item_id=-1, $db=null)
	{
		$employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		$cur_item_info = $this->Item->get_info($item_id);
		$inv_data = array
		(
			'trans_date'=>date('Y-m-d H:i:s'),
			'trans_items'=>$item_id,
			'trans_user'=>$employee_id,
			'trans_comment'=>$this->input->post('trans_comment'),
			'trans_inventory'=>$this->input->post('newquantity')
		);
		$this->Inventory->insert($inv_data);

		//Comprueba si hay otra bd presente para tranferencia de items entre bds
		$db = $this->input->post('dbselected');

		//Si hay otra bd presente resto por que esta haciendo tranferencia de item
		if ($db != '...' && $db != false){
			if($this->input->post('newquantity') < $cur_item_info->quantity){ //Para que no pase mas de lo que tiene
				$item_data = array(
					'quantity' => $this->input->post('newquantity'),
					'name' => $cur_item_info->name
				);

				if( $this->Item->save_in_other_inventory($item_data,$item_id,$db) ){ 	//Si incremento en la otra tienda
					$item_data['quantity'] = $cur_item_info->quantity + ($this->input->post('newquantity') * -1);
					$this->Item->save($item_data,$item_id);
					echo json_encode(array('success'=>true,'message'=>'Item traspasest To'.' "'.$db.'" '.
					$cur_item_info->name,'item_id'=>$item_id));
				}else{																//Si no icremente en la otra tienda
					echo json_encode(array('success'=>false,'message'=>'This item may not exist in the destination or location that no longer exists'));
				}
			}else{
				echo json_encode(array('success'=>false,'message'=>'We can not transfer this amount'));
			}
		} else {
			$newquantity = $this->input->post('newquantity');
			//Update stock quantity
			$item_data = array(
				'quantity'=>$cur_item_info->quantity + $newquantity
			);

			if($this->Item->save($item_data,$item_id))
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_updating').' '.
				$cur_item_info->name,'item_id'=>$item_id));
			}else{
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('items_error_adding_updating').' '.
				$cur_item_info->name,'item_id'=>-1));
			}
		}

	}//---------------------------------------------------------------------Ramel

	function bulk_update()
	{
		$items_to_update=$this->input->post('item_ids');
		$item_data = array();

		foreach($_POST as $key=>$value)
		{
			//This field is nullable, so treat it differently
			if ($key == 'supplier_id')
			{
				$item_data["$key"]=$value == '' ? null : $value;
			}
			elseif($value!='' and !(in_array($key, array('item_ids', 'tax_names', 'tax_percents'))))
			{
				$item_data["$key"]=$value;
			}
		}

		//Item data could be empty if tax information is being updated
		if(empty($item_data) || $this->Item->update_multiple($item_data,$items_to_update))
		{
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
			$this->Item_taxes->save_multiple($items_taxes_data, $items_to_update);
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_bulk_edit')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('items_error_updating_multiple')));
		}
	}

	function delete()
	{
		$items_to_delete=$this->input->post('ids');

		if($this->Item->delete_list($items_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('items_successful_deleted').' '.
			count($items_to_delete).' '.$this->lang->line('items_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('items_cannot_be_deleted')));
		}
	}

	function excel()
	{
		$data = file_get_contents("import_items.csv");
		$name = 'import_items.csv';
		force_download($name, $data);
	}

	function excel_import()
	{
		$this->load->view("items/excel_import", null);
	}

	function do_excel_import()
	{
		$msg = 'do_excel_import';
		$failCodes = array();
		if ($_FILES['file_path']['error']!=UPLOAD_ERR_OK)
		{
			$msg = $this->lang->line('items_excel_import_failed');
			echo json_encode( array('success'=>false,'message'=>$msg) );
			return;
		}
		else
		{
			if (($handle = fopen($_FILES['file_path']['tmp_name'], "r")) !== FALSE)
			{
				//Skip first row
				fgetcsv($handle);

				$i=1;
				while (($data = fgetcsv($handle)) !== FALSE)
				{
					$item_data = array(
					'name'			=>	$data[1],
					'description'	=>	$data[13],
					'location'		=>	$data[12],
					'category'		=>	$data[2],
					'cost_price'	=>	$data[4],
					'unit_price'	=>	$data[5],
					'quantity'		=>	$data[10],
					'reorder_level'	=>	$data[11],
					'supplier_id'	=>  $this->Supplier->exists($data[3]) ? $data[3] : null,
					'allow_alt_description'=> $data[14] != '' ? '1' : '0',
					'is_serialized'=>$data[15] != '' ? '1' : '0'
					);
					$item_number = $data[0];

					if ($item_number != "")
					{
						$item_data['item_number'] = $item_number;
					}

					if($this->Item->save($item_data))
					{
						$items_taxes_data = null;
						//tax 1
						if( is_numeric($data[7]) && $data[6]!='' )
						{
							$items_taxes_data[] = array('name'=>$data[6], 'percent'=>$data[7] );
						}

						//tax 2
						if( is_numeric($data[9]) && $data[8]!='' )
						{
							$items_taxes_data[] = array('name'=>$data[8], 'percent'=>$data[9] );
						}

						// save tax values
						if(count($items_taxes_data) > 0)
						{
							$this->Item_taxes->save($items_taxes_data, $item_data['item_id']);
						}

							$employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
							$emp_info=$this->Employee->get_info($employee_id);
							$comment ='Qty CSV Imported';
							$excel_data = array
								(
								'trans_items'=>$item_data['item_id'],
								'trans_user'=>$employee_id,
								'trans_comment'=>$comment,
								'trans_inventory'=>$data[10]
								);
								$this->db->insert('inventory',$excel_data);
						//------------------------------------------------Ramel
					}
					else//insert or update item failure
					{
						$failCodes[] = $i;
					}
				}

				$i++;
			}
			else
			{
				echo json_encode( array('success'=>false,'message'=>'Your upload file has no data or not in supported format.') );
				return;
			}
		}

		$success = true;
		if(count($failCodes) > 1)
		{
			$msg = "Most items imported. But some were not, here is list of their CODE (" .count($failCodes) ."): ".implode(", ", $failCodes);
			$success = false;
		}
		else
		{
			$msg = "Import items successful";
		}

		echo json_encode( array('success'=>$success,'message'=>$msg) );
	}

	function report_item_broken($item_id){
		if($this->Item->report_broken($item_id)){
			echo json_encode( array('success'=>true, 'message'=>'Item reported') );
		}else{
			echo json_encode( array('success'=>false, 'message'=>'Error') );
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
?>
