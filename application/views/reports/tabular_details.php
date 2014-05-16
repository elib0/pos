<?php
if(!isset($export_excel)) $export_excel=0;
$hs=count($headers['summary'])+1;
$cs=ceil(8/$hs);
if($export_excel) $hs--;
?>
<div style="text-align:center;">
	<div id="page_title" style="margin-bottom:6px;text-align:center;"><?=$title?></div>
	<div class="page_subtitle" style="margin-bottom:6px;"><?=$subtitle?></div>
	<div class="page_subtitle" style="margin-bottom:6px;"><?="($location)"?></div>
</div>
<div id="table_holder">
	<table class="tablesorter report" <?php if($export_excel) echo 'border="1"'; ?> id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<?=$export_excel?'':"<th colspan=\"$cs\">+</th>"?>
				<?php foreach($headers['summary'] as $header){ ?>
				<th colspan="<?=$cs?>"><?=$header?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($summary_data as $key=>$row){ ?>
			<tr>
				<?=$export_excel?'':"<td colspan=\"$cs\" class=\"expand\">+</td>"?>
				<?php foreach ($row as $cell) { ?>
				<td colspan="<?=$cs?>"><?=$cell?></td>
				<?php } ?>
			</tr>
			<tr class="hide">
				<td colspan="<?php echo $cs*$hs; ?>">
				<table class="innertable">
					<thead>
						<tr style="color:#FFFFFF;background-color:#0a6184;">
							<?php foreach ($headers['details'] as $header) { ?>
							<th><?=$header?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($details_data[$key] as $row2) { ?>
							<tr style="background-color:#ccc;">
								<?php foreach ($row2 as $cell) { ?>
								<td><?=$cell?></td>
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
<div style="text-align:center;">
	<div id="report_summary">
	<?php foreach($overall_summary_data as $name=>$value){ ?>
		<div class="summary_row"><?=$this->lang->line('reports_'.$name).': '.to_currency($value)?></div>
	<?php }?>
	</div>
	<div id="location_id" style="margin:0 auto;">Location:<?=$location?></div>
</div>
<?php
if(!isset($last)) echo '<br/><hr/><br/>';

if(!$export_excel&&isset($last)){
?>
<script type="text/javascript" language="javascript">
	$(".tablesorter td.expand").click(function(event){
		$(this).text($(this).text()!='+'?'+':'-').parent().next().toggle();
	});
</script>
<?php
}
?>
