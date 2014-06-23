<?php
require_once ('secure_area.php');
class Orders extends Secure_area
{
	function __construct()
	{
		parent::__construct('orders');
		$this->load->library('order_lib');
	}

	function index()
	{
		$this->load->model('reports/Inventory_low');
		$model = $this->Inventory_low;
		$low_items = $model->getData(array());

		foreach ($low_items as $key => $value) {
			$this->order_lib->add_item();
		}

		$data['cart']=$this->order_lib->get_cart();



		$this->load->view('orders/register',$data);
	}

	/*Datos de la venta actual por ajax*/
	function get_ajax_sale_details(){
		$subtotal = $this->sale_lib->get_subtotal();
		$taxes = $this->sale_lib->get_taxes();
		$total = $this->sale_lib->get_total();
		$amountdue = $this->sale_lib->get_amount_due();

		echo json_encode(array('total'=>$total, 'subtotal'=>$subtotal, 'taxes'=>$taxes, 'due'=>$amountdue));
	}

	function item_search()
	{
		$suggestions = $this->Item->get_item_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		$suggestions = array_merge($suggestions, $this->Item_kit->get_item_kit_search_suggestions($this->input->post('q'),$this->input->post('limit')));
		echo implode("\n",$suggestions);
	}

	function customer_search()
	{
		$suggestions = $this->Customer->get_customer_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}

	function select_location(){
		if($this->sale_lib->get_mode()=='shipping'){
			$customer_id = $this->input->post('location');
		}
		$this->sale_lib->set_customer($customer_id);
	}

	function select_employee()
	{
		$employee_id = $this->input->post('employee');
		$this->sale_lib->set_employee($employee_id);
		$this->_reload();
	}

	function set_comment() 
	{
		$this->sale_lib->set_comment($this->input->post('comment'));
	}
	
	function set_email_receipt()
	{
		$this->sale_lib->set_email_receipt($this->input->post('email_receipt'));
	}


	function add($item_id_or_number_or_item_kit_or_receipt=NULL,$service_id=NULL)
	{
		$data=array();
		$mode = $this->sale_lib->get_mode();
		if(!$item_id_or_number_or_item_kit_or_receipt)
			$item_id_or_number_or_item_kit_or_receipt = $this->input->post('item');

		if(!$service_id) $service_id=$this->input->post('service');
		if(!$service_id) $service_id=NULL;

		if($service_id){
			$this->sale_lib->clear_all();
			$this->sale_lib->set_customer($this->input->post('customer_id'));
		} 

		$quantity = $mode!='return' ? 1:-1;

		if($this->sale_lib->is_valid_receipt($item_id_or_number_or_item_kit_or_receipt) && $mode=='return')
		{
			$this->sale_lib->return_entire_sale($item_id_or_number_or_item_kit_or_receipt);
		}
		elseif($this->sale_lib->is_valid_item_kit($item_id_or_number_or_item_kit_or_receipt))
		{
			$this->sale_lib->add_item_kit($item_id_or_number_or_item_kit_or_receipt);
		}
		elseif(!$this->sale_lib->add_item($item_id_or_number_or_item_kit_or_receipt,$quantity,0,null,null,null,$service_id))
		{
			$data['error']=$this->lang->line('sales_unable_to_add_item');
		}elseif($service_id){
			foreach($this->Service->get_id_items($service_id) as $item){
				$this->sale_lib->add_item($item,1);
			}
		}

		if($this->sale_lib->out_of_stock($item_id_or_number_or_item_kit_or_receipt))
		{
			$data['warning'] = $this->lang->line('sales_quantity_less_than_zero');
		}

		$this->_reload();
	}

