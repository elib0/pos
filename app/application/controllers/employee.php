<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->model('ModelEmployee');
	}

	public function complete($value){

		$customers = $this->ModelEmployee->get_seek(" WHERE a.deleted = '0' AND (b.first_name LIKE '%".$value."%' OR b.last_name LIKE '%".$value."%') ");
		$i = '';
		foreach ($customers as $array){

			$this->data[]['name'] = formatString($array['first_name'].' '.$array['last_name']);
			
		}
		
		echo json_encode($this->data);
	}

}

?>