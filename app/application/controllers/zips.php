<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zips extends CI_Controller {
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->model('ModelZips');
	}

	public function complete($value){
		$customers = $this->ModelZips->get_seek(" WHERE a.state LIKE '%".$value."%' OR a.city LIKE '%".$value."%' OR a.zip LIKE '%".$value."%' ", "");
		$i = '';
		foreach ($customers as $array){
			$this->data[]['name'] = 'Country: '.formatString($array['country']).', State: '.formatString($array['state']).', City: '.formatString($array['city']).', Zip Code: '.formatString($array['zip']);	
		}
		echo json_encode($this->data);
	}

	public function get_cities($state){
		$this->data = array(
			'cities' => $this->ModelZips->getRows(" WHERE state LIKE '".$state."'", '', ' ORDER BY city', ' GROUP BY city')
		);
		$this->load->layout('tracking/ajax/cboCities.php', $this->data);
	}
}

?>