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
	<input type="text" name="name">
	<?php echo form_label('Password:', 'password'); ?>
	<input type="password" name="password">
	<input type="submit" value="Login" id="submit">
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
				<td><button class="logout-button" user="<?php echo $employee->employee_id ?>">logout</button></td>
			</tr>
			<?php endforeach ?>
			<?php else: ?>
			<tr>
				<td colspan="2" class="td-info"><h2>No Employees Working</h2></td>
			</tr>	
			<?php endif ?>
		</tbody>
	</table>
</div>
<script>
	$(function() {
		$('#submit').click(function(event) {
			if (confirm('El usuario quedara logueado')) {
				$('#login').ajaxSubmit({
					dataType:'json',
					success:function(data)
					{
						if (data.status == 1) {
							var button = '<td><button class="logout-button" user="'+data.user+'">Logout</button></td></tr>';
							if ($('.user-row').length < 1) {
								$('tbody').html('<tr class="user-row"><td>'+data.message+'</td>'+button);
							}else{
								$('tbody').append('<tr class="user-row"><td>'+data.message+'</td>'+button);
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
			if (confirm('Vas a salir del horario, deseas continuar?')) {
				var button = $$(this);
				$$.ajax({
					url: 'index.php/<?php echo $controller_name; ?>/close_day',
					type: 'POST',
					dataType: 'json',
					data: {'id': button.attr('user')},
					success: function(data){
						if (data == 1) {
							button.parents('tr.user-row').remove();
							if ($('.user-row').length < 1) {
								$('tbody').html('<tr><td colspan="2" class="td-info"><h2>No have employees selected</h2></td></tr>');
							}
						}
					}
				});
			}
		});
	});
</script>
<?php $this->load->view("partial/footer"); ?>