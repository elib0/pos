<?php $this->load->view("partial/header"); ?>

<div id="page_title" style="margin-bottom:8px;">Assistance Marker</div>

<div class="employees-assistance box-form-view" style="height: 500px">
	<table border="0" style="width: 100%" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<h3>If you want to start to work you have to make login on below form</h3>
			</td>
		</tr>
		<tr>
			<td>
				
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
				<h3>List of employees working right now</h3>
			</td>
		</tr>	
		<tr>
			<td>
					<table border="0" class="tablesorter report share-inventorie-report" id="sortable_table">
						<thead>
							<tr style="background-color: #396B98; color: #FFF; font-weight: bold">
								<td width="30%">User</td>
								<td>Password</td>	
								<td>Action</td>	
							</tr>
						</thead>
						<tbody>
							<?php if ($employees_working): ?>
							<?php foreach ($employees_working->result() as $employee): ?>
							
							<form id="form_close_day<?php echo $employee->employee_id ?>" action="index.php/<?php echo $controller_name; ?>/close_day" method="POST">
							<tr class="user-row">
								<td>
									<?php echo ucwords($employee->first_name.' '.$employee->last_name); ?>
								</td>
								<td>
									<input type="password" name="logoutpass" id="logoutpass" class="text_box">
									<input type="hidden" name="person_id" value="<?php echo $employee->employee_id; ?>">
								</td>
								<td>
									<button class="small_button logout-button" user="<?php echo $employee->employee_id ?>"><?php echo $this->lang->line("common_logout"); ?></button>
								</td>
							</tr>
							</form>
							<?php endforeach ?>
							<?php else: ?>
							<tr>
								<td colspan="3" class="td-info"><small><em>There aren't employees working right now.</em></small></td>
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
			if (confirm('Do you want to start to work ?')) {
				$('#login').ajaxSubmit({
					dataType:'json',
					success:function(data)
					{
						// console.log(data);
						if (data.status == 1) {
							var form = '<tr class="user-row"><form id="form_close_day'+data.user+'" action="index.php/<?php echo $controller_name; ?>/close_day" method="POST">';
							form += '<td>'+data.message+'</td>';
							form += '<td><input type="password" name="logoutpass" id="logoutpass"><input type="hidden" name="person_id" value="'+data.user+'"></td>';
							form += '<td><button class="logout-button" user="'+data.user+'"><?php echo $this->lang->line("common_logout"); ?></button></td>';
							form += '</form></tr>';

							if ($('#sortable_table tbody .user-row').length < 1) {
								$('#sortable_table tbody').html(form);
							}else{
								$('#sortable_table tbody').append(form);
							}
						}else{
							notif({
							    type: "error",
							    msg: data.message,
							    width: "all",
							    height: 100,
							    position: "center"
							});
						}
						$('#login input[type=text], #login input[type=password]').val('');
					}
				});
			}
			return false;
		});


		$$('#sortable_table tbody').on('click', '.logout-button', function(event) {
			if (confirm('Do you want to finish to work ?')) {
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
								button.parents('#sortable_table tbody tr.user-row').remove();
								if ($('#sortable_table tbody .user-row').length < 1) {
									$('#sortable_table tbody').html('<tr><td colspan="3" class="td-info"><small><em>There aren\'t employees working right now.</em></small></td></tr>');
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