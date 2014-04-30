<div class="field_row clearfix">
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_first_name').':', 'first_name',array('class'=>'lable-form-required')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'first_name',
				'id'=>'first_name',
				'value'=>$person_info->first_name,
				'class'=>'text_box'
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
				'value'=>$person_info->last_name,
				'class'=>'text_box'
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
				'value'=>$person_info->email,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
</div>
<div class="field_row clearfix">
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">
			<?php echo form_label($this->lang->line('common_phone_number').':', 'phone_number',array('class'=>'lable-form-required')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'phone_number',
				'id'=>'phone_number',
				'value'=>$person_info->phone_number,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_address_1').':', 'address_1',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'address_1',
				'id'=>'address_1',
				'value'=>$person_info->address_1,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_address_2').':', 'address_2',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'address_2',
				'id'=>'address_2',
				'value'=>$person_info->address_2,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
</div>
<div class="field_row clearfix">
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_city').':', 'city',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'city',
				'id'=>'city',
				'value'=>$person_info->city,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_state').':', 'state',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'state',
				'id'=>'state',
				'value'=>$person_info->state,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_zip').':', 'zip',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'zip',
				'id'=>'zip',
				'value'=>$person_info->zip,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
</div>
<div class="field_row clearfix">
	<div style="width: 180px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_country').':', 'country',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_input(array(
				'name'=>'country',
				'id'=>'country',
				'value'=>$person_info->country,
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
	<div style="width: 360px; float: left">
		<div class="field_row clearfix">	
			<?php echo form_label($this->lang->line('common_comments').':', 'comments',array('class'=>'lable-form')); ?>
			<div>
			<?php echo form_textarea(array(
				'name'=>'comments',
				'id'=>'comments',
				'value'=>$person_info->comments,
				'rows'=>'5',
				'cols'=>'40',
				'class'=>'text_box'
			));?>
			</div>
		</div>
	</div>
</div>