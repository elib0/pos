<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Work_orders extends CI_Controller {

	private $data;
	private $language;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		// $this->load->model('Services');
		// $this->load->model('Customers');
		// $this->load->model('ModelContents');
		//$this->language = 'general'; 
	}

	//home page
	public function index()
	{	
		// $this->data = array(
		// 	'blog_summary' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' " , " LIMIT 3"),
		// 	'hosting_summary' => $this->Services->getPlans(" WHERE id_service = '1'"," LIMIT 3",false),
		// 	'domains_summary' => $this->Services->getPlans(" WHERE id_service = '2' AND id IN ('6', '7', '8', '9', '10', '29', '31', '146', '148', '149')",' LIMIT 10',false),
		// 	'index' => '1'
		// );

		// //wpanel session
		// if ($this->session->userdata('wp-user'))
		// 	$this->data['wp_user'] = $this->session->userdata('wp-user');
		
		$this->load->layout('work_orders',$this->data);
	}

	

}
?>