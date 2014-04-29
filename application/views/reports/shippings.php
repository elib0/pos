<?php $this->load->view("partial/header"); ?>
<div style="text-align:center;">
	<div id="page_title" style="margin-bottom:6px;text-align:center;"><?=$title?></div>
	<div id="page_subtitle" style="margin-bottom:6px;">
	<?php
	$order = (count($notifications['shippings']['data']) > 1) ? $this->lang->line('reports_orders') : $this->lang->line('reports_order');
	echo $this->lang->line('reports_you_have').' '.count($notifications['shippings']['data']).' '.$order; 
	?></div>
	<!-- <div id="page_subtitle" style="margin-bottom:6px;"><?="($location)"?></div> -->
</div>
<div id="table_holder">
	<table class="tablesorter report" id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<th colspan="1">+</th>
				<th colspan="1"><?php echo $this->lang->line('reports_sale_id') ?></th>
				<th colspan="1"><?php echo $this->lang->line('reports_sent') ?></th>
				<!-- <th colspan="1">Items Sellers</th> -->
				<th colspan="1"><?php echo $this->lang->line('reports_sender_from') ?></th>
				<!-- <th colspan="1">Total</th> -->
				<!-- <th colspan="1">Payment Type</th> -->
				<th colspan="1"><?php echo $this->lang->line('reports_comments') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if (count($notifications['shippings']['data'])): ?>
				<?php foreach ($notifications['shippings']['data'] as $transaction): ?>
				<tr>
					<td class="expand"><span class="small_button thickbox">+</span></td>
					<td><a title="Click para recibir el orden" href="index.php/receivings/index/<?php echo $transaction['transfer_id']; ?>" title="">TRAN <?php echo $transaction['transfer_id'] ?></a></td>
					<td><?php echo $transaction['date'] ?></td>
					<td><?php echo $transaction['sender'] ?></td>
					<td><?php echo $transaction['comment'] ?></td>
				</tr>
				<tr class="hide">
					<td colspan="5">
						<?php
						$transaction_details = $this->Transfers->get_my_reception_detail($transaction['transfer_id']);
						?>
						<table class="innertable">
							<thead>
								<tr style="color:#FFFFFF;background-color:#0a6184;">
									<th><?php echo $this->lang->line('reports_item_name') ?></th>
									<th><?php echo $this->lang->line('reports_serial_number') ?></th>
									<th><?php echo $this->lang->line('reports_quantity_purchased') ?></th>
									<th><?php echo $this->lang->line('items_cost_price') ?></th>
									<th><?php echo $this->lang->line('items_unit_price') ?></th>
									<th><?php echo $this->lang->line('reports_discount_percent') ?></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($transaction_details->result() as $detail): ?>
							<tr style="background-color:#ccc;">
								<td><?php echo $detail->item_id ?></td>
								<td><?php echo $detail->serialnumber ?></td>
								<td><?php echo $detail->quantity_purchased ?></td>
								<td><?php echo $detail->item_cost_price ?></td>
								<td><?php echo $detail->item_unit_price ?></td>
								<td><?php echo $detail->discount_percent ?></td>
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