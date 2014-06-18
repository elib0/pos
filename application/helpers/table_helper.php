<?php
/*
Gets the html table to manage people.
*/
function get_people_manage_table($people,$controller)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';

	$headers = array('<input type="checkbox" id="select_all" />',
	$CI->lang->line('common_last_name'),
	$CI->lang->line('common_first_name'),
	$CI->lang->line('common_email'),
	$CI->lang->line('common_phone_number'),
	'&nbsp');

	$table.='<thead><tr>';
	foreach($headers as $header)
	{
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_people_manage_table_data_rows($people,$controller);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the people.
*/
function get_people_manage_table_data_rows($people,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($people->result() as $person)
	{
		$table_data_rows.=get_person_data_row($person,$controller);
	}

	if($people->num_rows()==0)
	{
		$table_data_rows.='<tr><td colspan="6"><div class="warning_message" style="padding:7px;">'.$CI->lang->line('common_no_persons_to_display').'</div></tr></tr>';
	}

	return $table_data_rows;
}

function get_person_data_row($person,$controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));
	$width = $controller->get_form_width();

	$table_data_row='<tr>';
	$table_data_row.="<td width='5%'><input type='checkbox' id='person_$person->person_id' value='".$person->person_id."'/></td>";
	$table_data_row.='<td width="20%">'.character_limiter($person->last_name,13).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter($person->first_name,13).'</td>';
	$table_data_row.='<td width="30%">'.mailto($person->email,character_limiter($person->email,22)).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter($person->phone_number,13).'</td>';
	if($CI->Employee->has_privilege('add', $controller_name)){
		$table_data_row.='<td width="5%">'.anchor($controller_name."/view/$person->person_id/width:$width", $CI->lang->line('common_edit'),array('class'=>'thickbox small_button','title'=>$CI->lang->line($controller_name.'_update'))).'</td>';
	}else{
		$table_data_row.='<td width="5%"></td>';
	}
	$table_data_row.='</tr>';

	return $table_data_row;
}

/*
Gets the html table to manage suppliers.
*/
function get_supplier_manage_table($suppliers,$controller)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';

	$headers = array('<input type="checkbox" id="select_all" />',
	$CI->lang->line('suppliers_company_name'),
	$CI->lang->line('common_last_name'),
	$CI->lang->line('common_first_name'),
	$CI->lang->line('common_email'),
	$CI->lang->line('common_phone_number'),
	'&nbsp');

	$table.='<thead><tr>';
	foreach($headers as $header)
	{
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_supplier_manage_table_data_rows($suppliers,$controller);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the supplier.
*/
function get_supplier_manage_table_data_rows($suppliers,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($suppliers->result() as $supplier)
	{
		$table_data_rows.=get_supplier_data_row($supplier,$controller);
	}

	if($suppliers->num_rows()==0)
	{
		$table_data_rows.="<tr><td colspan='7'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('common_no_persons_to_display')."</div></tr></tr>";
	}

	return $table_data_rows;
}

function get_supplier_data_row($supplier,$controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));
	$width = $controller->get_form_width();

	$table_data_row='<tr>';
	$table_data_row.="<td width='5%'><input type='checkbox' id='person_$supplier->person_id' value='".$supplier->person_id."'/></td>";
	$table_data_row.='<td width="17%">'.character_limiter($supplier->company_name,13).'</td>';
	$table_data_row.='<td width="17%">'.character_limiter($supplier->last_name,13).'</td>';
	$table_data_row.='<td width="17%">'.character_limiter($supplier->first_name,13).'</td>';
	$table_data_row.='<td width="22%">'.mailto($supplier->email,character_limiter($supplier->email,22)).'</td>';
	$table_data_row.='<td width="17%">'.character_limiter($supplier->phone_number,13).'</td>';

	if($CI->Employee->has_privilege('update', $controller_name)){
		$table_data_row.='<td width="5%">'.anchor($controller_name."/view/$supplier->person_id/width:570/height:425", $CI->lang->line('common_edit'),array('class'=>'thickbox small_button','title'=>$CI->lang->line($controller_name.'_update'))).'</td>';
	}else{
		$table_data_row .= '<td width="5%"></td>';
	}
	$table_data_row.='</tr>';

	return $table_data_row;
}

