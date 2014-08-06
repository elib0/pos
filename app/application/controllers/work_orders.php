<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Work_orders extends CI_Controller {

	private $data;
	private $language;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();

	}

	//home page
	public function index()
	{	
		$this->load->layout('work_orders',$this->data);
	}

	public function save(){
		_imprimir($_POST);
		$this->load->model('ModelPeople');
		$this->load->model('ModelCaseHistory');
		$id_customer = '';
		if (!$this->ModelPeople->exists($this->input->post('txtEmail'))){
			$address = explode(',', $this->input->post('txtCity'));
			$country = explode(':', $address[0]);
			$state = explode(':', $address[1]);
			$city = explode(':', $address[2]);
			$zip  = explode(':', $address[3]);
			$customer = array(
				'first_name' => $this->input->post('txtFirstName'),
				'last_name' => $this->input->post('txtLastName'),
				'phone_number' => $this->input->post('txtPhoneNumber'),
				'email' => $this->input->post('txtEmail'),
				'address_1' => '',
				'address_2' => '',
				'city' => trim($city[1]),
				'state' => trim($state[1]),
				'zip' => trim($zip[1]),
				'country' => trim($country[1]),
				'comments' => 'New customer from case history module, date: '.date('Y-m-d')
			);
			$this->ModelPeople->insert_customer($customer);
			$id_customer = $this->ModelPeople->get_last_id();
		}
		$case = array(
			'person_id' => $id_customer, 
			'model_id' => '',
			'imei_serial' => $this->input->post('txtImei'),
			'color' => $this->input->post('txtColor'),
			'problem' => $this->input->post('txtProblem')
		);
		$this->ModelCaseHistory->insert($case);
	}


	public function new_customer_form(){
		$this->load->layout('ajax/customers_form.php',$this->data);
	}


}
?>