<?php
require_once ('secure_area.php');
class Orders extends Secure_area
{
	function __construct()
	{
		parent::__construct('orders');
		$this->load->library('order_lib');
		$this->load->model('Order');
	}

	function index($low_stock=false)
	{
		$this->load->model('reports/Inventory_low');
		if (!$this->order_lib->get_cart()) {
			if ($low_stock) {
				$model = $this->Inventory_low;
				$low_items = $model->getData(array(),true);
				foreach ($low_items as $key) {
					$this->order_lib->add_item($key['item_id']);
				}
			}
		}
		$data['cart'] = $this->order_lib->get_cart();
		
		 //echo "<pre>";
		 //print_r($data['cart']);
		 //echo "</pre>";
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

	function add()
	{
		$id = $this->input->get('item');
		$response = array('status'=>false, 'message'=>'Error');
		$response['status'] = $this->order_lib->add_item($id);
		if ($response['status']) {
			$response['message'] = 'Added';
		}

		die(json_encode($response));
	}

	function delete_item($item_number)
	{
		$response = array('status'=>true,'messagge'=>$this->lang->line('orders_delete_item'));
		$this->order_lib->delete_item($item_number);
		die(json_encode($response));
	}

	function save($sale_id = false)
	{
		$response = array('status'=>false,'message'=>$this->lang->line('orders_no_save'));
		$order_data['date'] = date('Y-m-d');
		$order_data['employee_id'] = $this->Employee->get_logged_in_employee_info()->person_id;
		$order_data['comments'] = $this->input->post('comments');
		$order_data['location'] = $this->session->userdata('dblocation');

		$response['status'] = $this->Order->save($order_data, $this->input->post('items'));
		if ($response['status']) {
			$response['message'] = $this->lang->line('orders_saved');
			$this->order_lib->clear_all();
		}

		die(json_encode($response));
	}

	function cancel_order()
	{
		$this->order_lib->clear_all();
		redirect('orders');
	}

	function modqty(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('orders/form');
		}
	}
}