/*
Gets the html table to manage items.
*/
function get_items_manage_table($items,$controller)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';

	$headers = array('<input type="checkbox" id="select_all" />',
	$CI->lang->line('items_item_number'),
	$CI->lang->line('items_name'),
	$CI->lang->line('items_category'),
	$CI->lang->line('items_cost_price'),
	$CI->lang->line('items_unit_price'),
	$CI->lang->line('items_tax_percents'),
	$CI->lang->line('items_quantity'),
	'&nbsp;',
	$CI->lang->line('items_inventory'),
	'&nbsp;'
	);

	$table.='<thead><tr>';
	foreach($headers as $header)
	{
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_items_manage_table_data_rows($items,$controller);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the items.
*/
function get_items_manage_table_data_rows($items,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($items->result() as $item)
	{
		$table_data_rows.=get_item_data_row($item,$controller);
	}

	if($items->num_rows()==0)
	{
		$table_data_rows.="<tr><td colspan='11'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('items_no_items_to_display')."</div></tr></tr>";
	}

	return $table_data_rows;
}

function get_item_data_row($item,$controller)
{
	$CI =& get_instance();
	$item_tax_info=$CI->Item_taxes->get_info($item->item_id);
	$tax_percents = '';
	foreach($item_tax_info as $tax_info)
	{
		$tax_percents.=$tax_info['percent']. '%, ';
	}
	$tax_percents=substr($tax_percents, 0, -2);
	$controller_name=strtolower(get_class($CI));
	$width = $controller->get_form_width();

	$table_data_row='<tr>';
	$table_data_row.="<td width='3%'>".($item->is_locked?'':"<input class='".($item->is_locked?'locked':'')."' type='checkbox' id='item_$item->item_id' value='$item->item_id'/>")."</td>";
	$table_data_row.='<td width="15%">'.$item->item_number.'</td>';
	$table_data_row.='<td width="20%">'.$item->name.'</td>';
	$table_data_row.='<td width="14%">'.$item->category.'</td>';
	$table_data_row.='<td width="14%">'.to_currency($item->cost_price).'</td>';
	$table_data_row.='<td width="14%">'.to_currency($item->unit_price).'</td>';
	$table_data_row.='<td width="14%">'.$tax_percents.'</td>';
	$table_data_row.='<td width="14%">'.($item->is_service?"&#x221E;":number_format($item->quantity)).'</td>';
	if($CI->Employee->has_privilege('update', $controller_name)){
		$table_data_row.='<td width="5%">'.anchor($controller_name."/view/$item->item_id/width:$width", $CI->lang->line('common_edit'),array('class'=>'small_button thickbox','title'=>$CI->lang->line($controller_name.'_update'))).'</td>';
	}else{
		$table_data_row .= '<td width="5%"></td>';
	}
	$table_data_row.='<td width="10%">'.anchor($controller_name."/count_details/$item->item_id/width:$width", $CI->lang->line('common_det'),array('class'=>'small_button thickbox','title'=>$CI->lang->line($controller_name.'_details_count'))).'</td>';//inventory details
	//Ramel Inventory Tracking
	if($item->is_service){
		$table_data_row .= '<td width="10%"></td>';
	}else{
		if ($CI->Employee->isAdmin()){
			// $table_data_row.= '<td width="10%">'.anchor("backup/index/width:350/height:180",
			// "<div class='big_button' style='padding: 8px 25px;margin-right: 10px;'><span>".$CI->lang->line('config_backup')."</span></div>",
			// array('class'=>'thickbox small_button','title'=>$CI->lang->line('config_backup'))).'</td>';

			//$table_data_row.='<td width="10%">'.anchor($controller_name."/inventory/$item->item_id/width:$width", $CI->lang->line('common_inv'),array('class'=>'small_button thickbox','title'=>$CI->lang->line($controller_name.'_count')));
			$table_data_row.='<td width="10%">'.anchor('home/confirm_user/'.$controller_name."-inventory-$item->item_id/".$CI->lang->line($controller_name.'_count')."/660/465/".'width:350/height:180', $CI->lang->line('common_inv'),array('id'=>'confirm-user','class'=>'small_button thickbox','title'=>$CI->lang->line($controller_name.'_count')));
		}
		
	}

	$table_data_row.='</tr>';
	return $table_data_row;
}


/*
Gets the html data rows for the items.
*/
function get_locations_manage_table_data_rows($locations,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($locations->result() as $location)
	{
		$table_data_rows.=get_location_data_row($location,$controller);
	}

	if($locations->num_rows()==0)
	{
		$table_data_rows.="<tr><td colspan='7'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('location_no_have_locations')."</div></tr></tr>";
	}

	return $table_data_rows;
}

function get_location_data_row($location,$controller)
{
	$CI =& get_instance();
	$active = $CI->lang->line('location_no');
	if ($location->active) $active = $CI->lang->line('location_yes');

	$table_data_row ='<tr>';
	
	$table_data_row .= '<td>'.form_checkbox('locations[]', $location->id).'</td>';
	$table_data_row .= '<td>'.$location->name.'</td>';
	$table_data_row .= '<td>'.$location->hostname.'</td>';
	$table_data_row .= '<td>'.$location->database.'</td>';
	$table_data_row .= '<td>'.$location->dbdriver.'</td>';
	$table_data_row .= '<td>'.$active.'</td>';
	$table_data_row .= '<td>'.anchor('locations/view/'.$location->id.'/width:600/height:300', 'Edit', 'class="small_button thickbox", title="'.$CI->lang->line('location_edit').'"').'</td>';

	$table_data_row.='</tr>';
	return $table_data_row;
}
/*
Gets the html table to manage giftcards.
*/
function get_giftcards_manage_table( $giftcards, $controller )
{
	$CI =& get_instance();

	$table='<table class="tablesorter" id="sortable_table">';

	$headers = array('<input type="checkbox" id="select_all" />',
	$CI->lang->line('giftcards_giftcard_number'),
	$CI->lang->line('giftcards_card_value'),
	'&nbsp',
	);

	$table.='<thead><tr>';
	foreach($headers as $header)
	{
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_giftcards_manage_table_data_rows( $giftcards, $controller );
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the giftcard.
*/
function get_giftcards_manage_table_data_rows( $giftcards, $controller )
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($giftcards->result() as $giftcard)
	{
		$table_data_rows.=get_giftcard_data_row( $giftcard, $controller );
	}

	if($giftcards->num_rows()==0)
	{
		$table_data_rows.="<tr><td colspan='11'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('giftcards_no_giftcards_to_display')."</div></tr></tr>";
	}

	return $table_data_rows;
}

function get_giftcard_data_row($giftcard,$controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));
	$width = $controller->get_form_width();
	$height= $controller->get_form_height();

	$table_data_row='<tr>';
	$table_data_row.="<td width='3%'><input type='checkbox' id='giftcard_$giftcard->giftcard_id' value='$giftcard->giftcard_id'/></td>";
	$table_data_row.='<td width="15%">'.$giftcard->giftcard_number.'</td>';
	$table_data_row.='<td width="20%">'.to_currency($giftcard->value).'</td>';
	$table_data_row .= '<td width="5%">';
	if($CI->Employee->has_privilege('update', $controller_name)){
		$table_data_row.=anchor("$controller_name/view/$giftcard->giftcard_id/width:$width/height:$height", $CI->lang->line('common_edit'),array('class'=>'small_button thickbox','title'=>$CI->lang->line($controller_name.'_update')));
	}
	$table_data_row .= '</td>';

	$table_data_row.='</tr>';
	return $table_data_row;
}

