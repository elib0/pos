<?php
class Order_lib
{
	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}

	function get_cart()
	{
		if(!$this->CI->session->userdata('cart_order'))
			$this->set_cart(array());

		return $this->CI->session->userdata('cart_order');
	}

	function set_cart($cart_data)
	{
		$this->CI->session->set_userdata('cart_order',$cart_data);
	}

	function get_comment()
	{
		return $this->CI->session->userdata('comment_order');
	}

	function set_comment($comment)
	{
		$this->CI->session->set_userdata('comment_order', $comment);
	}

	function clear_comment()
	{
		$this->CI->session->unset_userdata('comment_order');
	}

	function add_item($item_id,$quantity=1,$serialnumber=null,$service_id=null)
	{
		//make sure item exists
		if(!$this->CI->Item->exists($item_id))
		{
			//try to get item id given an item_number
			// $item_id = $this->CI->Item->get_item_id($item_id);
			// if(!$item_id) return false;
			return false;
		}
		//Alain Serialization and Description
		//Get all items in the cart so far...
		$items = $this->get_cart();

		//We need to loop through all items in the cart.
		//If the item is already there, get it's key($updatekey).
		//We also need to get the next key that we are going to use in case we need to add the
		//item to the cart. Since items can be deleted, we can't use a count. we use the highest key + 1.

		$maxkey=0;					//Highest key so far
		$itemalreadyinsale=FALSE;	//We did not find the item yet.
		$insertkey=0;				//Key to use for new entry.
		$updatekey=0;				//Key to use to update(quantity)
		if (count($items)>0)
		foreach ($items as $item)
		{
			//We primed the loop so maxkey is 0 the first time.
			//Also, we have stored the key in the element itself so we can compare.

			if($maxkey <= $item['line']){ $maxkey = $item['line']; }
			if($item['item_id']==$item_id){
				if($item_id>0 && $service_id){
					return true;
				}
			}
		}

		$insertkey=$maxkey+1;

		$item_info=$this->CI->Item->get_info($item_id);
		if($item_id==-1&&$serialnumber){
			$item_number=$serialnumber;
			$serialnumber=null;
			$quantity=1;
		}elseif($item_id>0){
			if($item_info->is_service){
				$item_number=$service_id;
				$serialnumber=null;
				$quantity=1;
				// foreach($this->CI->Service->get_id_items($service_id) as $item){
				// 	$this->add_item($item,1);
				// }
			}else{
				$item_number=$item_info->item_number;
			}
		}
		//array/cart records are identified by $insertkey and item_id is just another field.
		$array=array(
			'item_id'				=>$item_id,
			'line'					=>$insertkey,
			'name'					=>$item_info->name,
			'quantity'				=>$quantity,
			'reorder'				=>$item_info->reorder_level
		);
		$item = array(($insertkey)=>$array);

		//Item already exists and is not serialized, add to quantity
		if($itemalreadyinsale && ($item_info->is_serialized ==0) )
		{
			$items[$updatekey]['quantity']+=$quantity;
		}
		else
		{
			//add to existing array
			$items+=$item;
		}

		$this->set_cart($items);
		return true;

	}

	function out_of_stock($item_id)
	{
		//make sure item exists
		if(!$this->CI->Item->exists($item_id))
		{
			//try to get item id given an item_number
			$item_id = $this->CI->Item->get_item_id($item_id);

			if(!$item_id)
				return false;
		}

		$item = $this->CI->Item->get_info($item_id);
		$quanity_added = $this->get_quantity_already_added($item_id);

		if ($item->quantity - $quanity_added < 0)
		{
			return true;
		}

		return false;
	}

	function get_quantity_already_added($item_id)
	{
		$items = $this->get_cart();
		$quantity_already_added = 0;
		foreach ($items as $item)
		{
			if($item['item_id']==$item_id)
			{
				$quantity_already_added+=$item['quantity'];
			}
		}

		return $quantity_already_added;
	}

	function get_item_id($line_to_get)
	{
		$items = $this->get_cart();

		foreach ($items as $line=>$item)
		{
			if($line==$line_to_get)
			{
				return $item['item_id'];
			}
		}

		return -1;
	}

	function is_valid_receipt($receipt_sale_id)
	{
		//POS #
		$pieces = explode(' ',$receipt_sale_id);

		if(count($pieces)==2)
		{
			return $this->CI->Sale->exists($pieces[1]);
		}

		return false;
	}

	function is_valid_item_kit($item_kit_id)
	{
		//KIT #
		$pieces = explode(' ',$item_kit_id);

		if(count($pieces)==2)
		{
			return $this->CI->Item_kit->exists($pieces[1]);
		}

		return false;
	}

	// function return_entire_sale($receipt_sale_id)
	// {
	// 	//POS #
	// 	$pieces = explode(' ',$receipt_sale_id);
	// 	$sale_id = $pieces[1];

	// 	$this->empty_cart();
	// 	$this->remove_customer();

	// 	foreach($this->CI->Sale->get_sale_items($sale_id)->result() as $row)
	// 	{
	// 		$this->add_item($row->item_id,-$row->quantity_purchased,$row->discount_percent,$row->item_unit_price,$row->description,$row->serialnumber);
	// 	}
	// 	$this->set_customer($this->CI->Sale->get_customer($sale_id)->person_id);
	// }

	// function add_item_kit($external_item_kit_id)
	// {
	// 	//KIT #
	// 	$pieces = explode(' ',$external_item_kit_id);
	// 	$item_kit_id = $pieces[1];

	// 	foreach ($this->CI->Item_kit_items->get_info($item_kit_id) as $item_kit_item)
	// 	{
	// 		$this->add_item($item_kit_item['item_id'], $item_kit_item['quantity']);
	// 	}
	// }

	// function copy_entire_sale($sale_id)
	// {
	// 	$this->empty_cart();
	// 	$this->remove_customer();

	// 	foreach($this->CI->Sale->get_sale_items($sale_id)->result() as $row)
	// 	{
	// 		$this->add_item($row->item_id,$row->quantity_purchased,$row->discount_percent,$row->item_unit_price,$row->description,$row->serialnumber);
	// 	}
	// 	foreach($this->CI->Sale->get_sale_payments($sale_id)->result() as $row)
	// 	{
	// 		$this->add_payment($row->payment_type,$row->payment_amount);
	// 	}
	// 	$this->set_customer($this->CI->Sale->get_customer($sale_id)->person_id);

	// }

	function delete_item($line)
	{
		$items=$this->get_cart();
		unset($items[$line]);
		$this->set_cart($items);
	}

	function empty_cart()
	{
		$this->CI->session->unset_userdata('cart_order');
	}

	function clear_all()
	{
		$this->empty_cart();
		$this->clear_comment();
	}
}
?>