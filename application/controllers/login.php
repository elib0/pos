<?php
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
		// 
		if ($this->input->post('locationbd')) {
			$this->session->set_userdata('dblocation', $this->input->post('locationbd'));
		}else{
			$this->session->set_userdata('dblocation', 'default');
		}
	}

	function index($userId='')
	{	
		if($this->Employee->is_logged_in())
		{
			redirect('inventories_compare');
		}
		else
		{
			$this->form_validation->set_rules('username', 'lang:login_undername', 'callback_login_check');
    	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if($this->form_validation->run() == FALSE)
			{
				//Para cambio rapido de usuario(LOGOUT alternativo)
				$data['fastUser'] = '';
				if($userId != ''){
					$person = $this->Employee->get_info( $userId );
					$data['fastUser'] = $person->username;
				}

				$this->load->view('login', $data);
			}
			else
			{
				//MArco su hora de entrada automaticamente
				$this->Employee->open_day($this->Employee->get_logged_in_employee_info()->person_id);
				//Redirecciono al inventario y no al home para comparar inventario actual ocn entrega
				redirect('inventories_compare');
			}
		}
	}

	function login_check($username)
	{
		$password = $this->input->post("password");
		if(!$this->Employee->login($username,$password))
		{
			$this->form_validation->set_message('login_check', $this->lang->line('login_invalid_username_and_password'));
			return false;
		}

		return true;
	}
}
?>
