<?php $this->load->view("partial/header"); ?>
<div id="page_title" style="margin-bottom:8px;"><?php echo $this->lang->line('recvs_register'); ?></div>
<?php if(isset($error)){	echo "<div class='error_message'>".$error."</div>"; } ?>
<div id="register_wrapper">
	<?php echo form_open("receivings/index/",array('id'=>'receivings_form')); ?>
		<label for="reception">Search Dispatching</label>
		<?php echo form_input(array('name'=>'reception','id'=>'reception','size'=>'40'));?>
		<div class="small_button" id="receivings_submit">
			<span>Load Receivings</span>
		</div>
	<?php echo form_close(); ?>
	<!-- Receiving Items List -->
	<table id="register">
		<thead>
			<tr>
				<th style="width:30%;"><?php echo $this->lang->line('recvs_item_name'); ?></th>
				<th style="width:11%;">Price</th>
				<th style="width:11%;"><?php echo $this->lang->line('recvs_quantity'); ?></th>
				<th style="width:11%;">Defective / Missing</th>
				<th style="width:15%;">Sub Total</th>
			</tr>
		</thead>
		<tbody id="cart_contents">
		<?php if(count($cart)==0){ ?>
		<tr>
			<td colspan='5'>
				<div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
			</td>
		</tr>
		<?php }else{
			foreach(array_reverse($cart, true) as $line=>$item){
				echo form_open("receivings/edit_item/$line");
		?>
		<tr>
			<td style="align:center;"><?php echo $item['name']; ?><br />
			<?php
				echo $item['description'];
	      		echo form_hidden('description',$item['description']);
			?><br/>
			</td>
			<?php if ($items_module_allowed){ ?>
			<td class="this-right">
				<?php echo $item['price'];?>
				<?php echo form_hidden(array('name'=>'price','value'=>$item['price']));?>
			</td>
			<?php }else{ ?>
			<td class="this-right"><?php echo $item['price'];
				 echo form_hidden('price',$item['price']); ?>
			</td>
			<?php } ?>
			<td>
			<?php
	        	echo $item['quantity'];
	        	echo form_hidden(array('name'=>'quantity','value'=>$item['quantity']));
			?>
			</td>
			<td><?php echo form_input(array('name'=>'discount','value'=>$item['discount'],'size'=>'3'));?></td>
			<td class="this-right" style="padding-right: 10px;"><?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
		</tr>
		</form>
			<?php
			}
		}
		?>
		</tbody>
	</table>
</div>
<!-- Overall Receiving -->
<?php if(count($cart) > 0){ ?>
<div id="overall_sale">
	<?php if(isset($supplier)){
		echo $this->lang->line("recvs_supplier").': <b>'.$supplier. '</b><br />';
		echo anchor("receivings/delete_supplier",'['.$this->lang->line('common_delete').' '.$this->lang->line('suppliers_supplier').']');
	} ?>
	<div id="finish_sale"><script src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
		<?php echo form_open("receivings/complete/$reception_id",array('id'=>'finish_sale_form')); ?>
		<br />
		<label id="comment_label" for="comment"><?php echo $this->lang->line('common_comments'); ?>:</label>
		<?php echo form_textarea(array('name'=>'comment','value'=>'','rows'=>'4','cols'=>'23'));?>
		<br /><br />
		<div id='sale_details'>
			<div class="float_left" style='width:55%;'><?php echo $this->lang->line('sales_total'); ?>:</div>
			<div class="float_left" style="width:45%;font-weight:bold;"><?php echo to_currency($total); ?></div>
		</div>
		<table width="100%">
			<tr><td></td><td>
		    	<?php echo form_hidden(array('name'=>'payment_type','value'=>'Cash')); ?>
        	</td></tr>
        	<tr><td></td><td>
				<?php echo form_hidden(array('name'=>'amount_tendered','value'=>0)); ?>
        	</td></tr>
        </table>
        <br />
		<?php echo "<div class='small_button' id='finish_sale_button' style='float:right;margin-top:5px;'><span>".$this->lang->line('recvs_complete_receiving')."</span></div>";
		?>
		</form>
	</div>
	    <?php echo form_open("receivings/cancel_receiving",array('id'=>'cancel_sale_form')); ?>
			    <div class='small_button' id='cancel_sale_button' style='float:left;margin-top:5px;'>
					<span>Reset </span>
				</div>
        </form>
</div>
<?php }	?>
<div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>
<?php $this->load->view("partial/footer"); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
    $("#item").autocomplete('<?php echo site_url("receivings/item_search"); ?>',{
    	minChars:0,
    	max:100,
       	delay:10,
       	selectFirst: false,
    	formatItem: function(row) {
			return row[1];
		}
    });
    $('#receivings_submit').click(function(event) {
    	var form = $('#receivings_form');
    	form.attr('action', form.attr('action')+'/'+$('#reception').val());
    	window.location = form.attr('action');
    	return false;
    });
    $('#reception').keypress(function(event) {
    	if (event.which == 13) {
    		 $('#receivings_submit').click();
    	}
    });
    $("#item").result(function(event, data, formatted){
		$("#add_item_form").submit();
    });
	$('#item').focus();
	$('#item').blur(function(){
    	$(this).attr('value',"<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
    });
	$('#item,#supplier').click(function(){
    	$(this).attr('value','');
    });
    $("#supplier").autocomplete('<?php echo site_url("receivings/supplier_search"); ?>',
    {
    	minChars:0,
    	delay:10,
    	max:100,
    	formatItem: function(row) {
			return row[1];
		}
    });
    $("#supplier").result(function(event, data, formatted){
		$("#select_supplier_form").submit();
    });
    $('#supplier').blur(function(){
    	$(this).attr('value',"<?php echo $this->lang->line('recvs_start_typing_supplier_name'); ?>");
    });
    $("#finish_sale_button").click(function(){
    	setTimeout(function(){
    		$('#finish_sale_form').submit();
    	},5500);
    	notif({
		  type: "info",
		  msg: '<?php echo $this->lang->line("recvs_confirm_finish_receiving"); ?>',
		  width: "all",
		  height: 100,
		  position: "center"
		});
    	// if (confirm('<?php echo $this->lang->line("recvs_confirm_finish_receiving"); ?>'))
    	// {
    	// 	$('#finish_sale_form').submit();
    	// }
    });
    $("#cancel_sale_button").click(function(){
    	setTimeout(function(){
    		$('#cancel_sale_form').submit();
    	},5500);
    	notif({
		  type: "warning",
		  msg: '<?php echo $this->lang->line("recvs_confirm_cancel_receiving"); ?>',
		  width: "all",
		  height: 100,
		  position: "center"
		});
    	// if (confirm('<?php echo $this->lang->line("recvs_confirm_cancel_receiving"); ?>'))
    	// {
    	// 	$('#cancel_sale_form').submit();
    	// }
    });
});
function post_item_form_submit(response){
	if(response.success){
		$("#item").attr("value",response.item_id);
		$("hsl(180, 43%, 77%)_item_form").submit();
	}
}
function post_person_form_submit(response){
	if(response.success){
		$("#supplier").attr("value",response.person_id);
		$("#select_supplier_form").submit();
	}
}
</script>