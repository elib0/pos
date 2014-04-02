<?php
if(!isset($export_excel)) $export_excel=0;
?>
<div id="page_title" style="margin-bottom:8px;"><?php echo $title ?></div>
<div id="page_subtitle" style="margin-bottom:8px;"><?php echo $subtitle ?></div>
<div id="table_holder">
	<table class="tablesorter report" id="sortable_table">
		<thead>
			<tr>
				<th>+</th>
				<?php foreach ($headers['summary'] as $header) { ?>
				<th><?php echo $header; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($summary_data as $key=>$row) { ?>
			<tr>
				<td class="expand">+</td>
				<?php foreach ($row as $cell) { ?>
				<td><?php echo $cell; ?></td>
				<?php } ?>
			</tr>
			<tr class="hide">
				<td colspan="100">
				<table class="innertable">
					<thead>
						<tr>
							<?php foreach ($headers['details'] as $header) { ?>
							<th><?php echo $header; ?></th>
							<?php } ?>
						</tr>
					</thead>
				
					<tbody>
						<?php foreach ($details_data[$key] as $row2) { ?>
						
							<tr>
								<?php foreach ($row2 as $cell) { ?>
								<td><?php echo $cell; ?></td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div id="report_summary">
<?php foreach($overall_summary_data as $name=>$value) { ?>
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
	$(".tablesorter a.expand").click(function(event)
	{
		$(this).parent().parent().next().find('.innertable').toggle();
		
		if ($(this).text() == '+')
		{
			$(this).text('-');
		}
		else
		{
			$(this).text('+');
		}
		return false;
	});
	$(".tablesorter td.expand").click(function(event){
		$(this).text($(this).text()!='+'?'+':'-').parent().next().toggle();
	});
</script>
<?php
	}else{
		echo '<br/><hr/><br/>';
	}
}
?>
