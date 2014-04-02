<table class="header-table">
	<tr>
		<td><img src="images/logo.png" alt="Logo"></td>
		<td>
			<div id="receipt_header">
				<div id="page_title" style="margin-bottom:8px;"><?php echo $title; ?></div>
				<div id="page_subtitle" style="margin-bottom:8px;"><?php echo $subtitle; ?></div>
			</div>
		</td>
		<td></td>
	</tr>
</table>
<div style="text-align: center;">

<script type="text/javascript">
swfobject.embedSWF(
"<?php echo base_url(); ?>open-flash-chart.swf", "chart<?php echo $location; ?>",
"100%", "100%", "9.0.0", "expressInstall.swf",
{"data-file":"<?php echo $data_file; ?>"} )
</script>
<?php
?>
</div>
<div id="chart_wrapper">
	<div id="chart<?php echo $location; ?>"></div>
</div>
<div id="report_summary">
<?php foreach($summary_data as $name=>$value) { ?>
	<div class="summary_row"><?php echo $this->lang->line('reports_'.$name).': '.to_currency($value); ?></div>
<?php }?>
</div>
<div id="location_id" style="margin:0 auto;text-align:center;">Location:<?=$location?></div>
