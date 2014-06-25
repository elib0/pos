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
		if (!$this->order_lib->get_cart()) {
			$model = $this->Inventory_low;
			$low_items = $model->getData(array(),true);
			foreach ($low_items as $key) {
				$this->order_lib->add_item($key['item_id']);
			}
		}
		$data['cart'] = $this->order_lib->get_cart();
		
		$this->load->view('orders/register',$data);
	}

	function item_search()
	{
		$suggestions = $this->Item->get_item_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		$suggestions = array_merge($suggestions, $this->Item_kit->get_item_kit_search_suggestions($this->input->post('q'),$this->input->post('limit')));
		echo implode("\n",$suggestions);
	}

	function set_comment() 
	{
		$this->sale_lib->set_comment($this->input->post('comment'));
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
		$response = array('status'=>true,'messagge'=>$this->lang->line('orders_delete_item'));
		$this->order_lib->delete_item($item_number);
		die(json_encode($response));
	}

	function save($sale_id = false)
	{
		$response = array('status'=>false,'messagge'=>$this->lang->line('orders_no_save'));
		$order_data['date'] = date('m/d/Y h:i:s a');
		$order_data['employee_id'] = $this->Employee->get_logged_in_employee_info()->person_id;
		$order_data['comments'] = $this->input->post('comments');
		$order_data['location'] = $this->session->userdata('dblocation');

		//$response['status'] = $this->Order->save($order_data, $this->input->post('items'));
		if ($response['status']) {
			$response['messagge'] = $this->lang->line('orders_saved');
		}

		//echo "<pre>";
		//print_r($order_items_data);
		//echo "</pre>";

		die(json_encode($response));
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
