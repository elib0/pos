<style type="text/css" media="screen">
	#back-locationes li input[type="radio"]:checked{
		background-color: #f4f4f4;
	}
</style>
<?php 
if (!$referen){
echo form_open('backup/confirm/-1',array('id' =>'form-back')) ?>
<div id="container">
	<ul id="error_msg_back"></ul>
	<div id="login_form">
		<div class="form-row">
			<div class="form_field_label"><?php echo $this->lang->line('login_username'); ?>:</div>
			<div class="form_field">
				<?php
					echo form_input(array(
						'name'=>'username',
						'size'=>'20', 
						'value'=>$fastUser,
						'disabled'=>'disabled'
					));
				?>
			</div>
		</div>
		<div class="form-row">
			<div class="form_field_label"><?php echo $this->lang->line('login_password'); ?>:</div>
			<div class="form_field">
				<?php 
					echo form_password(array(
						'name'=>'password',
						'id'=>'password',
						'size'=>'20')
					); 
				?>
			</div>
		</div>
		<div class="form-row">
			<?php echo form_submit('confirm-button',$this->lang->line('recvs_complete_receiving'), 'class = "big_button" id="b-login-c"'); ?>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#form-back').validate({
			submitHandler:function(form)
			{	$('#b-login-c').attr('disabled','disabled');
				$('#form-back').ajaxSubmit({
					success:function(response)
					{   
						console.log(response);
						var clas =response.success?'success_message':'error_message';
						set_feedback(response.message,'success_message',response.success);
						location.reload();
					},
					dataType:'json',
					contents:function(data){
						$('#b-login-c').removeAttr('disabled');
					}
				});
			},
			errorLabelContainer: "#error_msg_back",
	 		wrapper: "li",
			rules:
			{
				password: { required: true }
	   		},
			messages:
			{
				password:
				{
					required:"<?php echo $this->lang->line('employees_password_required'); ?>"
				}
			}
		});
	});
</script>
<?php }else{ ?>
<?php echo form_open_multipart('backup/confirm/-7',array('id'=>'recover-form')); ?>
<div class="box-form-view">
	<ul id="error_msg_back"></ul>	
	<div class="field_row clearfix" style="margin: 0 0 5px 0">
		<div style="width: 250px; float: left">
			<div class="field_row clearfix">	
				<?php echo form_label($this->lang->line('login_username').':'); ?>
				<div>
					<?php 
						echo form_input(array(
							'name'=>'username',
							'size'=>'20', 
							'value'=>$fastUser,
							'disabled'=>'disabled'
						));
					?>
				</div>
			</div>
			<div class="field_row clearfix">	
				<?php echo form_label($this->lang->line('login_password').':'); ?>
				<div>
					<?php 
						echo form_password(array(
							'name'=>'password',
							'id'=>'password',
							'size'=>'20')
						); 
					?>
				</div>
			</div>
		</div>
	</div>
	<div id="file-ext" class="field_row clearfix" style="margin: 0 0 5px 0">
		<div style="width: 100%; float: left; margin-top: 5px">
			<div class="field_row clearfix">
			<?php echo form_label($this->lang->line('config_recover_fe').':'); ?>
			<div class='form_field' style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; ">
				<input type="file" name="datab" id="datab">
				<input type="hidden" name="logo_name" id="logo_name" value="<?=$this->config->item('logo')?>">
				<div class="upload_label">
					<?php echo $this->lang->line('config_recover_f');?>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php if ($numF>0){ ?>
	<div class="field_row clearfix" style="margin: 0 0 5px 0">
		<div id="radio" style="margin-top: 10px;"><input type="checkbox"  name="recover-backup" style="margin-right: 10px;"><?php echo $this->lang->line('config_recover_f_backup'); ?></div>
	</div>
	<div id="option-backup" class="field_row clearfix" style="display:none; margin: 0 0 5px 0">
		<div class="sub-title-view"> <?php echo $this->lang->line('config_backup_info'); ?> </div>
	</div>
	<div id="list-backup" class="field_row clearfix" style="display:none;margin: 0 0 5px 0">
		<div class="field_row clearfix" style="margin: 0 0 5px 0">
			<label style="float: none;"><?php echo $this->lang->line('config_backup_list').':'; ?></label>
			<div><ul id="back-locationes">
				<?php 
				$bd=$this->session->userdata('dblocation');$a=0;
				foreach ($files as $key) {
					if (strpos($key,$bd)!==false){
						$key=str_replace('.sql','',$key);
						$key=str_replace($bd.' ','',$key);
				?>	
						<li><input type="radio" name="list-back" value="<?php echo $key?>" <?php echo ($a==0?'checked=checked':'');$a++; ?>><?php echo $key; ?></li>
						
				<?php }
				 } ?>
			</ul></div>
		</div>
	</div>
	<?php } ?>
<div class="field_row clearfix">
	<?php
		echo form_submit(
			array(
				'name'=>'sendto',
				'id'=>'sendto',
				'value'=>$this->lang->line('config_recover'),
				'class'=>'big_button float_left'
			)
		);
		if ($numF>0){ 
			echo form_button(
				array(
					'name'=>'dow',
					'id'=>'dow',
					'value'=>'dow',
					'content' => $this->lang->line('config_backup_dow'),
					'class'=>'big_button float_left',
					'style'=>'display:none;'
				)
			);
		}
	?>
</div>
<?php echo form_close(); ?>
<script type='text/javascript'>
//validation and submit handling
$(document).ready(function(){

	$('#radio input').change(function(event) {
		if($(this).is(':checked')){
			$('#option-backup,#list-backup,#dow').css('display','block');
			$('#file-ext').css('display','none');
			$('#datab').attr('name','bdata');
			$('#error_msg_back label[for="datab"]').parents('li').remove();
		}else{
			$('#option-backup,#list-backup,#dow').css('display','none');
			$('#file-ext').css('display','block');
			$('#datab').attr('name','datab');
		}
	});
	$('#dow').click(function() {
		if ($('#radio input').is(':checked')){
			var dir=(window.location+'').split('index.php');
			window.location=dir[0]+'index.php/backup/confirm/-5'+'/'+$('input[name="list-back"]:checked').val();
		}
	});
	$('#datab').change(function() {
		var ext=$(this).val().split('.');
		if(ext[(ext.length-1)]!='sql' && ext[(ext.length-1)]!='txt'){
			alert('<?php echo $this->lang->line("config_backup_notxt"); ?>');
			$('#datab').removeAttr('value');
		}
	});

		$('#recover-form').validate({
			submitHandler:function(form)
			{
				if (confirm("<?php echo $this->lang->line('config_backup_emer'); ?>")){
					$('#datab').attr('name','datab');
					$(form).ajaxSubmit({
						success:function(response)
						{   
							alert(response.message);
							alert("<?php echo $this->lang->line('config_recover_reload_after'); ?>");
							location.reload();
						},
						error:function(data){
							// console.log(data);
							alert("<?php echo $this->lang->line('config_recover_error_file')?>");
							alert("<?php echo $this->lang->line('config_recover_reload_after'); ?>");
							location.reload();
						},
						dataType:'json'
					});
				}
				return false;
			},
			errorLabelContainer: "#error_msg_back",
	 		wrapper: "li",
			rules:
			{
				password: { required: true },
				datab: { required: true }
	   		},
			messages:
			{
				password:
				{
					required:"<?php echo $this->lang->line('employees_password_required'); ?>"
				},
				datab:
				{
					required:"<?php echo $this->lang->line('employees_password_required'); ?>"
				}
			}
		});

 });
</script>
<?php } ?>