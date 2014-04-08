<?php $this->load->view("partial/header"); ?>

<style>
input#search{
	width: 380px;
}
.employees-assistance{
	margin: 2em 0 0 0;
}
.td-info{
	text-align: center;
	font-size: 24px;
	font-weight: bold;
}
table.tablesorter tbody td{
	padding: 15px;
}
</style>

<div class="employees-assistance">
	<div id="title_bar">
		<div id="title" class="float_left">Assistance Marker</div>
	</div>
	<h3>Login:</h3>
	<?php echo form_open($controller_name.'/open_day', array('id'=>'login', 'method'=>'POST')); ?>
	<?php echo form_label('Nick Name:', 'name'); ?>
	<input type="text" name="name" class="text_box" required>
	<?php echo form_label('Password:', 'password'); ?>
	<input type="password" name="password" class="text_box" required>
	<input type="submit" value="Login" class="small_button" id="submit">
	<?php echo form_close(); ?>
	<h2>Employees Working Now:</h2>
	<table class="tablesorter report share-inventorie-report" id="sortable_table">
		<thead>
			<tr>
				<th>User</th>
				<th>Option</th>	
			</tr>
		</thead>
		<tbody>
			<?php if ($employees_working): ?>
			<?php foreach ($employees_working->result() as $employee): ?>
			<tr class="user-row">
				<td><?php echo ucwords($employee->first_name.' '.$employee->last_name); ?></td>
				<td>
					<form id="form_close_day<?php echo $employee->employee_id ?>" action="index.php/<?php echo $controller_name; ?>/close_day" method="POST">
						<button class="logout-button" user="<?php echo $employee->employee_id ?>"><?php echo $this->lang->line("common_logout"); ?></button>
						<input type="password" name="logoutpass" id="logoutpass">
						<input type="hidden" name="person_id" value="<?php echo $employee->employee_id; ?>">
						<label for="logoutpass">Password</label>
					</form>
				</td>
			</tr>
			<?php endforeach ?>
			<?php else: ?>
			<tr>
				<td colspan="2" class="td-info"><h2>No Employees Working</h2></td>
			</tr>	
			<?php endif; ?>
		</tbody>
	</table>
</div>
<script>
	$(function() {
		$('#submit').click(function(event) {
			if (confirm('You will start to work?')) {
				$('#login').ajaxSubmit({
					dataType:'json',
					success:function(data)
					{
						// console.log(data);
						if (data.status == 1) {
							var form = '<td><form id="form_close_day'+data.user+'" action="index.php/<?php echo $controller_name; ?>/close_day" method="POST"><button class="logout-button" user="'+data.user+'"><?php echo $this->lang->line("common_logout"); ?></button><input type="password" name="logoutpass" id="logoutpass"><input type="hidden" name="person_id" value="'+data.user+'"><label for="logoutpass">Password</label></form></td>';
							if ($('.user-row').length < 1) {
								$('tbody').html('<tr class="user-row"><td>'+data.message+'</td>'+form);
							}else{
								$('tbody').append('<tr class="user-row"><td>'+data.message+'</td>'+form);
							}
							
						}else{
							alert(data.message);
						}
						$('#login input[type=text], #login input[type=password]').val('');
					}
				});
			}
			return false;
		});


		$$('tbody').on('click', '.logout-button', function(event) {
			if (confirm('Finish work day?')) {
				var button = $$(this);

				$('#form_close_day'+button.attr('user')).ajaxSubmit({
					success: function(data){
						console.log(data);
						switch(data.status){
							case -1:case 0:
								notif({
								    type: "error",
								    msg: data.message,
								    width: "all",
								    height: 100,
								    position: "center"
								});
								$('#logoutpass').val('');
							break;
							case 1:
								button.parents('tr.user-row').remove();
								if ($('.user-row').length < 1) {
									$('tbody').html('<tr><td colspan="2" class="td-info"><h2>No have employees selected</h2></td></tr>');
								}
							break;
						}
					},
					dataType:'json'
				});
				event.preventDefault();
				return false;
			}
		});
	});
</script>
<?php $this->load->view("partial/footer"); ?>