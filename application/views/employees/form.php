<?php echo form_open('employees/save/'.$person_info->person_id,array('id'=>'employee_form')); ?>
<div>
	<h3><?php echo $this->lang->line("employees_basic_information"); ?></h3><hr>	
	<?php $this->load->view("people/form_basic_info"); ?>		
</div>
<div>
	<h3><?php echo $this->lang->line("employees_login_info"); ?></h3><hr>
	<div class="field_row clearfix">
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('employees_username').':', 'username',array('class'=>'lable-form-required')); ?>
				<div >
				<?php 
					$disabled=$person_info->username?"disabled":"";
					echo form_input(array(
					'name'=>'username',
					'id'=>'username',
					'value'=>$person_info->username,$disabled=>$disabled,
					'class'=>'text_box'
				));?>
				</div>
			</div>
		</div>
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">
				<?php $password_label_attributes = $person_info->person_id == "" ? array('class'=>'lable-form-required'):array('class'=>'lable-form');
				echo form_label($this->lang->line('employees_password').':', 'password',$password_label_attributes); ?>
				<div>
				<?php echo form_password(array(
					'name'=>'password',
					'id'=>'password',
					'class'=>'text_box'
				));?>
				</div>
			</div>
		</div>
		<div style="width: 180px; float: left">
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('employees_repeat_password').':', 'repeat_password',$password_label_attributes); ?>
				<div >
				<?php echo form_password(array(
					'name'=>'repeat_password',
					'id'=>'repeat_password',
					'class'=>'text_box'
				));?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="employee_permission_info">
	<h3><?php echo $this->lang->line("employees_permission_info"); ?></h3><hr>
	<p><?php echo $this->lang->line("employees_permission_desc"); ?></p>
	<select id="employee_profile_type">
		<option value=""><?php echo $this->lang->line('employees_profi'); ?>...</option>
	</select>
	<input type="hidden" name="employee_profile_type" />
	<div id="radio" style="margin-top: 10px;"><input type="checkbox"  style="margin-right: 10px;"><?php echo $this->lang->line('employees_see'); ?></div>
	<ul id="permission_list" style="display: none;">
		<?php foreach($all_modules->result() as $module) { ?>
		<li>
			<?php
				$subpermissions = explode(',', $module->options);
				$attribs = array(
					'id'=>$module->module_id,
					'name'=>'permissions[]',
					'value'=>$module->module_id,
					'class'=>'permissions-option',
					'checked'=>$this->Employee->has_permission($module->module_id,$person_info->person_id)
				);
				echo form_checkbox($attribs);
			?>
			<span class="medium"><?php echo $this->lang->line('module_'.$module->module_id);?>:</span>
			<span class="small"><?php echo $this->lang->line('module_'.$module->module_id.'_desc');?></span>
			<ul class="module-options">
				<?php 
				foreach ($subpermissions as $subpermission) {
					if ($subpermission != 'none' || $subpermission == '') {
						$attribs = array(
							'id'=>$module->module_id.'-'.$subpermission,
							'name'=>$module->module_id.'[]',
							'value'=>$subpermission,
							'class'=>$module->module_id.'-option',
							'checked'=>$this->Employee->has_privilege_permi($module->module_id,$person_info->person_id,$subpermission));
						echo "<li>";
						echo form_checkbox($attribs);
						echo form_label(ucwords($subpermission));
						echo "</li>";
					}
				}
				?>
			</ul>
		</li>
		<?php } ?>
	</ul>
</div>
<?php $days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'); ?>
<table id="employee_schedule">
	<tr>
		<?php foreach($days as $day) echo '<th>'.$day.'</th>'; ?>
		<th></th>
	</tr>
	<tr>
		<?php foreach($days as $day){
		echo '<td class="checkDays">'.
		form_checkbox(strtolower($day), $day, $this->Schedule->workable_day($day, $person_info->person_id))
		.'</td>';
		} ?>
		<td class="checkDays">Days</td>
	</tr>
	<tr>
		<?php
			$horas = array();
			for ($i=0; $i < 23; $i++) { $horas[] = $i; }
			foreach($days as $day){
				$select=$this->Schedule->workable_day_hour($day, 'in', $person_info->person_id);
				$disabled=$select===false?'disabled="disabled"':'';
				echo '<td>'.form_dropdown('in'.$day, $horas,$select, 'id="in'.strtolower($day).'" '.$disabled).'</td>';
			} 
		?>
		<td>In</td>
	</tr>
	<tr>
		<?php
			unset($horas[0]);
			$horas[] = 23;
			foreach($days as $day){
				$select=$this->Schedule->workable_day_hour($day, 'out', $person_info->person_id);
				$disabled=$select===false?'disabled="disabled"':'';
				echo '<td>'.form_dropdown('out'.$day, $horas,$select, 'id="out'.strtolower($day).'" '.$disabled).'</td>';
			} 
		?>
		<td>Out</td>
	</tr>
</table>
<div class="field_row clearfix requested">
	<?=$this->lang->line('common_fields_required_message')?>
