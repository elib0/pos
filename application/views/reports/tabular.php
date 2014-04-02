<table class="header-table">
	<tr>
		<td><img src="images/logo.png" alt="Logo"></td>
		<td>
			<div id="receipt_header">
				<div id="page_title" style="margin-bottom:8px;"><?php echo $title ?></div>
				<div id="page_subtitle" style="margin-bottom:8px;"><?php echo $subtitle ?></div>
			</div>
		</td>
		<td></td>
	</tr>
</table>
<div id="table_holder">
	<table class="tablesorter report">
		<thead>
			<tr>
				<?php foreach ($headers as $header) { ?>
				<th><?php echo $header; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $row) { ?>
			<tr>
				<?php foreach ($row as $cell) { ?>
				<td><?php echo $cell; ?></td>
				<?php } ?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div id="report_summary">
<?php foreach($summary_data as $name=>$value) { ?>
	<div class="summary_row"><?php echo $this->lang->line('reports_'.$name). ': '.to_currency($value); ?></div>
<?php }?>
</div>
<div id="location_id" style="margin: 0 auto;text-align: center;">Location:<?=$location?></div>
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
