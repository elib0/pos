<?php $this->load->view("partial/header"); ?>
<div style="text-align:center;">
	<div id="page_title" style="margin-bottom:6px;text-align:center;"><?=$title?></div>
	<div class="page_subtitle" style="margin-bottom:6px;">
	<?php
	// if (isset($error)) echo "<div class='error_message'>$error</div>";
	$order = (count($notifications['pending_orders']['data']) > 1) ? $this->lang->line('reports_orders') : $this->lang->line('reports_order');
	echo count($notifications['pending_orders']['data']).' '.$order; 
	$locationbd=$this->session->userdata('dblocation');
	?>
	</div>
</div>
<div id="table_holder">
	<table class="tablesorter report" id="sortable_table">
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<th colspan="1" width="20">+</th>
				<th colspan="1"><?php echo $this->lang->line('reports_order_id') ?></th>
				<th colspan="1"><?php echo $this->lang->line('reports_sent') ?></th>
				<th colspan="1"><?php echo $this->lang->line('reports_location') ?></th>
				<th colspan="2"><?php echo $this->lang->line('reports_comments') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if (count($notifications['pending_orders']['data'])): ?>
				<?php foreach ($notifications['pending_orders']['data'] as $order): ?>
				<tr>
					<td class="expand"><span class="small_button thickbox">+</span></td>
					<td><?php echo 'ORDE '.$order['id'];; ?></td>
					<td><?php echo $order['date'] ?></td>
					<td><?php echo ($order['location']=='default'?'Principal':$order['location']); ?></td>
					<?php if ($order['location']==$locationbd){ ?>
					<td colspan="2"><?php echo (($order['comments']) ? $order['comments'] : $this->lang->line('reports_no_comment') ); ?></td>
					<?php }else{ ?>
					<td colspan="1"><?php echo (($order['comments']) ? $order['comments'] : $this->lang->line('reports_no_comment') ); ?></td>
					<td colspan="1" style="width: 140px;">
						<?php echo anchor('orders/check_availability/'.$order['id'], $this->lang->line('orders_make_shipping'), 'class="big_button" style="padding: 7px 10px;"'); ?>
					</td>
					<?php } ?>
				</tr>
				<tr class="hide">
					<td colspan="5">
						<?php $order_details = $this->Order->get_detail($order['id']); ?>
						<table class="innertable">
							<thead>
								<tr style="color:#FFFFFF;background-color:#0a6184;">
									<th><?php echo $this->lang->line('reports_item_name') ?></th>
									<th><?php echo $this->lang->line('reports_amount_needed') ?></th>
									<?php if ($order['location']==$locationbd){ ?>
									<th><?php echo $this->lang->line('giftcards_current_quantity') ?></th>
									<?php }else{ ?>
									<th><?php echo $this->lang->line('giftcards_current_quantity').' ('.($order['location']=='default'?'Principal':$order['location']).')' ?></th>
									<th><?php echo $this->lang->line('giftcards_current_quantity').' ('.($locationbd=='default'?'Principal':$locationbd).')' ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($order_details->result() as $detail): 
								$stock=$this->Item->get_info($detail->id_item,'quantity,name');
								if ($order['location']!=$locationbd) 
									$colorbg=$stock->quantity<$detail->quantity?'class="no_stock"':'';
								else $colorbg='';
							?>
							<tr <?php echo $colorbg; ?>>
								<td><?php echo $stock->name; ?></td>
								<td><?php echo $detail->quantity ?></td>
								<?php if ($order['location']==$locationbd){ ?>
								<td><?php echo $detail->current_quantity ?></td>
								<?php }else{ ?>
								<td><?php echo $detail->current_quantity ?></td>
								<td><?php echo $stock->quantity ?></td>
								<?php } ?>
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
	var error='<?php echo (isset($error)?$error:"") ?>';
	if (error!='') 
		setTimeout(function(){
				tb_show("Error", 'index.php/reports/see_dialog_error/'+error+'/width:350/height:350');
		}, 1000);
</script>
<?php $this->load->view("partial/footer"); ?>