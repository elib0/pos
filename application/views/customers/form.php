<?php echo form_open_multipart('customers/save/'.$person_info->person_id,array('id'=>'customer_form')); ?>
<div>
	<h3><?php echo $this->lang->line("customers_basic_information"); ?></h3><hr>
	<?php $this->load->view("people/form_basic_info"); ?>
	<div class="field_row clearfix">
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">	
				<?php echo form_label($this->lang->line('customers_account_number').':', 'account_number',array('class'=>'lable-form')); ?>
				<div class='form_field'>
				<?php echo form_input(array(
					'name'=>'account_number',
					'id'=>'account_number',
					'value'=>$person_info->account_number,
					'class'=>'text_box'
				));?>
				</div>
			</div>
		</div>
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">
				<?php 
					echo form_checkbox('taxable', '1', $person_info->taxable == '' ? TRUE : (boolean)$person_info->taxable);
					echo form_label($this->lang->line('customers_taxable').':', 'taxable',array('class'=>'lable-form','style'=>'float:none')); 
				?>
			</div>
		</div>
	</div>
</div>
<?php
echo form_submit(array(
	'name'=>'submit',
	'id'=>'submit',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'small_button float_right'
)); 
echo form_close(); ?>
<script type='text/javascript'>

//validation and submit handling
$(document).ready(function()
{
	$('#customer_form').validate({
		submitHandler:function(form)
		{
			$(form).ajaxSubmit({
			success:function(response)
			{
				tb_remove();
				post_person_form_submit(response);
			},
			dataType:'json'
		});

		},
		errorLabelContainer: "#error_message_box",
 		wrapper: "li",
		rules: 
		{
			first_name: {
			    required: true,
			    regex:/^[a-zA-Z\s]+$/,
			    minlength: 3
		    },
		    last_name: {
			    required: true,
			    regex:/^[a-zA-Z\s]+$/,
			    minlength: 3
		    },
			email: {
			    required: true,
			    email: "email"
		    },
    		phone_number:
			{
				required:true,
				number:true
			}
   		},
		messages: 
		{
			first_name: {
			      required: "<?php echo $this->lang->line('common_first_name_required'); ?>",
			      regex:"<?php echo  $this->lang->line('common_first_name_only_char');?>",
			      minlength: jQuery.format("<?php echo $this->lang->line('common_at_least'); ?> {0} <?php echo $this->lang->line('common_at_characters'); ?>!")
    		},
    		last_name: {
			      required: "<?php echo $this->lang->line('common_last_name_required'); ?>",
			      regex:"<?php echo  $this->lang->line('common_first_name_only_char');?>",
			      minlength: jQuery.format("<?php echo $this->lang->line('common_at_least'); ?> {0} <?php echo $this->lang->line('common_at_characters'); ?>!")
    		},
     		email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
     		phone_number:"<?php echo $this->lang->line('common_phone_invalid_format');  ?>"
		}
	});
});
</script>