</div>
<ul id="error_message_box"></ul>
<?php
echo form_submit(array(
	'name'=>'submit',
	'id'=>'submit',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'small_button float_right')
);
echo form_close(); ?>
<?php 
	$retypes=''; 
	foreach ($module_profiles as $key) {
		$retypes.=implode("|",$key).']';
	}
?>
<script type='text/javascript'>
$(document).ready(function(){
	var type=[],htype=[],select='<?=$person_info->type_employees?>',options='',retypes='<?=$retypes?>';
	var retypes2=retypes.split(']');
	for (var i=0;i<retypes2.length;i++){
		var types=retypes2[i].split('|');
		if (types[1]){ 
			options+='<option value="'+i+'" '+(select==types[0].toLowerCase()?'selected="selected"':'')+'>'+types[0]+'</option>';
			type[i]=types[1];
			htype[i]=types[0].toLowerCase();
		}
	}
	$('#employee_profile_type').append(options).change(function(event){
		if(!type[this.value]) return;
		$('ul#permission_list :checkbox').removeAttr('checked').filter(type[this.value]).attr('checked','checked');
		$('input[type="hidden"][name="employee_profile_type"]').val(htype[this.value]);
	});

	//Funcionavilidad de los permisos
	$('.permissions-option').click(function(event) {
		var perm = this.value;
		if ($(this).is(':checked')){
			$('.'+perm+'-option').attr('checked','checked');
		}else{
			$('.'+perm+'-option').removeAttr('checked');
		}
	});
	$('#permission_list input[type="checkbox"]:not(.permissions-option)').click(function(event) {
		var perm = $(this).attr('class').split('-');
		if ($(this).is(':checked')){
			$('input[type="checkbox"][value="'+perm[0]+'"].permissions-option').attr('checked','checked');
		}
	});
	$('#radio input').click(function(event) {
		if($(this).is(':checked')) $('#permission_list').css('display','block');
		else $('#permission_list').css('display','none');
	});

	//Verifica  dia marcado para mostrar el selector de hora
	$('table#employee_schedule input[type=checkbox]').change(function(){
		var id = $(this).attr('name');

		if( $(this).is(':checked') ){
			$('select#in'+id).removeAttr('disabled');

			// $('select#out'+id).html('').append('<option value="1">1</option>');
			$('select#out'+id).removeAttr('disabled');
		}else{
			$('select#in'+id).attr('disabled', 'disabled').selectedIndex = 0;
			$('select#out'+id).attr('disabled', 'disabled').val('0');
		}
	});

	//Verifica la hora de entrada para liberar la hora de salida y valida
	$('select[id^="in"]').change(function(){
		var id = $(this).attr('id');
		var val = $(this).val();
		id = id.slice(2, id.length);
		val = parseInt(val);
		// console.log(val);
		val2 = parseInt( $('select#out'+id).val() );

		$(id).attr('checked', 'checked');

		//Elimina items de hora final y agrega nuevos de acuerdo a la hora de entrada seleccionada
		$('select#out'+id).html('');
		for (var i = val+1; i < 24; i++) {
			$('select#out'+id).append('<option value="'+i+'">'+i+'</option>');
		};

		if(val < val2) $('select#out'+id).val(val2); //Validacion hora de salida de acuerdo a la de entrada
		// $('select#out'+id).removeAttr('disabled');
	});

	$('#employee_form').validate({
		submitHandler:function(form)
		{
			$(form).ajaxSubmit({
			success:function(response)
			{   
				if (response.success) tb_remove();
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
			    regex:/^[a-zA-Z\u00C0-\u00FF\s]+$/,
			    minlength: 3
		    },
		    last_name: {
			    required: true,
			     regex:/^[a-zA-Z\u00C0-\u00FF\s]+$/,
			    minlength: 3
		    },
			username:
			{
				required:true,
				minlength: 5
			},

			password:
			{
				<?php if($person_info->person_id == "") { ?>
				required:true,
				<?php } ?>
				minlength: 8
			},
			repeat_password:
			{
 				equalTo: "#password"
			},
    		email: {
			    required: true,
			    email: "email"
		    },
		    employee_profile_type:{ required:true },
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
     		username:
     		{
     			required: "<?php echo $this->lang->line('employees_username_required'); ?>",
     			minlength: "<?php echo $this->lang->line('employees_username_minlength'); ?>"
     		},

			password:
			{
				<?php if($person_info->person_id == "") { ?>
				required:"<?php echo $this->lang->line('employees_password_required'); ?>",
				<?php } ?>
				minlength: "<?php echo $this->lang->line('employees_password_minlength'); ?>"
			},
			repeat_password:
			{
				equalTo: "<?php echo $this->lang->line('employees_password_must_match'); ?>"
     		},
     		email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
     		employee_profile_type:"Profile type is required",
     		phone_number:"<?php echo $this->lang->line('common_phone_invalid_format');  ?>"
		}
	});
});
</script>
