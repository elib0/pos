<?php $this->load->view('partial/header'); ?>
<div id="page_title" style="margin-bottom:8px;"> <?php echo $this->lang->line('register'); ?> </div>
<?php
	if(isset($error)){	echo "<div class='error_message'>$error</div>"; }
	if (isset($warning)){	echo "<div class='warning_mesage'>$warning</div>"; }
	if (isset($success)){	echo "<div class='success_message'>$success</div>"; } 
?>
<div id="table_action_header" style="background: none;padding-left: 15px;width: 98%;">
	<label id="item_label" for="item">
		<?php echo $this->lang->line('sales_find_or_scan_item'); ?>
	</label>
	<input type="text" id="item_list" name="item_list" value="" style="width:500px;">
	<!-- <div id="new_item_button_register" >
		<?php echo anchor('items/view/-1/width:360','<span>'.$this->lang->line('sales_new_item').'</span>',array('class'=>'small_button thickbox','title'=>$this->lang->line('sales_new_item')));
		?>
	</div> -->
</div>
<div id="table_holder">
	<?php echo form_open('orders/save/');?>
	<table id="sortable_table" class="tablesorter" style="width: 100%;">
		<thead>
			<tr>
				<th width="11%"><?php echo $this->lang->line('common_delete'); ?></th>
				<th width="28%"><?php echo $this->lang->line('sales_item_number'); ?></th>
				<th width="35%"><?php echo $this->lang->line('sales_item_name'); ?></th>
				<th width="10%" align="right"><?php echo $this->lang->line('sales_quantity'); ?></th>
				<th width="18%"><?php echo $this->lang->line('items_reorder_level'); ?></th>
				<!-- <th style="width:11%;"><?php //echo $this->lang->line('sales_edit'); ?></th> -->
			</tr>
		</thead>
		<tbody id="cart_contents">
		<?php if(count($cart)==0){ ?>
			<tr>
				<td colspan='4'><div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('orders_no_items_in_cart'); ?></div></td>
			</tr>
		<?php }else{ 
				foreach(array_reverse($cart,true) as $line=>$item){
					$cur_item_info = $this->Item->get_info($item['item_id']);
		?>
					<tr id="<?=$item['item_id']?>" class="sale-line">
						<td>
							<?php echo anchor("orders/delete_item/".$item['item_id'],$this->lang->line('common_delete'),"class='small_button delete_item'")?></td>
						<td><?=$cur_item_info->item_number?></td>
						<td style="align:center;">
							<?=$cur_item_info->name?>
							<input type="hidden" name="items[<?php echo $item['item_id']; ?>][id]" value="<?php echo $item['item_id']; ?>">
						</td>
						<td><?=$cur_item_info->quantity?></td>
						<td>
							<input type="text" name="items[<?php echo $item['item_id']; ?>][quantity]" value="<?php echo $cur_item_info->reorder_level; ?>" style="width: 50px;">
						</td>
					</tr>
		<?php 	}
			} ?>
		</tbody>
	</table>
	<?php 
	echo form_submit(
				array(
					'name'=>'sendto',
					'id'=>'sendto',
					'value'=>$this->lang->line('reports_send_administrator'),
					'class'=>'big_button',
					'style'=>'display: inline-block; margin:10px; float: right;'
				));
	echo form_close(); 
	?>
</div>
</div>
<div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>
<?php $this->load->view('partial/footer'); ?>

<script type="text/javascript" language="javascript">
(function($){
	$(function(){
	
	});
})(jQueryNew);
$(function(){
	$('.delete_item').click(function(){
			var that = this;
			var url=this.href;
			if (confirm('estas seguro?')){
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'json',
					success: function(response){
						if (response.status) {
							$(that).parents('tr').fadeOut('slow', function() {
								$(this).remove();
							});
						}
					}
				});
			}
			return false;
	});

	$('#cancel_sale_button').click(function(){
		if(confirm("<?=$this->lang->line('sales_confirm_cancel_sale')?>")){
			$('#cancel_sale_form').submit();
		}
	});
});
</script>