	// function get_service_items($id){
	// 	var_dump($this->Service->get_id_items($id));
	// }
	function edit_item($line, $ajax=false)
	{
		$data= array();

		$this->form_validation->set_rules('price', 'lang:items_price', 'required|numeric');
		$this->form_validation->set_rules('quantity', 'lang:items_quantity', 'required|numeric');

		$description = $this->input->post('description');
		$serialnumber = $this->input->post('serialnumber');
		$price = $this->input->post('price');
		$quantity = $this->input->post('quantity');
		$discount = $this->input->post('discount');

		if ($this->form_validation->run() != FALSE)
		{
			$this->sale_lib->edit_item($line,$description,$serialnumber,$quantity,$discount,$price);
		}
		else
		{
			$data['error']=$this->lang->line('sales_error_editing_item');
		}

		if($this->sale_lib->out_of_stock($this->sale_lib->get_item_id($line)))
		{
			$data['warning'] = $this->lang->line('sales_quantity_less_than_zero');
		}

		if (!$ajax) {
			$this->_reload($data);
		}
	}

	function delete_item($item_number)
	{
		$this->sale_lib->delete_item($item_number);
		$this->_reload();
	}

	function remove_customer()
	{
		$this->sale_lib->remove_customer();
		$this->_reload();
	}

	function complete()
	{
		$data['cart']=$this->sale_lib->get_cart();
		$data['subtotal']=$this->sale_lib->get_subtotal();
		$data['taxes']=$this->sale_lib->get_taxing()?$this->sale_lib->get_taxes():false;
		$data['total']=$this->sale_lib->get_total();
		// $data['receipt_title']=$this->lang->line('sales_receipt');
		$data['transaction_time']= date('m/d/Y h:i:s a');
		$customer_id=$this->sale_lib->get_customer();
		$employee_id=$this->sale_lib->get_employee();
		// $employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		$comment = $this->sale_lib->get_comment();
		$emp_info=$this->Employee->get_info($employee_id);
		$data['payments']=$this->sale_lib->get_payments();
		$data['amount_change']=to_currency($this->sale_lib->get_amount_due() * -1);
		$data['employee']=$emp_info->first_name.' '.$emp_info->last_name;

		//Para guardar el tipo de Sale
		$mode = 0;
		switch ( $this->sale_lib->get_mode() ) {
			case 'return':
				$mode = 1;

				//Datos para la vista a generar
				$data['receipt_title'] = $this->lang->line('sales_return');
			break;
			case 'shipping':
				$mode = 2;

				//Datos para la vista a generar
				$data['receipt_title'] = $this->lang->line('sales_shipping');
				$data['employee']=$emp_info->first_name.' '.$emp_info->last_name.' From: '.ucwords($this->session->userdata('dblocation'));

				//Registrar Location como customer 'CALICHE'
				include('application/config/database.php');
				$person_data = array(
					'first_name'=>$customer_id,
					'last_name'=>$db[$customer_id]['database'],
					'email'=>null,
					'phone_number'=>null,
					'address_1'=>$db[$customer_id]['hostname'],
					'address_2'=>null,
					'city'=>null,
					'state'=>null,
					'zip'=>null,
					'country'=>null,
					'comments'=>'location'
				);
				$customer_data=array(
					'account_number'=>null,
					'taxable'=>0
				);
				//Customer by Location
				$location = $customer_id;
				$customer = $this->Customer->get_info_by_name($customer_id);
				if (!$customer) {
					$this->Customer->save($person_data,$customer_data,-1);
					$customer_id =  $customer_data['person_id'];
				}else{
					$customer_id = $customer->person_id;
				}
			break;
			default:
				//Datos para la vista a generar
				$data['receipt_title'] = $this->lang->line('sales_register');
			break;
		}

		$data['receipt_title'] .= ' '.$this->lang->line('sales_receipt');

		if($customer_id>-1 && is_numeric($customer_id))
		{
			$cust_info=$this->Customer->get_info($customer_id);
			if ($this->sale_lib->get_mode() == 'shipping') {
				$data['customer']=ucwords($cust_info->comments).': '.ucwords($cust_info->first_name);
			}else{
				$data['customer']=$cust_info->first_name.' '.$cust_info->last_name;
			}
		}

		//SAVE sale to database
		$data['sale_id']='POS '.$this->Sale->save($data['cart'], $customer_id,$employee_id,$comment,$data['payments'], false, $mode);
		if ($data['sale_id'] == 'POS -1')
		{
			$data['error_message'] = $this->lang->line('sales_transaction_failed');
		}
		else
		{
			if ($this->sale_lib->get_email_receipt() && !empty($cust_info->email))
			{
				$this->load->library('email');
				$config['mailtype'] = 'html';				
				$this->email->initialize($config);
				$this->email->from($this->config->item('email'), $this->config->item('company'));
				$this->email->to($cust_info->email); 

				$this->email->subject($this->lang->line('sales_receipt'));
				$this->email->message($this->load->view('orders/receipt_email',$data, true));	
				$this->email->send();
			}

			if ( $this->sale_lib->get_mode() == 'shipping' ) {
				$this->load->model('Transfers');
				$data['sale_id'] = $this->Transfers->save($data['cart'], $location,$employee_id,$comment,$data['payments']);
			}
		}
		$this->load->view('orders/receipt',$data);
		$this->sale_lib->clear_all();
	}

