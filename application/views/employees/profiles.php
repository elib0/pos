<?php $this->load->view("partial/header"); ?>
<div id="title_bar">
	<div id="title" class="float_left"><?php echo $this->lang->line('common_list_of').' '.$this->lang->line('employees_profile_per'); ?></div>
	<div id="new_button">
		<?php
			echo anchor("$controller_name/form_profile_employee/-1/width:660",
			"<div class='big_button' style='float: left;'><span>".$this->lang->line('employees_profile_per_new')."</span></div>",
			array('class'=>'thickbox none','title'=>$this->lang->line($controller_name.'_new')));
		?>
	</div>
</div>
<div id="table_holder" class="box-form-view">
	<table class="tablesorter" id="sortable_table">
		<thead>	<tr>
			<th style="padding: 5px;"><?php echo $this->lang->line('employees_profile_per_name'); ?></th><th style="padding: 5px;"><?php echo $this->lang->line('employees_profile_m'); ?></th><th style="padding: 5px;"></th>
		</tr></thead>
		<tbody>
		<?php 	
		if (is_array($profiles)){
			foreach ($profiles as $row) { ?>
			<tr>
				<td width="30%" ><?=$row['name']?></td>
				<td width="65%" ><?php echo $row['module']; ?></td>
				<td width="5%"><?=anchor($controller_name."/form_profile_employee/".$row['name']."/width:660", $this->lang->line('common_edit'),array('class'=>'thickbox','title'=>'Edit Profile'))?></td>
			</tr>
		<?php } }else{ echo '<tr><td colspan="3">'.$profiles.'</td></tr>'; } ?>
		</tbody>
	</table>
</div>
<div id="feedback_bar"></div>
<script type="text/javascript">
$(document).ready(function() 
{ 
    // init_table_sorting();
    // enable_search('<?php echo site_url("$controller_name/suggest")?>','<?php echo $this->lang->line("common_confirm_search")?>');
    
 //    function init_table_sorting()
	// {
	// 	//Only init if there is more than one row
	// 	if($('.tablesorter tbody tr').length >1)
	// 	{
	// 		$("#sortable_table").tablesorter(
	// 		{ 
	// 			sortList: [[1,0]], 
	// 			headers: 
	// 			{ 
	// 				0: { sorter: false}, 
	// 				5: { sorter: false} 
	// 			} 

	// 		}); 
	// 	}
	// }

	
}); 
</script>
<?php $this->load->view("partial/footer"); ?>
