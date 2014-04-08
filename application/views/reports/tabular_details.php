<?php
if(!isset($export_excel)) $export_excel=0;
$hs=count($headers['summary'])+1;
$cs=ceil(7/$hs);
if($export_excel) $hs--;
?>
<div style="text-align:center;">
	<div id="page_title" style="margin-bottom:6px;"><?php echo $title ?></div>
	<div id="page_subtitle" style="margin-bottom:6px;"> <?php echo $subtitle; ?> </div>
	<div id="page_subtitle" style="margin-bottom:6px;"> <?php echo "($location)"; ?> </div>
</div>
<div id="table_holder">
	<table class="tablesorter report" <?php if($export_excel) echo 'border="1"'; ?> id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<?php if(!$export_excel) echo "<th colspan=\"$cs\">+</th>"; ?>
				<?php foreach($headers['summary'] as $header){ ?>
				<th colspan="<?php echo $cs; ?>"><?php echo $header; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($summary_data as $key=>$row){ ?>
			<tr>
				<?php if(!$export_excel) echo "<td colspan=\"$cs\" class=\"expand\">+</td>"; ?>
				<?php foreach ($row as $cell) { ?>
				<td colspan="<?php echo $cs; ?>"><?php echo $cell; ?></td>
				<?php } ?>
			</tr>
			<tr class="hide">
				<td colspan="<?php echo $cs*$hs; ?>">
				<table class="innertable">
					<thead>
						<tr style="color:#FFFFFF;background-color:#0a6184;">
							<?php foreach ($headers['details'] as $header) { ?>
							<th><?php echo $header; ?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($details_data[$key] as $row2) { ?>
							<tr style="background-color:#ccc;">
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
<div id="report_summary" style="text-align:center;">
<?php foreach($overall_summary_data as $name=>$value) { ?>
	<div class="summary_row"><?php echo $this->lang->line('reports_'.$name). ': '.to_currency($value); ?></div>
<?php }?>
</div>
<div id="location_id" style="margin: 0 auto;text-align: center;">Location:<?php echo $location; ?></div>
<?php
if(!$export_excel){
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
