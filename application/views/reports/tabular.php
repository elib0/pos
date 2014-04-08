<?php $cs=count($headers)<8?ceil(8/count($headers)):1; ?>
<table class="header-table">
	<tr>
		<td colspan="4" style="height:121px;"><img src="<?php echo base_url(); ?>images/logo.png" alt="Logo"></td>
		<td colspan="2" style="text-align:center;">
			<div id="receipt_header">
				<div id="page_title" style="margin-bottom:6px;"><?php echo $title ?></div>
				<div id="page_subtitle" style="margin-bottom:6px;"><?php echo $subtitle; ?></div>
				<div id="page_subtitle" style="margin-bottom:6px;"><?php echo "($location)"; ?></div>
			</div>
		</td>
	</tr>
</table>
<?php if($export_excel){ ?><br/><?php } ?>
<div id="table_holder">
	<table class="tablesorter report" <?php if($export_excel) echo 'border="1"'; ?>>
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<?php foreach ($headers as $header) { ?>
				<th colspan="<?php echo $cs; ?>"><?php echo $header; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $row) { ?>
			<tr>
				<?php foreach ($row as $cell) { ?>
				<td colspan="<?php echo $cs; ?>" style="<?php if($export_excel) echo 'text-align:center;'; ?>"><?php echo $cell; ?></td>
				<?php } ?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php if($export_excel){ ?><br/><?php } ?>
<table style="width:100%;"><tr><td colspan="<?php echo $cs*count($headers); ?>" style="text-align:center;">
<div id="report_summary">
<?php foreach($summary_data as $name=>$value) { ?>
	<div class="summary_row" style="text-align:center;"><?php echo $this->lang->line('reports_'.$name). ': '.to_currency($value); ?></div>
<?php }?>
</div>
<div id="location_id" style="margin: 0 auto;text-align: center;">Location:<?=$location?></div>
</td></tr></table>
<?php
if(!$export_excel){
?>
<?php
	if(isset($last)){
?>
<script type="text/javascript" language="javascript">
	$('.tablesorter').each(function(){
		if($(this).find('tr').length >1) $(this).tablesorter();
	});
</script>
<?php
	}else{
		echo '<br/><hr/><br/>';
	}
}
?>
