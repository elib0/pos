<?php
class Customer extends Person
{
	var $con;

    function __construct()
    {
        parent::__construct();

        //Seleccion de DB
        // $this->session->set_userdata(array('dblocation'=>'other'));
        $db = $this->session->userdata('dblocation');
        if($db)
            $this->con = $this->load->database($db, true);
        else
            $this->con = $this->db;
    }
	/*
	Determines if a given person_id is a customer
	*/
	function exists($person_id)
	{
		$this->con->from('customers');
		$this->con->join('people', 'people.person_id = customers.person_id');
		$this->con->where('customers.person_id',$person_id);
		$query = $this->con->get();

		return ($query->num_rows()==1);
	}

	/*
	Returns all the customers
	*/
	function get_all($limit=10000, $offset=0)
	{
		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where('deleted',0);
		$this->con->order_by("last_name", "asc");
		$this->con->limit($limit);
		$this->con->offset($offset);
		return $this->con->get();
	}

	function count_all()
	{
		$this->con->from('customers');
		$this->con->where('deleted',0);
		return $this->con->count_all_results();
	}

	/*
	Gets information about a particular customer
	*/
	function get_info($customer_id)
	{
		$this->con->from('customers');
		$this->con->join('people', 'people.person_id = customers.person_id');
		$this->con->where('customers.person_id',$customer_id);
		$query = $this->con->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $customer_id is NOT an customer
			$person_obj=parent::get_info(-1);

			//Get all the fields from customer table
			$fields = $this->con->list_fields('customers');

			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			return $person_obj;
		}
	}

	/*
	Gets information about a particular customer by first name
	*/
	function get_info_by_name($customer_name)
	{
		$this->con->from('customers');
		$this->con->join('people', 'people.person_id = customers.person_id');
		$this->con->where('people.first_name',$customer_name);
		$this->con->limit(1);
		$query = $this->con->get();

		if($query->num_rows()==1)
			return $query->row();
		else
			return false;
	}

	/*
	Gets information about multiple customers
	*/
	function get_multiple_info($customer_ids)
	{
		$this->con->from('customers');
		$this->con->join('people', 'people.person_id = customers.person_id');
		$this->con->where_in('customers.person_id',$customer_ids);
		$this->con->order_by("last_name", "asc");
		return $this->con->get();
	}

	/*
	Inserts or updates a customer
	*/
	function save(&$person_data, &$customer_data,$customer_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->con->trans_start();

		if(parent::save($person_data,$customer_id))
		{
			if (!$customer_id or !$this->exists($customer_id))
			{
				$customer_data['person_id'] = $person_data['person_id'];
				$success = $this->con->insert('customers',$customer_data);
			}
			else
			{
				$this->con->where('person_id', $customer_id);
				$success = $this->con->update('customers',$customer_data);
			}

		}

		$this->con->trans_complete();
		return $success;
	}

	/*
	Deletes one customer
	*/
	function delete($customer_id)
	{
		$this->con->where('person_id', $customer_id);
		return $this->con->update('customers', array('deleted' => 1));
	}

	/*
	Deletes a list of customers
	*/
	function delete_list($customer_ids)
	{
		$this->con->where_in('person_id',$customer_ids);
		return $this->con->update('customers', array('deleted' => 1));
 	}

 	/*
	Get search suggestions to find customers
	*/
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where("(first_name LIKE '%".$this->con->escape_like_str($search)."%' or
		last_name LIKE '%".$this->con->escape_like_str($search)."%' or
		CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->con->escape_like_str($search)."%') and deleted=0");
		$this->con->order_by("last_name", "asc");
		$by_name = $this->con->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->first_name.' '.$row->last_name;
		}

		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where('deleted',0);
		$this->con->like("email",$search);
		$this->con->order_by("email", "asc");
		$by_email = $this->con->get();
		foreach($by_email->result() as $row)
		{
			$suggestions[]=$row->email;
		}

		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where('deleted',0);
		$this->con->like("phone_number",$search);
		$this->con->order_by("phone_number", "asc");
		$by_phone = $this->con->get();
		foreach($by_phone->result() as $row)
		{
			$suggestions[]=$row->phone_number;
		}

		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where('deleted',0);
		$this->con->like("account_number",$search);
		$this->con->order_by("account_number", "asc");
		$by_account_number = $this->con->get();
		foreach($by_account_number->result() as $row)
		{
			$suggestions[]=$row->account_number;
		}

		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}

	/*
	Get search suggestions to find customers
	*/
	function get_customer_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where("(first_name LIKE '%".$this->con->escape_like_str($search)."%' or
		last_name LIKE '%".$this->con->escape_like_str($search)."%' or
		CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->con->escape_like_str($search)."%') and deleted=0");
		$this->con->order_by("last_name", "asc");
		$by_name = $this->con->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->person_id.'|'.$row->first_name.' '.$row->last_name;
		}

		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where('deleted',0);
		$this->con->like("account_number",$search);
		$this->con->order_by("account_number", "asc");
		$by_account_number = $this->con->get();
		foreach($by_account_number->result() as $row)
		{
			$suggestions[]=$row->person_id.'|'.$row->account_number;
		}

		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}
	/*
	Preform a search on customers
	*/
	function search($search)
	{
		$this->con->from('customers');
		$this->con->join('people','customers.person_id=people.person_id');
		$this->con->where("(first_name LIKE '%".$this->con->escape_like_str($search)."%' or
		last_name LIKE '%".$this->con->escape_like_str($search)."%' or
		email LIKE '%".$this->con->escape_like_str($search)."%' or
		phone_number LIKE '%".$this->con->escape_like_str($search)."%' or
		account_number LIKE '%".$this->con->escape_like_str($search)."%' or
		CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->con->escape_like_str($search)."%') and deleted=0");
		$this->con->order_by("last_name", "asc");

		return $this->con->get();
	}

}
?>
