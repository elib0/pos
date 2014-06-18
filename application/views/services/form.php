<?php echo form_open('services/save/'.$service_info->service_id,array('id'=>'services_form')); 
$disabled=$service_info->service_id!=-1?'disabled':'';
?>
<!-- <div id="item_basic_info"> -->
<div>
	<h3><?php echo $this->lang->line("services_information"); ?></h3><hr>
	<div class="field_row clearfix invisible">
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">	
				<?php echo form_label($this->lang->line('common_first_name').':', 'first_name',array('class'=>'lable-form-required')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'first_name',
					'id'=>'first_name',
					'value'=>'disabled',
					'class'=>'text_box',
					'disabled'=>'disabled'
				));?>
				</div>
			</div>
		</div>
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">	
				<?php echo form_label($this->lang->line('common_last_name').':', 'last_name',array('class'=>'lable-form-required')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'last_name',
					'id'=>'last_name',
					'value'=>'disabled',
					'class'=>'text_box',
					'disabled'=>'disabled'
				));?>
				</div>
			</div>
		</div>
		<div style="width: 180px; float: left">
				<div class="field_row clearfix">	
				<?php echo form_label($this->lang->line('common_email').':', 'email',array('class'=>'lable-form-required')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'email',
					'id'=>'email',
					'value'=>'disabled',
					'class'=>'text_box',
					'disabled'=>'disabled'
				));?>
				</div>
			</div>
		</div>
	</div>
	<div class="field_row clearfix">
		<div class="invisible" style="width: 180px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('common_phone_number').':', 'phone_number',array('class'=>'lable-form-required')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'phone_number',
					'id'=>'phone_number',
					'value'=>'disabled',
					'class'=>'text_box',
					'disabled'=>'disabled'
				));?>
				</div>
			</div>
		</div>
		<div class="noinvisible" style="width: <?php echo $disabled===''?'420':'210' ?>px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_name_owner').':', 'name',array('class'=>'lable-form-required','style'=>'float:none;display:block;')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'name',
					'id'=>'name',
					'value'=>$service_info->first_name?$service_info->first_name.' '.$service_info->last_name:'',
					'class'=>'text_box',$disabled=>$disabled
				));
				if ($disabled==='') echo form_button(
					array(
						'name'=>'newc',
						'id'=>'newc',
						'value'=>'newc',
						'content' => '+',
						'class'=>'small_button thickbox',
						'style'=>'display: inline-block; margin-left: 20px;'
					)
				);
				?>
				</div>
			</div>
		</div>
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_IMEI').':', 'code',array('class'=>'lable-form')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'codeimei',
					'id'=>'codeimei',
					'value'=>$service_info->serial,
					'class'=>'text_box',$disabled=>$disabled
				));?>
				</div>
			</div>
		</div>
	</div>
	<div class="field_row clearfix">
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_brand').':', 'brand_label',array('class'=>'lable-form-required')); ?>
				<div >
				<?php echo form_input(array(
					'name'=>'brand',
					'id'=>'brand',
					'value'=>$service_info->brand_name,
					'class'=>'text_box',$disabled=>$disabled
				));?>
				</div>
			</div>
		</div>
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_model').':', 'model_label',array('class'=>'lable-form-required')); ?>
				<div >
				<?php echo form_input(array(
					'name'=>'model',
					'id'=>'model',
					'value'=>$service_info->model_name,
					'class'=>'text_box',$disabled=>$disabled
				));?>
				</div>
			</div>
		</div>
	</div>
	<div class="field_row clearfix">
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_status').':', 'brand_label',array('class'=>'lable-form-required')); $status=array();
					for ($i=1; $i < 5; $i++) { $status[$i]=$this->lang->line('services_status_'.$i); }
					// $status[100]=$this->lang->line('services_status_100');
				?>
				<div> <?php echo form_dropdown('status',$status,$service_info->status,"id='status'"); ?> </div>
			</div>
		</div>
	</div>
	<div class="field_row clearfix">
		<div style="float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('common_comments').':', 'comments',array('class'=>'lable-form')); ?>
				<div>
				<?php echo form_textarea(array(
					'name'=>'comments',
					'id'=>'comments',
					'value'=>$service_info->comments,
					'rows'=>'5',
					'cols'=>'60')
				);
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="field_row clearfix requested">
	<?=$this->lang->line('common_fields_required_message')?>
</div>
<ul id="error_message_box"></ul>
<?php echo form_submit(array(
	'name'=>'enviar',
	'id'=>'enviar',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'small_button float_right')); 
     echo form_close(); 


     $hidden = array('item' => '3','customer_id' => $service_info->person_id, 'service' => $service_info->service_id);

	 echo form_open('sales/add/', '', $hidden);

	 echo form_submit(array(
		'name'=>'pay',
		'id'=>'pay',
		'style'=>'display: none;',
		'value'=>$this->lang->line('services_pay'),
		'class'=>'small_button float_right')); 	

	 echo form_close();

?>
<script type='text/javascript'>
//validation and submit handling
$(function(){
	$('#newc').click(function() { 	
		$('div.invisible input').val('').removeAttr('disabled').parents('div.invisible').show('fast').removeClass('invisible');
		$('div.noinvisible input').val('disabled').attr('disabled', 'disabled').parents('div.noinvisible').hide('fast');
	});	
	$("#brand").autocomplete("<?php echo site_url('services/suggest_brand');?>",{max:100,minChars:0,delay:10})
				.result(function(event,data,formatted){
					if(data){
						if ( $("#model").data('autocomplete')) {
							 $("#model").autocomplete("destroy");
							 $("#model").removeData('autocomplete');
						}
						$("#model").autocomplete("<?php echo site_url('services/suggest_models');?>/"+data[0],{max:100,minChars:0,delay:10})
								.result(function(event,data,formatted){}).search();
					}else{
						if ( $("#model").data('autocomplete')) {
							 $("#model").autocomplete("destroy");
							 $("#model").removeData('autocomplete');
							 $("#brand").removeData('autocomplete');
						}
					}
				}).search();
	$("#name").autocomplete("<?php echo site_url('services/suggest_owner');?>",{max:100,minChars:0,delay:10})
				.result(function(event,data,formatted){}).search();

	$('#status').change(function(){ if($(this).val()=='3') $('#pay').show();})

	$('#services_form').validate({
		submitHandler:function(form)
		{
			$('#item_number').val($('#scan_item_number').val());
			$(form).ajaxSubmit({
				success:function(response){ 
					if (response.noOw){ if (confirm(response.message)) $('#newc').click(); } 
					else{					
						tb_remove();
						post_item_form_submit(response);
					}
				},
				dataType:'json'
			});
			return false;
		},
		errorLabelContainer:"#error_message_box",
 		wrapper:"li",
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
			},
			name:"required",
			//codeimei:"required",
			model:'required',
			status:'required',
			brand:'required',
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
     		phone_number:"<?php echo $this->lang->line('common_phone_invalid_format');  ?>",
			name:"<?php echo $this->lang->line('services_name_owner_is_required'); ?>",
			//codeimei:"<?php echo $this->lang->line('services_IMEI_is_required'); ?>",
			model:"<?php echo $this->lang->line('services_model_is_required'); ?>",
			status:"<?php echo $this->lang->line('services_status_is_required'); ?>",
			brand:"<?php echo $this->lang->line('services_brand_is_required'); ?>"
		}
	});
});

</script>
