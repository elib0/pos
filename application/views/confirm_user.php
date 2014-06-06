<?php echo form_open('home/confirm_user',array('id' =>'form-back')) ?>
<?php echo $title.'<br>'; ?>
<?php echo $url ?>
<div>
	<div id="login_form">
		<div class="field_row clearfix" style="margin: 0 0 5px 0">
			<div>
				<?php echo form_label($this->lang->line('login_username').':', 'name',array('class'=>'lable-form-required')); ?>
				<div>
					<?php
						echo form_input(array(
							'name'=>'username',
							'value'=>$fastUser,
							'disabled'=>'disabled',
							'class'=>'text_box'
						));
					?>
				</div>
			</div>
		</div>
		<div class="field_row clearfix" style="margin: 0 0 5px 0">
			<div>
				<?php echo form_label($this->lang->line('login_password').':', 'name',array('class'=>'lable-form-required')); ?>
				<div>
					<?php 
						echo form_password(array(
							'name'=>'password',
							'id'=>'password',
							'class'=>'text_box'
						)); 
					?>
				</div>
			</div>
		</div>
		<div class="field_row clearfix" id="msg_after_cong" style="display: none">
		</div>
		<ul id="error_msg_back"></ul>
		<div class="form-row" style="text-align: center;margin-top: 20px;">
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
						if (response.success) {
							tb_show("My Caption", 'index.php/items/inventory/69/width:600/height:430');
						}else{
							var label = '<label for="password" generated="true" class="error" style="display: inline;">'+response.message+'</label>';
							$('#error_msg_back').html('<li>'+label+'</li>').css('display','inline');
						}						
					},
					dataType:'json'
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