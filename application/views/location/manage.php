<?php $this->load->view("partial/header"); ?>
<div id="title_bar">
	<div id="title" class="float_left"><?=$title?></div>
	<div id="new_button">
		<a href="index.php/locations/view/0/width:660/height:365" class="thickbox none" title="New Location"><div class="big_button" style="float: left;"><span>New Location</span></div></a>
	</div>
</div>
<div id="table_action_header">
	<ul>
		<li class="float_left"><span><a href="index.php/locations/delete" id="delete">Disable</a></span></li>
		<li class="float_right">
			<img src="images/spinner_small.gif" alt="spinner" id="spinner">
			<form action="index.php/locations/search" method="post" accept-charset="utf-8" id="search_form">
				<input type="text" name="search" id="search" placeholder="Search ..." style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; border: 1px solid #CCC " autocomplete="off" class="ac_input">
			</form>
		</li>
	</ul>
</div>
<div id="table_holder">
	<table class="tablesorter report" id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<th colspan="1"><input type="checkbox" id="select_all"></th>
				<th colspan="1">Group Connection</th>
				<th colspan="1">Host</th>
				<th colspan="1">DataBase Name</th>
				<th colspan="1">DataBase Driver</th>
				<th colspan="1">Active</th>
				<th colspan="1">Actions</th>
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
				<td><?php echo ($value['active']) ? 'yes' : 'no' ; ?></td>
				<td>
					<?php echo anchor('locations/view/'.$value['name'].'/width:660/height:365', 'Edit', 'class="small_button thickbox", title="Edit Location"'); ?>
				</td>
			</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="7">No tieenes locaciones registradas</td>
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

		$('#delete').click(function(event) {
			console.log('pa ya voy');
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
					4:{sorter:false}
				}

			});
		}
	}
</script>
<?php $this->load->view("partial/footer"); ?>
