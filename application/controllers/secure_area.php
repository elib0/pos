<?php
class Secure_area extends CI_Controller 
{
	/*
	Controllers that are considered secure extend Secure_area, optionally a $module_id can
	be set to also check if a user can access a particular module in the system.
	*/
	function __construct($module_id=null)
	{
		parent::__construct();	
		$this->load->model('Employee');
		if(!$this->Employee->is_logged_in())
		{
			redirect('login');
		}

		//Verificar cambio de location
		if (!$this->session->userdata('dblocation')){
			// $location = $this->session->userdata('dblocation');
			$this->session->set_userdata('dblocation', 'default');
		}
		
		if($module_id != 'invetories_compare' && $module_id != 'share_inventories'){
			if(!$this->Employee->has_permission($module_id,$this->Employee->get_logged_in_employee_info()->person_id))
			{
				redirect('no_access/'.$module_id);
			}else{
        		if ($this->Employee->isAdmin()){
        			$this->load->model('reports/Inventory_compare');
		            $model = $this->Inventory_compare;
		            if (!$model->exist_inventory()){ redirect('inventories_compare'); }
		        }
			}
		}
		//Modelos a utilizar
		$this->load->model('reports/Inventory_low');
		$this->load->model('receiving');
		
		//load up global data
		$logged_in_employee_info=$this->Employee->get_logged_in_employee_info();
		$data['allowed_modules']=$this->Module->get_allowed_modules($logged_in_employee_info->person_id);
		$data['user_info']=$logged_in_employee_info;

		//Notificaciones
		$data['notifications']['inventory_low']['url']= 'reports/inventory_low/0/';
		$data['notifications']['inventory_low']['title']= 'Number products with low stock!';
		$data['notifications']['inventory_low']['data']= $this->Inventory_low->getData(array());
		$data['notifications']['shippings']['url'] = 'receivings';
		$data['notifications']['shippings']['title'] = 'Delivery to receive';
		$data['notifications']['shippings']['data'] = $this->Receiving->get_all_shippings();

		//Carga de variables
		$this->load->vars($data);
	}
}
?>
