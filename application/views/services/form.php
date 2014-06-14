<?php echo form_open('services/save/'.$service_info->service_id,array('id'=>'services_form')); ?>
<!-- <div id="item_basic_info"> -->
<div>
	<h3><?php echo $this->lang->line("services_information"); ?></h3><hr>
	<div class="field_row clearfix">
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_name_owner').':', 'name',array('class'=>'lable-form-required')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'name',
					'id'=>'name',
					'value'=>$service_info->item_number,
					'class'=>'text_box'
				));?>
				</div>
			</div>
		</div>
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_IMEI').':', 'code',array('class'=>'lable-form-required')); ?>
				<div>
				<?php echo form_input(array(
					'name'=>'codeimei',
					'id'=>'codeimei',
					'value'=>$service_info->name,
					'class'=>'text_box'
				));?>
				</div>
			</div>
		</div>
	</div>
	<div class="field_row clearfix">
		<div style="width: 210px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('services_model').':', 'model_label',array('class'=>'lable-form-required')); ?>
				<div >
				<?php echo form_input(array(
					'name'=>'model',
					'id'=>'model',
					'value'=>$service_info->model,
					'class'=>'text_box'
				));?>
				</div>
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
				);?>
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
	'class'=>'small_button float_right'
)); ?>
<?php echo form_close(); ?>
<script type='text/javascript'>
//validation and submit handling
$(function(){
	var pass=true;
	$("#model")
		.autocomplete("<?php echo site_url('services/suggest_models');?>",{max:100,minChars:0,delay:10})
		.result(function(event,data,formatted){})
		.search();

	$('#services_form').validate({
		submitHandler:function(form)
		{
			$('#item_number').val($('#scan_item_number').val());
			$(form).ajaxSubmit({
				success:function(response){ 
					console.log(response);
					tb_remove();
					post_item_form_submit(response);
				},
				dataType:'json'
			});
			return false;
		},
		errorLabelContainer:"#error_message_box",
 		wrapper:"li",
		rules:
		{
			name:"required",
			codeimei:"required",
			model:'required',
   		},
		messages:
		{
			name:"<?php echo $this->lang->line('services_name_owner_is_required'); ?>",
			codeimei:"<?php echo $this->lang->line('services_IMEI_is_required'); ?>",
			model:"<?php echo $this->lang->line('services_model_is_required'); ?>",
		}
	});
});
//new jQuery
(function($){
	$('#is_service').change(function(){
		var checked=$(this).is(':checked');
		$(this).parents('#item_form').find('#quantity,#reorder_level').prop('disabled',checked)
			.parent().parent()[checked?'hide':'show']();
	}).change();
})(jQueryNew);
</script>