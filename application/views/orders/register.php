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
	<table id="sortable_table" class="tablesorter" style="width: 100%;">
		<thead>
		<tr>
			<th width="11%"><?php echo $this->lang->line('common_delete'); ?></th>
			<th width="39%"><?php echo $this->lang->line('sales_item_number'); ?></th>
			<th width="39%"><?php echo $this->lang->line('sales_item_name'); ?></th>
			<th width="11%"><?php echo $this->lang->line('sales_quantity'); ?></th>
			<!-- <th style="width:11%;"><?php //echo $this->lang->line('sales_edit'); ?></th> -->
		</tr>
		</thead>
		<tbody id="cart_contents">
		<?php if(count($cart)==0){ ?>
			<tr>
				<td colspan='4'><div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div></td>
			</tr>
		<?php }else{
				foreach(array_reverse($cart,true) as $line=>$item){
					$cur_item_info = $this->Item->get_info($item['item_id']);
		?>
					<tr id="<?=$item['item_id']?>" class="sale-line">
						<td>
						<!-- <pre><?php print_r($cur_item_info); ?></pre> -->
						<?=anchor("sales/delete_item/$line",$this->lang->line('common_delete'),"class='small_button'")?></td>
						<td><?=$cur_item_info->item_number?></td>
						<td style="align:center;"><?=$cur_item_info->name?></td>
						<td><input type="text" name="reorder" value="<?php echo $cur_item_info->reorder_level; ?>" style="width: 50px;"></td>
					</tr>
		<?php 	}
			} ?>
		</tbody>
	</table>
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
	$('#item').autocomplete("<?=site_url('sales/item_search')?>",{
		minChars:0,
		max:100,
		selectFirst: false,
		delay:10,
		formatItem:function(row){
			return row[1];
		}
	}).blur(function(){
		$(this).attr('value',"");
	}).result(function(event,data,formatted){
		$('#add_item_form').submit();
	});

	$('#finish_sale_button').click(function(){
		var mode = '<?php echo $mode ?>';
		var dbselected = 1;
		if (mode=='shipping') {
			dbselected = document.getElementById('location').selectedIndex
		}

		if (dbselected > 0) {
			if (afterS!='0') {
				if(confirm("<?=$this->lang->line('sales_confirm_finish_sale')?>")){
					$('#finish_sale_form').submit();
				}	
			}else{ $('#finish_sale_form').submit(); }
		}else{
			// alert('You must select a database');
			notif({
				type: 'error',
				msg: "You must select a database first!",
				width: 'all',
				height: 100,
				position: 'center'
			});
		}
	});

	$('#cancel_sale_button').click(function(){
		if(confirm("<?=$this->lang->line('sales_confirm_cancel_sale')?>")){
			$('#cancel_sale_form').submit();
		}
	});
});
</script>
