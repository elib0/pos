<?php echo form_open('locations/save/',array('id'=>'location_form')); ?>
<div>
	<h3><?php echo $this->lang->line('location_general_info') ?></h3><hr>
	<?php echo form_hidden('id', $data['id']); ?>
	<?php echo form_label($this->lang->line('location_location_name').':', 'Location').form_input('location', $data['name']); ?><br>
	<?php echo form_label($this->lang->line('location_host').':', 'hostname').form_input('hostname', $data['hostname']); ?><br>
	<?php echo form_label($this->lang->line('location_user').':', 'username').form_input('username', $data['username']); ?><br>
	<?php echo form_label($this->lang->line('location_password').':', 'password').form_password('password'); ?><br>
	<?php
	if ($data['id'] <= 0) {
	 	echo form_label($this->lang->line('location_database').':', 'database').form_input('database', $data['database']).'<br>';
	} 
	?>
	<br><h3><?php echo $this->lang->line('location_advanced_information') ?></h3><hr>
	<?php echo form_label($this->lang->line('location_driver').':', 'dbdriver').form_dropdown('dbdriver', $dbdrivers, $data['dbdriver']); ?><br>
	<?php echo form_label($this->lang->line('location_active').':', 'active').form_checkbox('active', !$data['active'], $data['active']); ?><br>
	<?php echo form_submit(array(
	'name'=>'save',
	'id'=>'save',
	'value'=>$this->lang->line('location_save'),
	'class'=>'small_button float_right'
	)); ?>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#save').click(function(event) {
			$('#location_form').ajaxSubmit({
				success: function(data){
					post_location_form_submit(data);
				},dataType:'json'
			});
			return false;
		});
			
	});

	function post_location_form_submit(response){
		if(!response.success){
			set_feedback(response.message,'error_message',true);
		}else{
			set_feedback(response.message,'success_message',false);
			setTimeout(function() { location.reload(); }, 1000);
		}
	}
</script>