<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->model('ModelCustomers');
	}

	public function complete($value){

		$customers = $this->ModelCustomers->get_seek(" WHERE b.deleted = '0' AND (a.first_name LIKE '%".$value."%' OR a.last_name LIKE '%".$value."%') ");
		$i = '';
		foreach ($customers as $array){

			$this->data[]['name'] = $array['first_name'].' '.$array['last_name'];
			
			//$out .= '"'.$array['first_name'].' '.$array['last_name'].'",';
		}
		//$out = trim($out)!=''?rtrim($out,','):'';
		echo json_encode($this->data);

		
	}

	// public function sent()
	// {
	// 	$this->load->library('email');

	// 	$body = '
	// 		<table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 600px; font-size: 12px; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-weight: normal;border: 1px solid #f4f4f4; ">
	// 		<tr>
	// 		<td style="border: 1px solid #f4f4f4;border-bottom: none;"><img src="'.base_url().'img/top_mail.png" alt=""></td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none; border-top: none;"><h4>Datos de la Persona</h4></td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Nombre:</strong>&nbsp;'.formatString($this->input->post('txtContactName').' '.$this->input->post('txtContactLastName')).'</td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Email:</strong>&nbsp;'.$this->input->post('txtContactEmail').'</td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Tel&eacute;fono:</strong>&nbsp;'.formatString($this->input->post('txtContactTlf')).'</td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><h4>Datos de la Solicitud</h4></td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Solicitud:</strong>&nbsp;'.formatString($this->input->post('txtContactSubject')).'</td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Motivo:</strong>&nbsp;'.htmlentities(formatString($this->ModelContents->get_reason($this->input->post('cboContactReason'),'name'),2)).'</td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Mensaje</strong>&nbsp;</td>
	// 		</tr>
	// 		<tr>
	// 		<td style="padding:10px;border: 1px solid #f4f4f4;">'.formatString($this->input->post('txtContactMsg'),2).'</td>
	// 		</tr>
	// 		<tr>
	// 		<td>&nbsp;</td>
	// 		</tr>
	// 		</table>		
	// 	';

	// 	$this->email->initialize(emailSetting());
	// 	$this->email->from($this->input->post('txtContactEmail'), formatString($this->input->post('txtContactName').' '.$this->input->post('txtContactLastName')));
	// 	$this->email->to('contacto@websarrollo.com, gustavoocanto@gmail.com, info@websarrollo.com');
	// 	$this->email->subject(formatString($this->input->post('txtContactSubject')));
	// 	$this->email->message($body);

	// 	if (!$this->email->send()){
 //    		$data = array(
 //    			'title' => 'Error',
 //    			'message' => 'Hubo un error al momento de enviar el correo de contacto, favor intente nuevamente.',
 //    			'debugger' => $this->email->print_debugger()
 //    		);
	// 	}else{
	// 		$data = array(
 //    			'title' => 'Gracias por escogernos!',
 //    			'message' => 'Hemos recibido tu mensaje de contacto, en un lapso no mayor a 48 horas estaremos respondiendo el mismo.',
 //    			'debugger' => $this->email->print_debugger()
 //    		);
	// 	}

	// 	echo json_encode($data);
	// }

}

?>