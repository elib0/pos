<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$person = $this->Employee->get_logged_in_employee_info();
		$person_data = array(
			'first_name'=>$person->first_name,
			'last_name'=>$person->last_name,
			'email'=>$person->email,
			'phone_number'=>$person->phone_number,
			'address_1'=>$person->address_1,
			'address_2'=>$person->address_2,
			'city'=>$person->city,
			'state'=>$person->state,
			'zip'=>$person->zip,
			'country'=>$person->country,
			'comments'=>$person->comments
		);

		$employee_data=array(
		'username'=>$person->username,
		'password'=>$person->password,
		'type_employees'=>$person->employee_profile_type
		);

		
		echo "<pre>";
		print_r($person);
		echo "</pre>";		
	}

}

/* End of file  */
/* Location: ./application/controllers/ */