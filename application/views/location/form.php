<?php echo form_open('locations/save/',array('id'=>'location_form')); ?>
<div>
	<h3>Hola que hace</h3><hr>
	<?php echo form_label('Location Name:', 'Location').form_input('location', $data['name']); ?><br>
	<?php echo form_label('Hostname:', 'hostname').form_input('hostname', $data['hostname']); ?><br>
	<?php echo form_label('User:', 'username').form_input('username', $data['username']); ?><br>
	<?php echo form_label('New Password:', 'password').form_password('password'); ?><br>
	<?php echo form_label('Data Base:', 'database').form_input('database', $data['database']); ?><br>
	<?php echo form_label('Controlador de base de datos:', 'dbdriver').form_dropdown('dbdriver', $dbdrivers, $data['dbdriver']); ?><br>
	<?php echo form_label('Prefijo DB:', 'dbprefix').form_input('dbprefix', $data['dbprefix']); ?><br>
	<?php echo form_label('Active:', 'active').form_checkbox('active', !$data['active'], $data['active']); ?><br>
	<?php echo form_submit('Save', 'Save');?>
</div>
<?php echo form_close(); ?>