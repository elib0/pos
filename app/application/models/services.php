<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Model {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		
	}

	public function getPlans($where="",$limit=" LIMIT 3",$full_detail=true)
	{
		$plans = $this->db->query("
			SELECT 
				a.id AS id,
				a.id_status AS id_status,
				(SELECT b.name FROM services b WHERE b.id = a.id_service) AS service,
				a.name AS name,
				a.price AS price 
			FROM services_plans a
			$where
			ORDER BY name
			$limit
		");
		$i = 0;
		foreach ($plans->result_array() as $array){ //plans
			$result[$i]['id'] = $array['id'];
			$result[$i]['service'] = formatString($array['service']);
			$result[$i]['name'] = formatString($array['name']);
			$result[$i]['price'] = numberFormat($array['price']);
			$details = $this->db->query(" 
				SELECT 
					description 
				FROM services_plans_detail 
				WHERE id_plan = '".$array['id']."'
				ORDER BY id
				".($full_detail?'':" LIMIT 3")."
			");
			$j=0;
			foreach ($details->result_array() as $detail){ //details
				$result[$i]['details'][$j++] = formatString($detail['description']);
			}
			$i++;
		}
		return $result;
	}

	public function getDomainsPlans($where="",$limit=" LIMIT 3",$full_detail=true)
	{
		$db2=	$this->load->database('whmcs', true);
		$plans = $db2->query("
							SELECT 

							d.`id` id,

							d.`extension` name, 

							p.`msetupfee` price,

							'00' service 


							FROM `tbldomainpricing` d join tblpricing p on d.`id` = p. `relid` 
							
							$where

							Group By d.`id`
						
							Order By d.`order`

							$limit
						");
		$this->db->close();

		$i = 0;
		foreach ($plans->result_array() as $array){ //plans
			$result[$i]['id'] = $array['id'];
			$result[$i]['service'] = formatString($array['service']);
			$result[$i]['name'] = formatString($array['name']);
			$result[$i]['price'] = numberFormat($array['price']);
			// $details = $this->db->query(" 
			// 	SELECT 
			// 		description 
			// 	FROM services_plans_detail 
			// 	WHERE id_plan = '".$array['id']."'
			// 	ORDER BY id
			// 	".($full_detail?'':" LIMIT 3")."
			// ");
			// $j=0;
			// foreach ($details->result_array() as $detail){ //details
			// 	$result[$i]['details'][$j++] = formatString($detail['description']);
			// }
			$i++;
		}
		return $result;
	}

	public function get_domain_price($type)
	{
		$db2=	$this->load->database('whmcs', true);

		$query = $db2->query("
							SELECT 

								p.`msetupfee` price

							FROM `tbldomainpricing` d join tblpricing p on d.`id` = p. `relid` 
							
							WHERE d.`extension` LIKE '$type' AND p.`msetupfee` <> 0 

						     ");

		$array = $query->row();

		$this->db->close();

		return $array->price;
	} 	
}

?>