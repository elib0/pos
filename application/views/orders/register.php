<?php $this->load->view('partial/header'); ?>
<?php $this->load->view('flange_option',array('control'=>'orders')); ?>
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
	<?php echo form_open('orders/save/', 'id="form-order"');?>
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
				<td colspan='5'><div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('orders_no_items_in_cart'); ?></div></td>
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
							<input type="hidden" name="items[<?php echo $item['item_id']; ?>][id_item]" value="<?php echo $item['item_id']; ?>">
						</td>
						<td align="right">
							<?=$cur_item_info->quantity?>
							<input type="hidden" name="items[<?php echo $item['item_id']; ?>][current_quantity]" value="<?=$cur_item_info->quantity?>">
						</td>
						<td align="right">
							<input type="text" name="items[<?php echo $item['item_id']; ?>][quantity]" value="<?php echo $cur_item_info->reorder_level; ?>" style="width: 50px;text-align: right;">
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
	echo anchor('orders/cancel_order', $this->lang->line('orders_cancel'), 'class="big_button" style="display: inline-block; margin:10px; float: right;"');
	echo form_close(); 
	?>
</div>
</div>
<div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>
<?php $this->load->view('partial/footer'); ?>

<script type="text/javascript" language="javascript">
(function($){
	$('#cart_contents').on('click','.delete_item',function(){
			var that = this;
			var url=this.href;
			if (confirm('<?php echo $this->lang->line("orders_confirm_items"); ?>')){
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

						if ( $('#cart_contents > .sale-line').length == 0 ) {
							var tr = '<tr><td colspan="5"><div class="warning_message" style="padding:7px;"><?php echo $this->lang->line("orders_no_items_in_cart"); ?></div></td></tr>';
							$('#cart_contents').html(tr);							
						}
					}
				});
			}
			return false;
	});

	$('#item_list').select2({
		placeholder:'Product Name, Code, Category',
		minimumInputLength:1,
		ajax:{
			url:'index.php/items/suggest2',
			data:function(term,page){ return { term: term }; },
			results:function(data,page){ return { results: data };}
		}
	}).change(function(val, added, removed){
		if (val.added) {
			$('#item_list').select2('val','');
			$.ajax({
				url: 'index.php/orders/add',
				type: 'GET',
				dataType: 'json',
				data: {item: val.added.id},
				success: function(response){
					if (response.status) {
						var tr = '<tr id="'+val.added.id+'" class="sale-line">'+
							'<td><a href="index.php/orders/delete_item/'+val.added.id+'" class="small_button delete_item"><?php echo $this->lang->line("common_delete") ?></a></td>'+
							'<td>'+((val.added.item_number) ? val.added.item_number :'')+'</td>'+
							'<td style="align:center;">'+val.added.text+'</td>'+
							'<input type="hidden" name="items['+val.added.id+'][id_item]" value="'+val.added.id+'">'+
							'<td align="right">'+val.added.qty+'</td>'+
							'<td align="right"><input type="text" name="items['+val.added.id+'][quantity]" value="'+val.added.reorder_level+'" style="width: 50px;text-align: right;"></td>'+
							'</tr>';
						if ( $('#cart_contents > .sale-line').length > 0 ) {
							$('#cart_contents').prepend(tr);

						}else{
							$('#cart_contents').html(tr);							
						}
					}
				}
			});
			
		}
	});

	$('#cancel_sale_button').click(function(){
		if(confirm("<?=$this->lang->line('sales_confirm_cancel_sale')?>")){
			$('#cancel_sale_form').submit();
		}
	});

	$('#form-order').ajaxForm({
		dataType: 'json',
		success: function(response){
			console.log(response);
			var msgType = 'error';
			if (response.status) {
				msgType = 'success';
			}

			notif({
			  type: msgType,
			  msg: response.message,
			  width: "all",
			  height: 100,
			  position: "center"
			});
		}
	});
})(jQueryNew);
</script>
