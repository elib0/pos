<?php $this->load->view("partial/header"); ?>

<div id="page_title" style="margin-bottom:8px;"><?php echo $report_name.' '.$this->lang->line('reports_report_input'); ?></div>

<?php
	
	if(isset($error)){
		echo "<div class='error_message' style=' margin: 0 0 10px 0'>".$error."</div>";
	}
?>

<div class="box-form-view">
<?php 
	if ($this->Employee->isAdmin()){
	$dbs = $this->Location->get_select_option_list(false, true);
	$dbs['default']='Principal';
	if (count($dbs)>1) $dbs['all'] = 'All';
?>
	<div>
		<label class="lable-form" for="locationbd">Select a location:</label>&nbsp;
		<?=form_dropdown('locationbd', $dbs,'', 'id="locationbd"')?>
	</div>
<?php }else{ 
		form_hidden('locationbd', $this->session->userdata('dblocation'));
	} ?>

	<div class="sub-title-view">
		<?php echo form_label($this->lang->line('reports_date_range'), 'report_date_range_label'); ?>:
	</div>

	<div id='report_date_range_simple' style="padding: 0 0 0 25px">
		<input type="radio" name="report_type" id="simple_radio" value='simple' checked='checked'/>
		<?php echo form_dropdown('report_date_range_simple',$report_date_range_simple, '', 'id="report_date_range_simple"'); ?>
	</div>
	
	<div id='report_date_range_complex' style="padding: 0 0 0 25px">
		<input type="radio" name="report_type" id="complex_radio" value='complex' />
		<?php echo form_dropdown('start_month',$months, $selected_month, 'id="start_month"'); ?>
		<?php echo form_dropdown('start_day',$days, $selected_day, 'id="start_day"'); ?>
		<?php echo form_dropdown('start_year',$years, $selected_year, 'id="start_year"'); ?>
		-
		<?php echo form_dropdown('end_month',$months, $selected_month, 'id="end_month"'); ?>
		<?php echo form_dropdown('end_day',$days, $selected_day, 'id="end_day"'); ?>
		<?php echo form_dropdown('end_year',$years, $selected_year, 'id="end_year"'); ?>
	</div>

	<div class="sub-title-view">
		<?php echo form_label($this->lang->line('reports_date_range'), 'report_date_range_label'); ?>:
	</div>
	
	<div id='report_sale_type' style="padding: 0 0 0 25px">
		<?php echo form_dropdown('sale_type',array('all' => $this->lang->line('reports_all'), 'sales' => $this->lang->line('reports_sales'), 'returns' => $this->lang->line('reports_returns')), 'all', 'id="sale_type"'); ?>
	</div>
	
	<div class="sub-title-view">
		Export to Excel:
	</div>

	<div style="padding: 0 0 0 25px; font-size: 11px; font-weight: bold;">
		<input type="radio" name="export_excel" id="export_excel_yes" value='1' /> Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="export_excel" id="export_excel_no" value='0' checked='checked' /> No
	</div>

	<div>&nbsp;</div>

</div>

<a class="linkBack big_button" style="height: auto" href="#"><span>Back</span></a>
&nbsp;
<?php
	echo form_button(array(
		'name'=>'generate_report',
		'id'=>'generate_report',
		'content'=>$this->lang->line('common_submit'),
		'class'=>'big_button',
		'style'=>'height: auto;'
	));

	$this->load->view("partial/footer"); 
?>

<script type="text/javascript" language="javascript">
$(document).ready(function()
{
	$("#generate_report").click(function()
	{
		var sale_type = $("#sale_type").val();
		var export_excel = 0;
		if ($("#export_excel_yes").attr('checked')){ export_excel = 1; }
		if ($("#simple_radio").attr('checked'))
		{
			window.location = window.location+'/'+$("#report_date_range_simple option:selected").val() + '/'+sale_type+'/'+export_excel<?php if ($this->Employee->isAdmin()){ ?>+'/'+$('#locationbd').val()<?php } ?>;
		}
		else
		{
			var start_date = $("#start_year").val()+'-'+$("#start_month").val()+'-'+$('#start_day').val();
			var end_date = $("#end_year").val()+'-'+$("#end_month").val()+'-'+$('#end_day').val();
			window.location = window.location+'/'+start_date + '/'+ end_date + '/'+sale_type+'/'+ export_excel<?php if ($this->Employee->isAdmin()){ ?>+'/'+$('#locationbd').val()<?php } ?>;
		}
	});
	
	$("#start_month, #start_day, #start_year, #end_month, #end_day, #end_year").click(function()
	{
		$("#complex_radio").attr('checked', 'checked');
	});
	
	$("#report_date_range_simple").click(function()
	{
		$("#simple_radio").attr('checked', 'checked');
	});
	
});
</script>