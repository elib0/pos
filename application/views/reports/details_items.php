<div style="text-align:center;">
	<div id="receipt_header">
		<div id="page_title" style="margin-bottom:6px;text-align:center;"><?php echo $this->lang->line('items_details_count'); ?></div>
		<div class="page_subtitle" style="margin-bottom:6px;"><?="Location: $location"?></div>
	</div>
</div>
<div>
	<div style="text-align:center;">
		<div class="page_subtitle" style="margin-bottom:6px;"><?php echo $this->lang->line("items_basic_information"); ?></div>
	</div>
	<div id="table_holder">
		<table class="tablesorter report">
			<thead>
				<tr>
					<th style="padding: 5px;border-top-left-radius:5px;-webkit-border-top-left-radius:5px;">
					<?php echo $this->lang->line('items_item_number'); ?></th>
					<th style="padding: 5px">
					<?php echo $this->lang->line('items_name'); ?></th>
					<th style="padding: 5px">
					<?php echo $this->lang->line('items_category'); ?></th>
					<th style="padding: 5px">
					<?php echo $this->lang->line('items_current_quantity'); ?></th>
					<th style="padding: 5px;border-top-right-radius:5px;-webkit-border-top-right-radius:5px;">
					<?php echo $this->lang->line('items_pictures_main'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $item_info->item_number;?></td>
					<td><?php echo $item_info->name;?></td>
					<td><?php echo $item_info->category;?></td>
					<td><?php echo ($item_info->is_service?'unlimited':number_format($item_info->quantity)); ?></td>
					<td width="200">
						<?php  $a=0;
							for ($i=0; $i < 5; $i++) { 
								if (file_exists('./images/items/'.md5($item_info->item_id).'/'.md5($item_info->item_id).'_'.$i.'.jpg')){
									if ($a===0)
									echo '<div class="photo_add" style="border:1px transparent solid;">
												<div style="background-image:url(\'./images/items/'.md5($item_info->item_id).'/'.md5($item_info->item_id).'_'.$i.'.jpg\')">
												</div>
										  </div>';
								    $a++;
								}
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>	
</div>
<?php if ($a>0){ ?>
<div>
	<div style="text-align:center;">
		<div class="page_subtitle" style="margin-bottom:6px;"><?php echo $this->lang->line("items_pictures").':'; ?></div>
	</div>
	<div style="background-color: #FFF;padding: 10px; border-top-left-radius: 5px;border-top-right-radius: 5px;"><center>
		<?php 	for ($i=0; $i < 5; $i++) { 
					if (file_exists('./images/items/'.md5($item_info->item_id).'/'.md5($item_info->item_id).'_'.$i.'.jpg')){
						echo '<div class="photo_add" style="width:150px;height:150px;border:1px transparent solid;">
									<div style="background-image:url(\'./images/items/'.md5($item_info->item_id).'/'.md5($item_info->item_id).'_'.$i.'.jpg\');">
									</div>
							  </div>';
					}
				} ?>
	</center></div>
</div>
<?php } ?>
<div id="details_items_po">
	<div style="text-align:center;">
		<div class="page_subtitle" style="margin-bottom:6px;"><?php echo $this->lang->line('items_inventory_tracking'); ?></div>
	</div>
	<div id="table_holder">
		<table class="tablesorter report" width="100%" >
			<thead>
				<tr align="center" style="font-weight:bold">
					<th width="15%" style="padding: 5px;border-top-left-radius:5px;-webkit-border-top-left-radius:5px;">Date</th>
					<th width="25%" style="padding: 5px">Employee</th>
					<th width="15%" style="padding: 5px">In/Out Qty</th>
					<th width="45%"  style="padding: 5px;border-top-right-radius:5px;-webkit-border-top-right-radius:5px;">Remarks</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					
					$vector=$this->Inventory->get_inventory_data_for_item($item_info->item_id)->result_array();
					$limit=count($vector);$i=0;
					foreach($vector as $row) { 
					$class=($i++==($limit-1)?' noBorderBottom':'');
				?>
				<tr align="center">
					<td class="noBorderLeft<?php echo $class;?>"><?php echo $row['trans_date'];?></td>
					<td class="<?php echo $class;?>"><?php
						$person_id = $row['trans_user'];
						$employee = $this->Employee->get_info($person_id);
						echo $employee->first_name." ".$employee->last_name;
						?>
					</td>
					<td class="<?php echo $class;?>"><?php echo $row['trans_inventory']; ?></td>
					<td class="noBorderRigth<?php echo $class;?>"><?php echo $row['trans_comment'];?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>