/*
Gets the html table to manage item kits.
*/
function get_item_kits_manage_table( $item_kits, $controller )
{
	$CI =& get_instance();

	$table='<table class="tablesorter" id="sortable_table">';

	$headers = array('<input type="checkbox" id="select_all" />',
	$CI->lang->line('item_kits_name'),
	$CI->lang->line('item_kits_description'),
	'&nbsp',
	);

	$table.='<thead><tr>';
	foreach($headers as $header)
	{
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_item_kits_manage_table_data_rows( $item_kits, $controller );
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the item kits.
*/
function get_item_kits_manage_table_data_rows( $item_kits, $controller )
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($item_kits->result() as $item_kit)
	{
		$table_data_rows.=get_item_kit_data_row( $item_kit, $controller );
	}

	if($item_kits->num_rows()==0)
	{
		$table_data_rows.="<tr><td colspan='11'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('item_kits_no_item_kits_to_display')."</div></tr></tr>";
	}

	return $table_data_rows;
}

function get_item_kit_data_row($item_kit,$controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));
	$width = $controller->get_form_width();

	$table_data_row='<tr>';
	$table_data_row.="<td width='3%'><input type='checkbox' id='item_kit_$item_kit->item_kit_id' value='$item_kit->item_kit_id'/></td>";
	$table_data_row.='<td width="15%">'.$item_kit->name.'</td>';
	$table_data_row.='<td width="20%">'.character_limiter($item_kit->description, 25).'</td>';
	if($CI->Employee->has_privilege('update', $controller_name)){
		$table_data_row.='<td width="5%">'.anchor($controller_name."/view/$item_kit->item_kit_id/width:$width", $CI->lang->line('common_edit'),array('class'=>'thickbox small_button','title'=>$CI->lang->line($controller_name.'_update'))).'</td>';
	}else{
		$table_data_row .= '<td width="5%"></td>';
	}
	

	$table_data_row.='</tr>';
	return $table_data_row;
}

