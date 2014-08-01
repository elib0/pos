<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletters extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelNewsletters');
	}

	public function sent()
	{
		if (trim($this->input->post('txtNewslettersName'))!='' && trim($this->input->post('txtNewslettersEmail'))!=''){
			if (!$this->ModelNewsletters->exists($this->input->post('txtNewslettersEmail'))){
				$this->ModelNewsletters->insert(0,$this->input->post('txtNewslettersName'), $this->input->post('txtNewslettersEmail'));
				$data = array(
					'title' => 'Gracias por escogernos!',
					'message' => 'Hemos recibido tu suscripcion con exito.'
				);
			}else{
				$data = array(
					'title' => 'Error',
					'message' => 'El correo suministrado ya existe en nuestra base de datos.'
				);
			}
		}else{
			$data = array(
				'title' => 'Error',
				'message' => 'Los datos suministrados no son v&aacute;lidos.'
			);
		}

		echo json_encode($data);
	}
	
}

?>