	function receipt($sale_id)
	{
		$sale_info = $this->Sale->get_info($sale_id)->row_array();
		$this->sale_lib->copy_entire_sale($sale_id);
		$data['cart']=$this->sale_lib->get_cart();
		$data['payments']=$this->sale_lib->get_payments();
		$data['subtotal']=$this->sale_lib->get_subtotal();
		$data['taxes']=$this->sale_lib->get_taxes();
		$data['total']=$this->sale_lib->get_total();
		$data['receipt_title']=$this->lang->line('sales_receipt');
		$data['transaction_time']= date('m/d/Y h:i:s a', strtotime($sale_info['sale_time']));
		$customer_id=$this->sale_lib->get_customer();
		$emp_info=$this->Employee->get_info($sale_info['employee_id']);
		$data['payment_type']=$sale_info['payment_type'];
		$data['amount_change']=to_currency($this->sale_lib->get_amount_due() * -1);
		$data['employee']=$emp_info->first_name.' '.$emp_info->last_name;

		if($customer_id!=-1)
		{
			$cust_info=$this->Customer->get_info($customer_id);
			$data['customer']=$cust_info->first_name.' '.$cust_info->last_name;
		}
		$data['sale_id']='POS '.$sale_id;
		$this->load->view('orders/receipt',$data);
		$this->sale_lib->clear_all();

	}
	
	function edit($sale_id)
	{
		$data = array();

		$data['customers'] = array('' => 'No Customer');
		foreach ($this->Customer->get_all()->result() as $customer)
		{
			$data['customers'][$customer->person_id] = $customer->first_name . ' '. $customer->last_name;
		}

		$data['employees'] = array();
		foreach ($this->Employee->get_all()->result() as $employee)
		{
			$data['employees'][$employee->person_id] = $employee->first_name . ' '. $employee->last_name;
		}

		$data['sale_info'] = $this->Sale->get_info($sale_id)->row_array();

		$this->load->view('orders/edit', $data);
	}

	function delete($sale_id){
		$data = array();
		if ($this->Sale->delete($sale_id)){
			$data['success'] = true;
		}else{
			$data['success'] = false;
		}
		$this->load->view('orders/delete', $data);
	}

	function save($sale_id)
	{
		$sale_data = array(
			'sale_time' => date('Y-m-d', strtotime($this->input->post('date'))),
			'customer_id' => $this->input->post('customer_id') ? $this->input->post('customer_id') : null,
			'employee_id' => $this->input->post('employee_id'),
			'comment' => $this->input->post('comment')
		);

		if ($this->Sale->update($sale_data, $sale_id))
		{
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('sales_successfully_updated')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('sales_unsuccessfully_updated')));
		}
	}

	function _payments_cover_total()
	{
		$total_payments = 0;

		foreach($this->sale_lib->get_payments() as $payment)
		{
			$total_payments += $payment['payment_amount'];
		}

		/* Changed the conditional to account for floating point rounding */
		if ( ( $this->sale_lib->get_mode() == 'sale' ) && ( ( to_currency_no_money( $this->sale_lib->get_total() ) - $total_payments ) > 1e-6 ) )
		{
			return false;
		}

		return true;
	}

	function _reload($data=array())
	{
		redirect('orders');
	}

	function cancel_order()
	{
		$this->sale_lib->clear_all();
		$this->_reload();
	}

}