function get_services_manage_table($services,$controller){

	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';

	$headers = array(//'<input type="checkbox" id="select_all" />',
	$CI->lang->line('services_item_number'),
	$CI->lang->line('services_name_owner'),
	$CI->lang->line('common_phone_number'),
	$CI->lang->line('services_brand'),
	$CI->lang->line('services_model'),
	$CI->lang->line('services_received'),
	$CI->lang->line('services_delivered'),
	$CI->lang->line('services_status'),
	$CI->lang->line('services_actions')
	);

	$table.='<thead><tr>';
	foreach($headers as $header)
	{
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_services_manage_table_data_rows($services,$controller);
	$table.='</tbody></table>';
	return $table;

}

function get_services_manage_table_data_rows($services,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';

	foreach($services->result() as $service)
	{
		$table_data_rows.=get_service_data_row($service,$controller);
	}

	if($services->num_rows()==0)
	{
		$table_data_rows.="<tr><td colspan='11'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('services_no_services_to_display')."</div></tr></tr>";
	}

	return $table_data_rows;
}

function get_service_data_row($service,$controller)
{
	$CI =& get_instance();

	$controller_name=strtolower(get_class($CI));
	$width = $controller->get_form_width();

	//$table_data_row='<tr'.($service->is_locked?' title="'.$CI->lang->line('services_is_locked_title').'" class="locked"':'').'>';
	$table_data_row='<tr>';
	//$table_data_row.="<td width='3%'><input class='".($service->is_locked?'locked':'')."' type='checkbox' id='service_$service->service_id' value='$service->service_id'/></td>";
	//$table_data_row.="<td width='3%'>".($service->status==100?'':form_checkbox('services[]', $service->service_id))."</td>";
	$table_data_row.='<td width="15%">'.$service->service_id.'</td>';
	$table_data_row.='<td width="20%">'.$service->first_name.' '.$service->last_name.'</small></td>';
	$table_data_row.='<td width="20%">'.$service->phone_number.'</td>';
	$table_data_row.='<td width="14%">'.$service->brand_name.'</td>';
	$table_data_row.='<td width="14%">'.$service->model_name.'</td>';
	$table_data_row.='<td width="14%">'.$service->date_received.'</td>';
	$date_delivered = ($service->date_delivered) ? $service->date_delivered : $CI->lang->line('services_undelivered');
	$table_data_row.='<td width="14%">'.$date_delivered.'</td>';
	$table_data_row.='<td width="14%">'.$CI->lang->line('services_status_'.$service->status).'</td>';

	switch ($service->status){
		case 3:
			$hidden = array('item' => '3','customer_id' => $service->person_id, 'service' => $service->service_id);

			$table_data_row.='<td width="5%">'.form_open('sales/add/', '', $hidden).form_submit(array('value'=>$CI->lang->line('services_pay'),'class'=>'small_button')).form_close().'</td>';
			break;
		case 100:
			$table_data_row.='<td width="5%">'.$CI->lang->line('services_no_actions').'</td>';
		break;
		default:
			$table_data_row.='<td width="5%">'.anchor($controller_name."/view/$service->service_id/width:$width", $CI->lang->line('common_edit'),array('class'=>'small_button thickbox','title'=>$CI->lang->line($controller_name.'_update'))).'</td>';
		break;
	}
	$table_data_row.='</tr>';
	return $table_data_row;
}

?>
