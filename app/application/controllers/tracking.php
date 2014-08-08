<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends CI_Controller {

	private $data;
	private $language;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
	}

	public function index()
	{	
		$this->load->layout('tracking',$this->data);
	}

	public function save(){
		//_imprimir($_POST);
		$this->load->model('ModelPeople');
		$this->load->model('ModelTracking');
		if ($this->input->post('txtCustomer')!=''){
			$email_customer = explode('-', $this->input->post('txtCustomer'));
			$id_customer = $this->ModelPeople->get_field('person_id', " WHERE email LIKE '".trim($email_customer[1])."'");
		}else{
			$id_customer = '';
		}  
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
			//_imprimir($customer);
			$this->ModelPeople->insert_customer($customer);
			$id_customer = $this->ModelPeople->get_last_id();
		}else{
			$id_customer = $this->ModelPeople->get_field('person_id', " WHERE email LIKE '".$this->input->post('txtEmail')."'");
		}
		$model = explode(',', $this->input->post('txtModel'));
		$model_id = explode(':', $model[0]);
		$case = array(
			'person_id' => $id_customer, 
			'model_id' => trim($model_id[1]),
			'serial' => $this->input->post('txtImei'),
			'color' => $this->input->post('txtColor'),
			'comments' => $this->input->post('txtProblem')
		);
		//email
		$this->load->library('email');

		$body = '
			<table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 600px; font-size: 12px; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-weight: normal;border: 1px solid #f4f4f4; ">
			<tr>
			<td style="border: 1px solid #f4f4f4;border-bottom: none;"><img src="'.base_url().'img/top_mail.png" alt=""></td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none; border-top: none;"><h4>Datos de la Persona</h4></td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Nombre:</strong>&nbsp;***</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Email:</strong>&nbsp;***</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Tel&eacute;fono:</strong>&nbsp;***</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><h4>Datos de la Solicitud</h4></td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Solicitud:</strong>&nbsp;***</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Motivo:</strong>&nbsp;***</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Mensaje</strong>&nbsp;</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;">***</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>		
		';

		$this->email->initialize(emailSetting());
		$this->email->from('info@websarrollo.com', 'DASH Cellular Repair');
		$this->email->to('gustavoocanto@gmail.com');
		$this->email->subject('test form');
		$this->email->message($body);

		//out
		$this->ModelTracking->insert($case);
		echo json_encode(array(
			'out' => 'ok',
			'url' => base_url(),
			'title' => 'Message',
			'message' => 'Your request was saved successfully!',
			'work_order' => 'Your work order is: '.$this->ModelTracking->get_last_id()
		));
	}

	public function new_customer_form(){
		$this->load->layout('ajax/customers_form.php',$this->data);
	}
}
?>