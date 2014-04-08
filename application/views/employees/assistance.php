<?php $this->load->view("partial/header"); ?>





<div id="page_title" style="margin-bottom:8px;">Assistance Marker</div>


<div class="employees-assistance box-form-view">
	<table border="1" style="width: 100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<h3 style="padding-left: 5px">Login:</h3>
			<?php echo form_open($controller_name.'/open_day', array('id'=>'login', 'method'=>'POST')); ?>
			<table border="0">
				<tr>
					<td><?=form_label('Nick Name:', 'name', array("class"=>"lable-form"))?></td>
					<td><input type="text" name="name" class="text_box" required></td>
					<td><?=form_label('Password:', 'password')?></td>
					<td><input type="password" name="password" class="text_box" required></td>
					<td><input type="submit" value="Login" class="small_button" id="submit"></td>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
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
			</td>
		</tr>
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