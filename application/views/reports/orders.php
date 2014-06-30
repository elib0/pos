<?php $this->load->view("partial/header"); ?>
<div style="text-align:center;">
	<div id="page_title" style="margin-bottom:6px;text-align:center;"><?=$title?></div>
	<div class="page_subtitle" style="margin-bottom:6px;">
	<?php
	$order = (count($notifications['pending_orders']['data']) > 1) ? $this->lang->line('reports_orders') : $this->lang->line('reports_order');
	echo count($notifications['pending_orders']['data']).' '.$order; 
	?></div>
</div>
<div id="table_holder">
	<table class="tablesorter report" id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<th colspan="1">+</th>
				<th colspan="1"><?php echo $this->lang->line('reports_order_id') ?></th>
				<th colspan="1"><?php echo $this->lang->line('reports_sent') ?></th>
				<th colspan="1"><?php echo $this->lang->line('reports_location') ?></th>
				<th colspan="1"><?php echo $this->lang->line('reports_comments') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if (count($notifications['pending_orders']['data'])): ?>
				<?php foreach ($notifications['pending_orders']['data'] as $order): ?>
				<tr>
					<td class="expand"><span class="small_button thickbox">+</span></td>
					<td><a title="<?php echo $this->lang->line('reports_processing_order') ?>" href="index.php/receivings/index/<?php echo $order['id']; ?>" title="">ORDE <?php echo $order['id'] ?></a></td>
					<td><?php echo $order['date'] ?></td>
					<td><?php echo $order['location'] ?></td>
					<td><?php echo (($order['comments']) ? $order['comments'] : $this->lang->line('reports_no_comment') ); ?></td>
				</tr>
				<tr class="hide">
					<td colspan="5">
						<?php
						$order_details = $this->Order->get_detail($order['id']);
						?>
						<table class="innertable">
							<thead>
								<tr style="color:#FFFFFF;background-color:#0a6184;">
									<th><?php echo $this->lang->line('reports_item_name') ?></th>
									<th><?php echo $this->lang->line('reports_amount_needed') ?></th>
									<th>Current Quantity</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($order_details->result() as $detail): ?>
							<tr style="background-color:#ccc;">
								<td><?php echo $this->Item->get_info($detail->id_item)->name; ?></td>
								<td><?php echo $detail->quantity ?></td>
								<td><?php echo $detail->current_quantity ?></td>
							</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</td>
				</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="5"><?php echo $this->lang->line('reports_no_have_orders'); ?></td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
</div>
<script type="text/javascript" language="javascript">
	$(".tablesorter td.expand span").click(function(event){
		$(this).text($(this).text()!='+'?'+':'-').parents('tr').next().toggle();
	});
</script>
<?php $this->load->view("partial/footer"); ?>