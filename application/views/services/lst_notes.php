<div>
	<div class="field_row clearfix">
		<div style="margin: 0 0 10px; 0">
			<h3 style="color:#396B98"><?php echo $this->lang->line("services_lbl_summary"); ?></h3>
		</div>
		<div style="padding: 0 20px">
			<ul style=" list-style: none">
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_lbl_work_order') ?>:</strong>&nbsp;<?php echo $service_info->service_id; ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_name_owner') ?>:</strong>&nbsp;<?php echo $service_info->first_name.' '.$service_info->last_name; ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_lbl_device') ?>:</strong>&nbsp;<?php echo $service_info->model_name.' '.$service_info->color; ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_IMEI') ?>:</strong>&nbsp;<?php echo $service_info->serial; ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_received') ?>:</strong>&nbsp;<?php echo $service_info->date_received; ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_delivered') ?>:</strong>&nbsp;<?php echo (trim($service_info->date_delivered)!=''?$service_info->date_delivered:$this->lang->line('services_lbl_instore')); ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_status') ?>:</strong>&nbsp;<span class="status"><?php echo $this->lang->line('services_status_'.$service_info->status); ?></span></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong><?php echo $this->lang->line('services_lbl_phone_number') ?>:</strong>&nbsp;<?php echo $service_info->phone_number; ?></li>
				<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4">
					<strong><?php echo $this->lang->line('services_lbl_address') ?>:</strong>&nbsp;
					<?php echo $service_info->city.', '.$service_info->state.', '.$service_info->zip; ?>
				</li>
				<li style="margin: 0 0 5px 0;"><strong><?php echo $this->lang->line('services_problem') ?>:</strong>&nbsp;<?php echo $service_info->problem; ?></li>
			</ul>
		</div>
	</div>

	<div class="field_row clearfix">
		<div>
			<h3 style="color:#396B98"><?php echo $this->lang->line("services_lbl_new_note"); ?></h3>
		</div>

		<div style="background-color: #F4F4F4; padding: 5px; border: 1px solid #CCC; margin: 5px 0 5px 0;  border-radius: 5px;">
			<div>
				<?php echo form_input(array(
					'name'=>'txtNote',
					'id'=>'txtNote',
					'value'=> '',
					'class'=>'text_box',
					'style'=>'width: 540px;',
					'placeholder'=>'write a new note ...'
				));
				echo form_button(array(
					'name'=>'btnAdd',
					'id'=>'btnAdd',
					'value'=>'btnAdd',
					'content' => '&nbsp;&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;&nbsp;',
					'class'=>'small_button thickbox',
					'style'=>'display: inline-block;margin-left: 20px;',
				));
				?>
			</div>
		</div>
	</div>
	
	<div class="field_row clearfix">
		<div style="margin: 0 0 10px; 0">
			<h3 style="color:#396B98"><?php echo $this->lang->line("services_lbl_noteList"); ?></h3>
		</div>
		<div style="padding: 0 20px">
			<ul id="ul_notes" style="list-style: circle">
				<?php
					if (isset($notes) && count($notes)>0){
						foreach ($notes as $array){
							echo '<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong>'.ucwords($array['name']).':</strong>&nbsp;'.$array['note'].', <small>(<em>'.$array['date'].'</em>)</small></li>';	
						}	
					} 
				?>
			</ul>
		</div>
	</div>

</div>

<script>
(function($){

	$("#btnAdd").click(function() {
  		if ($.trim($('#txtNote').val())!=''){
			$.ajax({
				url: "<?php echo site_url('services/add_note');?>/<?=$service_info->service_id?>/"+$('#txtNote').val().replace(' ', '-'),
			    dataType: 'json',
			    success : function(data) {
					$('#ul_notes').prepend('<li style="margin: 0 0 5px 0; border-bottom: 1px solid #f4f4f4"><strong>'+data['employee']+':</strong>&nbsp;'+data['note']+'</li>');
			    } //success
			});
		}else{
			alert('Note is required!');
		}

		$("#txtNote").focus();

	});

})(jQueryNew);
</script>