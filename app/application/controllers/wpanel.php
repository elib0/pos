<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wpanel extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelContents');
		$this->load->model('ModelWpanel');
		$this->data = array();
	}

	public function index()
	{	
		if ($this->session->userdata('wp-user'))
			redirect(base_url().'content/manage');
		else	
			$this->access();
	}

	public function login()
	{
		$user = $this->ModelWpanel->get_user($this->input->post('txtLogin'), $this->input->post('txtPass'));
		
		if (!is_object($user) &&  $user==0){
			$data = array(
				'title' => 'Error',
				'message' => 'El usuario suministrado no existe.'
			);
		}else{ 
			$this->session->set_userdata('wp-user', array(
				'id' => $user->id,
				'id_status' => $user->id_status,
				'name' => $user->name,
				'login' => $user->login,
				'pass' => $user->password
			));

			$data = array(
				'title' => 'ok',
				'message' => 'ok',
				'url' => site_url()
			);
		}
		echo json_encode($data);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url());
	}

	public function access()
	{
		$body = $this->ModelContents->getRow('wpanel-login');
		$this->data = array(
			'content' => $body
		);
		
		$this->load->layout($body->body, $this->data, explode('-',$body->jsLibraries));
	}

}

?>