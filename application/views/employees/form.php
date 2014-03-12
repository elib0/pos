<?php
echo form_open('employees/save/'.$person_info->person_id,array('id'=>'employee_form'));
?>
<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
<ul id="error_message_box"></ul>
<fieldset id="employee_basic_info">
<legend><?php echo $this->lang->line("employees_basic_information"); ?></legend>
<?php $this->load->view("people/form_basic_info"); ?>
</fieldset>

<fieldset id="employee_login_info">
<legend><?php echo $this->lang->line("employees_login_info"); ?></legend>
<div class="field_row clearfix">
<?php echo form_label($this->lang->line('employees_username').':', 'username',array('class'=>'required')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'username',
		'id'=>'username',
		'value'=>$person_info->username));?>
	</div>
</div>

<?php
$password_label_attributes = $person_info->person_id == "" ? array('class'=>'required'):array();
?>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('employees_password').':', 'password',$password_label_attributes); ?>
	<div class='form_field'>
	<?php echo form_password(array(
		'name'=>'password',
		'id'=>'password'
	));?>
	</div>
</div>


<div class="field_row clearfix">
<?php echo form_label($this->lang->line('employees_repeat_password').':', 'repeat_password',$password_label_attributes); ?>
	<div class='form_field'>
	<?php echo form_password(array(
		'name'=>'repeat_password',
		'id'=>'repeat_password'
	));?>
	</div>
</div>
</fieldset>

<fieldset id="employee_permission_info">
<legend><?php echo $this->lang->line("employees_permission_info"); ?></legend>
<p><?php echo $this->lang->line("employees_permission_desc"); ?></p>

<ul id="permission_list">
<?php
foreach($all_modules->result() as $module)
{
?>
<li>
<?php
	$subpermissions = explode(',', $module->options);
	$attribs = array(
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
				'name'=>$module->module_id.'[]',
				'value'=>$subpermission,
				'class'=>$module->module_id.'-option');
			echo "<li>";
			echo form_checkbox($attribs);
			echo form_label(ucwords($subpermission));
			echo "</li>";
		}
	}
	?>
</ul>
</li>
<?php
//Dias de la semana para armar el horario
$days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

}
?>
</ul>
</fieldset>
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
			for ($i=0; $i < 23; $i++) {
				$horas[] = $i;
			}
			foreach($days as $day) echo '<td>'.form_dropdown('in'.$day, $horas, $this->Schedule->workable_day_hour($day, 'in', $person_info->person_id), 'id="in'.strtolower($day).'"').'</td>';
		?>
		<td>In</td>
	</tr>
	<tr>
		<?php
			unset($horas[0]);
			$horas[] = 23;
			foreach($days as $day) echo '<td>'.form_dropdown('out'.$day, $horas, $this->Schedule->workable_day_hour($day, 'out', $person_info->person_id), 'id="out'.strtolower($day).'"').'</td>';
		?>
		<td>Out</td>
	</tr>

</table>
<?php
echo form_submit(array(
	'name'=>'submit',
	'id'=>'submit',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'submit_button float_right')
);
echo form_close();
?>
<script type='text/javascript'>

//validation and submit handling
$(document).ready(function()
{
	//Funcionavilidad de los permisos
	$('.permissions-option').click(function(event) {
		var perm = this.value;
		if ($(this).is(':checked')){
			$('.'+perm+'-option').attr('checked','checked');
		}else{
			$('.'+perm+'-option').removeAttr('checked');
		}
	});
	// $('#submit').click(function(e){
	// 	var days = $('td.checkDays > input[type=checkbox]');
	// 	var hours = $('td.checkDays > input[type=checkbox]');

	// 	var jsonObject = {};
	// 	$.each(days, function(i, value){
	// 		var status = ( $(this).is(':checked') ) ? 1 : 0; //Compruebo si esta marcado
	// 		jsonObject[i] = {
	// 			active: status,
	// 			timeIn: 0,
	// 			timeOut: 23
	// 		}
	// 	});

	// 	var json = JSON.stringify(jsonObject);
	// 	console.log(json);
	// 	return false;
	// });

	//Desactivo la seleccion de horas hasta q el usuario marque algun dia
	// $('table#employee_schedule select').attr('disabled', 'disabled');

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
			first_name: "required",
			last_name: "required",
			username:
			{
				required:true,
				minlength: 5
			},

			password:
			{
				<?php
				if($person_info->person_id == "")
				{
				?>
				required:true,
				<?php
				}
				?>
				minlength: 8
			},
			repeat_password:
			{
 				equalTo: "#password"
			},
    		email: "email"
   		},
		messages:
		{
     		first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
     		last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
     		username:
     		{
     			required: "<?php echo $this->lang->line('employees_username_required'); ?>",
     			minlength: "<?php echo $this->lang->line('employees_username_minlength'); ?>"
     		},

			password:
			{
				<?php
				if($person_info->person_id == "")
				{
				?>
				required:"<?php echo $this->lang->line('employees_password_required'); ?>",
				<?php
				}
				?>
				minlength: "<?php echo $this->lang->line('employees_password_minlength'); ?>"
			},
			repeat_password:
			{
				equalTo: "<?php echo $this->lang->line('employees_password_must_match'); ?>"
     		},
     		email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
		}
	});
});
</script>
