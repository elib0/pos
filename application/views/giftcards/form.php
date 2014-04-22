<div id="required_fields_message"><?=$this->lang->line('common_fields_required_message')?></div>
<ul id="error_message_box"></ul>
<?=form_open('giftcards/save/'.$giftcard_info->giftcard_id,array('id'=>'giftcard_form'))?>
<fieldset id="giftcard_basic_info" style="padding:5px;">
<legend><?=$this->lang->line("giftcards_basic_information")?></legend>

<div class="field_row clearfix">
<?=form_label($this->lang->line('giftcards_giftcard_number').':', 'name',array('class'=>'required wide'))?>
	<div class='form_field'>
	<?=form_input(array(
		'name'=>'giftcard_number',
		'id'=>'giftcard_number',
		'value'=>$giftcard_info->giftcard_number
	))?>
	</div>
</div>

<div class="field_row clearfix">
<?=form_label($this->lang->line('giftcards_card_value').':','name',array('class'=>'required wide'))?>
	<div class='form_field'>
	<?=form_input(array(
		'name'=>'value',
		'id'=>'value',
		'value'=>$giftcard_info->value
	))?>
	</div>
</div>

<?=form_submit(array(
	'name'=>'submit',
	'id'=>'submit',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'small_button float_right'
))?>
</fieldset>
<?=form_close()?>
<script type='text/javascript'>
//validation and submit handling
(function($){
	$('#giftcard_form').validate({
		submitHandler:function(form)
		{
			$(form).ajaxSubmit({
			success:function(response)
			{
				tb_remove();
				post_giftcard_form_submit(response);
			},
			dataType:'json'
		});

		},
		errorLabelContainer:"#error_message_box",
 		wrapper: "li",
		rules:
		{
			giftcard_number:
			{
				required:true,
				number:true
			},
			value:
			{
				required:true,
				number:true
			}
   		},
		messages:
		{
			giftcard_number:
			{
				required:"<?php echo $this->lang->line('giftcards_number_required'); ?>",
				number:"<?php echo $this->lang->line('giftcards_number'); ?>"
			},
			value:
			{
				required:"<?php echo $this->lang->line('giftcards_value_required'); ?>",
				number:"<?php echo $this->lang->line('giftcards_value'); ?>"
			}
		}
	});
})(jQueryNew);
</script>
