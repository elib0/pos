<?php $this->load->view("partial/header"); ?>
<div id="title_bar">
	<div id="title" class="float_left"><?=$title?></div>
	<div id="new_button">
		<a href="index.php/locations/view/0/width:550/height:280" class="thickbox none" title="<?php echo $this->lang->line('location_new_location') ?>"><div class="big_button" style="float: left;"><span><?php echo $this->lang->line('location_new_location') ?></span></div></a>
	</div>
</div>
<div id="table_action_header">
	<ul>
		<li class="float_left"><span><a href="index.php/locations/delete" id="delete"><?php echo $this->lang->line('location_disable') ?></a></span></li>
		<li class="float_right">
			<img src="images/spinner_small.gif" alt="spinner" id="spinner">
			<form action="index.php/locations/search" method="post" accept-charset="utf-8" id="search_form">
				<input type="text" name="search" id="search" placeholder="<?php echo $this->lang->line('location_search') ?>" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; border: 1px solid #CCC " autocomplete="off" class="ac_input">
			</form>
		</li>
	</ul>
</div>
<div id="table_holder">
	<table class="tablesorter report" id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<th colspan="1"><input type="checkbox" id="select_all"></th>
				<th colspan="1"><?php echo $this->lang->line('location_group_connection') ?></th>
				<th colspan="1"><?php echo $this->lang->line('location_host') ?></th>
				<th colspan="1"><?php echo $this->lang->line('location_database') ?></th>
				<th colspan="1"><?php echo $this->lang->line('location_driver') ?></th>
				<th colspan="1"><?php echo $this->lang->line('location_active') ?></th>
				<th colspan="1"></th>
			</tr>
		</thead>
		<tbody>
		<form action="index.php/locations/delete" method="POST" id="form_delete_location">
		<?php if (count($locations) > 0): ?>
			<?php foreach ($locations as $value): ?>
			<tr>
				<td><?php echo form_checkbox('location[]', $value['id']); ?></td>
				<td><?php echo $value['name'] ?></td>
				<td><?php echo $value['hostname'] ?></td>
				<td><?php echo $value['database'] ?></td>
				<td><?php echo $value['dbdriver'] ?></td>
				<td><?php echo ($value['active']) ? $this->lang->line('location_yes') : $this->lang->line('location_no') ; ?></td>
				<td>
					<div class='warning_message' style='padding:7px;'>
					<?php echo anchor('locations/view/'.$value['id'].'/width:600/height:280', 'Edit', 'class="small_button thickbox", title="'.$this->lang->line('location_edit').'"'); ?>
					</div>
				</td>
			</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="7"><?php echo $this->lang->line('location_no_have_locations') ?></td>
			</tr>
		<?php endif ?>
		</form>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		init_table_sorting();
		enable_select_all();
		enable_search('<?=site_url("locations/suggest")?>','<?=$this->lang->line("location_search")?>');

		$('#delete').click(function(event) {
			$('#form_delete_location').submit();
			return false;
		});
	});

	function init_table_sorting()
	{
		//Only init if there is more than one row
		if($('.tablesorter tbody tr').length >1)
		{
			$("#sortable_table").tablesorter({
				sortList:[[1,0]],
				headers:{
					0:{sorter:false},
					6:{sorter:false}
				}

			});
		}
	}
</script>
<?php $this->load->view("partial/footer"); ?>
