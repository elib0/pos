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
}
?>