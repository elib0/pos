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
	<div>
		<ul id="error_message_box"></ul>
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
	$('#location_form').validate({
		submitHandler:function(form)
		{
			$(form).ajaxSubmit({
				success: function(data){
					console.log(data);
					if (data.success) {
						post_item_form_submit(data);
					}else{
						notif({
							type: 'error',
							msg: data.message,
							width: 400,
							height: 100,
							position: "right"
						});
					}
				},dataType:'json'
			});
		},
		errorLabelContainer: "#error_message_box",
 		wrapper: "li",
		rules: 
		{
			location: {
			    required: true,
			    regex:/^[a-zA-Z\s]+$/,
			    minlength: 5,
			    maxlength: 10
		    },
		    hostname: {
			    required: true,
			    regex:/^[a-zA-Z\s]+$/,
			    minlength: 5,
			    maxlength: 15
		    },
			username: {
			    required: true,
			    regex:/^[a-zA-Z\s]+$/,
			    minlength: 3,
			    maxlength: 10
		    },
    		database:
			{
				required:true,
			    regex:/^[a-zA-Z\s]+$/,
				minlength: 5,
			    maxlength: 10
			}
   		},
		messages: 
		{
			location: {
			      required: "Location name is required!",
			      regex:"<?php echo  $this->lang->line('common_first_name_only_char');?>",
			      minlength: jQuery.format("<?php echo $this->lang->line('common_at_least'); ?> {0} <?php echo $this->lang->line('common_at_characters'); ?>!")
    		},
    		hostname: {
			      required: "A Host or Ip are required!",
			      regex:"<?php echo  $this->lang->line('common_first_name_only_char');?>",
			      minlength: jQuery.format("<?php echo $this->lang->line('common_at_least'); ?> {0} <?php echo $this->lang->line('common_at_characters'); ?>!")
    		},
     		username: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
     		database:"<?php echo $this->lang->line('common_phone_invalid_format');  ?>"
		}
	});
			
});
</script>