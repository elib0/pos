<style>
	#location_form ul{
		list-style-type: none;
	}
	#location_form ul li{
		float: left;
		min-width: 280px;
		margin: .4em 0;
	}
	
	#location_form > div > div{
		margin-bottom: 1em;
		clear: both;
	}
</style>
<?php echo form_open('locations/save/',array('id'=>'location_form')); ?>
<div>
	<div>
		<h3><?php echo $this->lang->line('location_general_info') ?></h3><hr>
		<?php echo form_hidden('id', $data['id']); ?>
		<ul>
			<li><?php echo form_label($this->lang->line('location_location_name').':', 'Location', array('class'=>'lable-form-required')).'<br>'.form_input('location', $data['name'], 'class="text_box"'); ?></li>
			<li><?php echo form_label($this->lang->line('location_host').':', 'hostname', array('class'=>'lable-form-required')).'<br>'.form_input('hostname', $data['hostname'], 'class="text_box"'); ?></li>
		</ul>
		<ul>
			<li><?php echo form_label($this->lang->line('location_user').':', 'username', array('class'=>'lable-form-required')).'<br>'.form_input('username', $data['username'], 'class="text_box"'); ?></li>
			<li><?php echo form_label($this->lang->line('location_password').':', 'password').'<br>'.form_password('password','', 'class="text_box"'); ?></li>
		</ul>
		<div>
		<?php
			if ($data['id'] <= 0) {
			 	echo form_label($this->lang->line('location_database').':', 'database', array('class'=>'lable-form-required')).'<br>'.form_input('database', $data['database'],'class="text_box"').'<br>';
			}else{
				echo $this->lang->line('location_database').':'.'<br>'.ucwords($data['database']);
			}
		?>
		</div>
	</div>
	<div>
		<h3><?php echo $this->lang->line('location_advanced_information') ?></h3><hr>
		<ul>
			<li><?php echo form_label($this->lang->line('location_driver').':', 'dbdriver').'<br>'.form_dropdown('dbdriver', $dbdrivers, $data['dbdriver']); ?></li>
			<li><?php echo form_label($this->lang->line('location_active').':', 'active').'<br>'.form_checkbox('active', !$data['active'], $data['active']); ?></li>
		</ul>
	</div>
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
					var alert = 'error';
					var width = 400;
					console.log(data);
					if (data.success) {
						alert = 'success';
						width = "all";
					}
					notif({
						type: alert,
						msg: data.message,
						width: width,
						height: 100,
						position: "right"
					});
				},dataType:'json'
			});
			return false;
		});
			
	});
</script>