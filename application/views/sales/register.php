<?php $this->load->view("partial/header"); ?>
<style>
	select#customer{
		width: 100%;
	}
</style>
<div id="page_title" style="margin-bottom:8px;">
	<?php 
		if ($mode=='return') {
			echo $this->lang->line('sales_return');
		}elseif ($mode=='shipping') {
			echo $this->lang->line('sales_shipping');
		}else{
			echo $this->lang->line('sales_register');
		}
		echo ' '.$this->lang->line('register'); 
	?>
</div>
<?php
if(isset($error))
{
	echo "<div class='error_message'>".$error."</div>";
}

if (isset($warning))
{
	echo "<div class='warning_mesage'>".$warning."</div>";
}

if (isset($success))
{
	echo "<div class='success_message'>".$success."</div>";
}
?>
<div id="register_wrapper">
<?php echo form_open("sales/change_mode",array('id'=>'mode_form')); ?>
	<span><?php echo $this->lang->line('sales_mode') ?></span>
<?php echo form_dropdown('mode',$modes,$mode,'onchange="$(\'#mode_form\').submit();"'); ?>
<div id="show_suspended_sales_button">
	<?php echo anchor("sales/suspended/width:425",
	"<div class='small_button'><span style='font-size:73%;'>".$this->lang->line('sales_suspended_sales')."</span></div>",
	array('class'=>'thickbox none','title'=>$this->lang->line('sales_suspended_sales')));
	?>
</div>
</form>
<?php echo form_open("sales/add",array('id'=>'add_item_form')); ?>
<label id="item_label" for="item">

<?php
if($mode=='sale')
{
	echo $this->lang->line('sales_find_or_scan_item');
}
else
{
	echo $this->lang->line('sales_find_or_scan_item_or_receipt');
}
?>
</label>
<?php echo form_input(array('name'=>'item','id'=>'item','size'=>'40'));?>
    <div id="new_item_button_register" >
		<?php echo anchor("items/view/-1/width:360",
		"<div class='small_button'><span>".$this->lang->line('sales_new_item')."</span></div>",
		array('class'=>'thickbox none','title'=>$this->lang->line('sales_new_item')));
		?>
	</div>
    <!-- <div id="item_broken_register">
        <?php echo anchor("items/view/-1/width:360",
        "<div class='small_button'><span>Item Broked</span></div>",
        array('class'=>'thickbox none','title'=>'Item Broken'));
        ?>
    </div> -->

</form>
<div id="registerDiv">
<table id="register">
<thead>
<tr>
<th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>
<th style="width:32%;"><?php echo $this->lang->line('sales_item_number'); ?></th>
<th style="width:33%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
<th style="width:13%;"><?php echo $this->lang->line('sales_price'); ?></th>
<th style="width:11%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
<th style="width:11%;"><?php echo $this->lang->line('sales_discount'); ?></th>
<th style="width:20%;">Sub Total</th>
<!-- <th style="width:11%;"><?php //echo $this->lang->line('sales_edit'); ?></th> -->
</tr>
</thead>
<tbody id="cart_contents">
<?php
if(count($cart)==0)
{
?>
<tr><td colspan='8'>
<div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
</tr></tr>
<?php
}
else
{
	foreach(array_reverse($cart, true) as $line=>$item)
	{
		$cur_item_info = $this->Item->get_info($item['item_id']);
		echo form_open( "sales/edit_item/$line", array('id'=>'edit_item'.$item['item_id']) );
	?>
		<tr id="<?php echo $item['item_id']; ?>" class="sale-line">
		<td><?php echo anchor("sales/delete_item/$line",$this->lang->line('common_delete'),"class='small_button'");?></td>
		<td><?php echo $item['item_number']; ?></td>
		<td style="align:center; "><?php echo $item['name']; ?><br /><small> [<?php echo $cur_item_info->quantity; ?> in stock]</small></td>



		<?php if ($items_module_allowed)
		{
		?>
			<td><?php echo form_input(array('name'=>'price','value'=>$item['price'],'size'=>'6','class'=>'edit-item text_box','ref'=>$item['item_id']));?></td>
		<?php
		}
		else
		{
		?>
			<td><?php echo $item['price']; ?></td>
			<?php echo form_hidden('price',$item['price']); ?>
		<?php
		}
		?>

		<td>
		<?php
        	if($item['is_serialized']==1):?>
        		<?php echo $item['quantity']; ?>
        		<?php echo form_hidden('quantity',$item['quantity']); ?>
        	<?php else: ?>
        		<select name="quantity" class="select-edit-item" ref="<?php echo $item['item_id']; ?>">
	            <?php 
	            for ($i=0; $i < $item['quantity_total']; $i++) {
	                $j = $i+1; 
	                $selected = ($j == $item['quantity']) ? ' selected' : '';
	                echo '<option value="'.$j.'"'.$selected.'>'.$j.'</option>';
	            }
	            ?>
            	</select>
        	<?php endif; ?>
        	<?php //echo form_input(array('name'=>'quantity','value'=>$item['quantity'],'size'=>'2')); ?>
		</td>

		<td><?php echo form_input(array('name'=>'discount','value'=>$item['discount'],'size'=>'3', 'class'=>'edit-item text_box','ref'=>$item['item_id']));?></td>
		<td class="sub-total"><?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
		<!-- <td>
            <?php //echo form_submit("edit_item", $this->lang->line('sales_edit_item'));?>
            <?php //echo form_button( array('value'=>$item['item_id'],'name'=>'item_broken','class'=>'item-broken','content'=>'Report Item') ); ?>
        </td> -->
		</tr>
		<!-- <tr>
		<td style="color:#2F4F4F";><?php echo $this->lang->line('sales_description_abbrv').':>';?></td>
		<td colspan=2 style="text-align:left;">

		<?php
        	if($item['allow_alt_description']==1)
        	{
        		echo form_input(array('name'=>'description','value'=>$item['description'],'size'=>'20'));
        	}
        	else
        	{
				if ($item['description']!='')
				{
					echo $item['description'];
        			echo form_hidden('description',$item['description']);
        		}
        		else
        		{
        			echo 'None';
        			echo form_hidden('description','');
        		}
        	}
		?>
		</td>
		<td>&nbsp;</td>
		<td style="color:#2F4F4F";>
		<?php
        	if($item['is_serialized']==1)
        	{
				echo $this->lang->line('sales_serial').'::';
			}
		?>
		</td>
		<td colspan=3 style="text-align:left;">
		<?php
        	if($item['is_serialized']==1)
        	{
        		echo form_input(array('name'=>'serialnumber','value'=>$item['serialnumber'],'size'=>'20'));
			}
			else
			{
				echo form_hidden('serialnumber', '');
			}
		?>
		</td>


		</tr> -->
		<tr style="height:3px">
		<td colspan=8 style="background-color:white"> </td>
		</tr>
		</form>
	<?php
	}
}
?>
</tbody>
</table>
</div>
</div>

<div id="overall_sale">

		
		<?php
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0)
		{
		?>
			<div >
				<div class='small_button' id='suspend_sale_button' ><span><?php echo $this->lang->line('sales_suspend_sale'); ?></span></div>
				<div class='small_button' id='cancel_sale_button' ><span><?php echo $this->lang->line('sales_cancel_sale'); ?></span></div>
			</div>
			
		<?php
		}

	
	echo '<div style="margin-top:5px;text-align:center;">';
	echo form_open("sales/select_employee",array('id'=>'select_employee_form'));
	echo '<label id="customer_label" for="employee">'.$this->lang->line('sales_select_employee').'</label>';
	echo form_input(array('name'=>'employee','id'=>'employee','class'=>'text_box','size'=>'30', 'value'=>$employee));
	echo form_close();
	if ($mode=='sale' || $mode=='return'){
		if (isset($customer)) {
			echo $this->lang->line("sales_customer").': <b>'.$customer. '</b><br />';
			echo anchor("sales/remove_customer",'['.$this->lang->line('common_remove').' '.$this->lang->line('customers_customer').']');
		}else{
			echo form_open("sales/select_customer",array('id'=>'select_customer_form'));
			echo '<label id="customer_label" for="customer">'.$this->lang->line('sales_select_customer').'</label>';
			
			echo form_input(array('name'=>'customer','id'=>'customer','size'=>'30', 'class'=>'text_box', 'value'=>$this->lang->line('sales_start_typing_customer_name')));
			
			//echo '<div style="margin-top:5px;text-align:center;">';
			//echo '<h3 style="margin: 5px 0 5px 0">'.$this->lang->line('common_or').'</h3>';
			echo anchor("customers/view/-1/width:350",
			"<div class='small_button' style='margin:0 auto;'><span>+</span></div>",
			array('class'=>'thickbox none','title'=>$this->lang->line('sales_new_customer')));
			//echo '<div class="clearfix">&nbsp;</div>';
			echo form_close();
		}
	}else{
		include('application/config/database.php'); //Incluyo donde estaran todas las config de las databses
		$dbs = array('...'=>'...');
		foreach ($db as $key => $value){
			if ( $key != $this->session->userdata('dblocation') ) {
				$dbs[$key] = ucwords($key);
			}
		}
		echo form_open("sales/select_location",array('id'=>'select_customer_form'));
		echo form_label('Receiving Location:', 'location', array('id'=>'customer_label'));
		echo form_dropdown('location', $dbs, $this->sale_lib->get_customer(), 'id="location"');
		echo form_close();
	}
	?>

	<div id='sale_details' >
		<div class="sales_sub_total" ><?php echo $this->lang->line('sales_sub_total'); ?>: <div ><?php echo to_currency($subtotal); ?></div></div>
		
		
		<!-- combro de inpuestos opcional -->
		<div class="taxing" >Taxing:<div ><input id="taxing" type="checkbox" name="taxing" <?php echo $taxing; ?>></div></div>
		
		<!-- FIN combro de inpuestos opcional -->

		
		<?php foreach($taxes as $name=>$value) { ?>
		<div class="taxing taxing-block" ><?php echo $name; ?>: <div ><?php echo to_currency($value); ?></div></div>
		
		<?php }; ?>
		

		<div class=" total" ><?php echo $this->lang->line('sales_total'); ?>:<div ><?php echo to_currency($total); ?></div></div>
		
	</div>


	<?php
	// Only show this part if there are Items already in the sale.
	if(count($cart) > 0)
	{
	?>
		
    	<div id="Cancel_sale">
		<?php echo form_open("sales/cancel_sale",array('id'=>'cancel_sale_form')); ?>
		
    	</form>
    	</div>
		<div class="clearfix" style="margin-bottom:1px;">&nbsp;</div>
		<?php
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0)
		{
		?>
			<div id="finish_sale">
				<?php echo form_open("sales/complete",array('id'=>'finish_sale_form')); ?>
				<!-- <label id="comment_label" for="comment"><?php echo $this->lang->line('common_comments'); ?>:</label> -->
				<?php //echo form_textarea(array('name'=>'comment', 'id' => 'comment', 'value'=>$comment,'rows'=>'4','cols'=>'23'));?>
				<!-- <br /><br /> -->

				<?php

				if(!empty($customer_email))
				{
					echo $this->lang->line('sales_email_receipt'). ': '. form_checkbox(array(
					    'name'        => 'email_receipt',
					    'id'          => 'email_receipt',
					    'value'       => '1',
					    'checked'     => (boolean)$email_receipt,
					    )).'<br />('.$customer_email.')<br />';
				}

				if ($payments_cover_total)
				{
					echo "<div class='big_button' id='finish_sale_button'><span>".$this->lang->line('sales_complete_sale')."</span></div>";
				}
				?>
			</div>
			</form>
		<?php
		}
		?>
	<div class="payments_">
	    <div class="payments_total">Payments Total: <div><?=to_currency($payments_total); ?></div></div>
	    <div class="amount_due">Amount Due: <div><?=to_currency($amount_due); ?></div></div>
    </div>


	<div id="Payment_Types" >

		<div style="height:100px;">

			<?php echo form_open("sales/add_payment",array('id'=>'add_payment_form')); ?>
			<table width="100%">
			<tr>
			<td>
				<?php echo $this->lang->line('sales_payment').':   ';?>
			</td>
			<td>
				<?php echo form_dropdown( 'payment_type', $payment_options, array(), 'id="payment_types"' ); ?>
			</td>
			</tr>
			<tr>
			<td colspan="2">
		<!-- 		<span id="amount_tendered_label"><?php echo $this->lang->line( 'sales_amount_tendered' ).': '; ?></span>
			</td>
			<td> -->
				<?=form_input( array( 'name'=>'amount_tendered', 'id'=>'amount_tendered','class'=>'text_box', 'value'=>to_currency_no_money($amount_due) ) );?>
			</td>
			</tr>
        	</table>
			<div class='big_button' id='add_payment_button' style='float:left;margin:5px 0 0 35px;'>
				<span><?php echo $this->lang->line('sales_add_payment'); ?></span>
			</div>
		</div>
		</form>

		<?php
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0)
		{
		?>
	    	<table id="register">
	    	<thead>
			<tr>
			<th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>
			<th style="width:60%;"><?php echo 'Type'; ?></th>
			<th style="width:18%;"><?php echo 'Amount'; ?></th>


			</tr>
			</thead>
			<tbody id="payment_contents" >
			<?php
				foreach($payments as $payment_id=>$payment)
				{
				echo form_open("sales/edit_payment/$payment_id",array('id'=>'edit_payment_form'.$payment_id));
				?>
	            <tr>
	            <td><?php echo anchor( "sales/delete_payment/$payment_id", $this->lang->line('common_delete'),"class='small_button'" ); ?></td>

							<td><?php echo $payment['payment_type']; ?></td>
							<td style="text-align:right;"><?php echo to_currency( $payment['payment_amount'] ); ?></td>

				</tr>
				</form>
				<?php
				}
				?>
			</tbody>
			</table>
		    <br />
		<?php
		}
		?>

	</div>

	<?php
	}
	?>
</div>
<div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>


<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript" language="javascript">
$(document).ready(function()
{
    $('.item-broken').click(function(){
        var opt = window.confirm('Report a damaged item! Are you sure?');

        if(opt){
            var itemId = $(this).val();
            $.ajax({
                url: 'index.php/items/report_item_broken/'+itemId,
                type: 'POST',
                success: function (data) {
                    window.location.reload();
                }
            });
        }

    });

    //Para el cobro de taxes
    var b = '<?php echo $taxing ?>';
    if (b !== 'checked') {$('.taxing-block').hide();}
    $('#taxing').click(function(event) {
    	var cb = this;
    	var value = 1;

    	if ($(cb).is(':checked')) {
    		$('.taxing-block').show();	
    	}else{
			$('.taxing-block').hide();
			value = 0;	    		
    	}

    	$.get('index.php/sales/set_taxing', {taxing: value}, function(data) {
			set_amounts();
		});
    	
    });

    $('.select-edit-item').change(function(event) {
    	var ref = $(this).attr('ref');
		$('#edit_item'+ref).ajaxSubmit({
			success:function(response)
			{
				set_amounts(ref);
			}
		});
    });

    $('.edit-item').blur(function(event) {
    	var ref = $(this).attr('ref');
		
		$('#edit_item'+ref).ajaxSubmit({
			success:function(response)
			{
				set_amounts(ref);
			}
		});
    });

	$(function() {
		$("#employee").autocomplete('index.php/employees/suggest/1',
			{
				max:100,
				delay:10,
				selectFirst: false,
				formatItem: function(row) {
					console.log(row);
					return row[1];
				}
			}
		);

		$("#employee").result(function(event, data, formatted){
			$("#select_employee_form").submit();
		});
	});

    $("#item").autocomplete('<?php echo site_url("sales/item_search"); ?>',
    {
    	minChars:0,
    	max:100,
    	selectFirst: false,
       	delay:10,
    	formatItem: function(row) {
			return row[1];
		}
    });

    $("#item").result(function(event, data, formatted)
    {
		$("#add_item_form").submit();
    });

	$('#item').focus();

	$('#item').blur(function()
    {
    	$(this).attr('value',"<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
    });

	$('#item,#customer').click(function()
    {
    	$(this).attr('value','');
    });

    $("#customer").autocomplete('<?php echo site_url("sales/customer_search"); ?>',
    {
    	minChars:0,
    	delay:10,
    	max:100,
    	formatItem: function(row) {
			return row[1];
		}
    });

    //Envia formulario de customer idependientemente del formato de customer
    $('#location').change(function(event) {
    	if ( $(this).val() != '...') {
    		// $("#select_customer_form").submit();
    		$("#select_customer_form").ajaxSubmit();
    	};
    });

    $("#customer").result(function(event, data, formatted)
    {
		$("#select_customer_form").submit();
    });

    $('#customer').blur(function()
    {
    	$(this).attr('value',"<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
    });

	$('#comment').change(function()
	{
		$.post('<?php echo site_url("sales/set_comment");?>', {comment: $('#comment').val()});
	});

	$('#email_receipt').change(function()
	{
		$.post('<?php echo site_url("sales/set_email_receipt");?>', {email_receipt: $('#email_receipt').is(':checked') ? '1' : '0'});
	});


    $("#finish_sale_button").click(function()
    {
    	var mode = '<?php echo $mode ?>';
    	var dbselected = 1;

    	if (mode=='shipping') {
    		dbselected = document.getElementById('location').selectedIndex
    	}

    	if (dbselected > 0) {
			if (confirm('<?php echo $this->lang->line("sales_confirm_finish_sale"); ?>'))
			{
				$('#finish_sale_form').submit();
			}
		}else{
			// alert('You must select a database');
			notif({
				type: "error",
				msg: "You must select a database first!",
				width: "all",
				height: 100,
				position: "center"
			});
		}
    });

	$("#suspend_sale_button").click(function()
	{
		if (confirm('<?php echo $this->lang->line("sales_confirm_suspend_sale"); ?>'))
    	{
			$('#finish_sale_form').attr('action', '<?php echo site_url("sales/suspend"); ?>');
    		$('#finish_sale_form').submit();
    	}
	});

    $("#cancel_sale_button").click(function()
    {
    	if (confirm('<?php echo $this->lang->line("sales_confirm_cancel_sale"); ?>'))
    	{
    		$('#cancel_sale_form').submit();
    	}
    });

	$("#add_payment_button").click(function()
	{
	   
	   		$('#add_payment_form').submit();	
	   
    });
	
	$('#add_payment_form').submit(function(){
	   			if($('#amount_tendered').val()==''||$('#amount_tendered').val()==0)$('#amount_tendered').val('O');
	});	


	$("#payment_types").change(checkPaymentTypeGiftcard).ready(checkPaymentTypeGiftcard)
});

function set_amounts(line){
	line = line || false;
	$.ajax({
		url: 'index.php/sales/get_ajax_sale_details',
		dataType: 'json',
		success: function(data){
			var taxes = new Array();
			var price = $('tr#'+line+' input[name=price]').val();
 			var quantity = $('tr#'+line+' select').val();
			var discount = $('tr#'+line+' input[name=discount]').val();
			
			$('#amount_tendered').val(data.due);
			$('#amount-due').html(data.due).formatCurrency();
			$('.general-total').html(data.total).formatCurrency();
			$('#general-sub-total').html(data.subtotal).formatCurrency();

			if(line){
				$('tr#'+line+' td.sub-total').html(price*quantity-price*quantity*discount/100).formatCurrency();

				for (var key in data.taxes){
					taxes.push(data.taxes[key]);
				}

				$('.taxes').each(function(index, el) {
					$(this).html(taxes[index]).formatCurrency();					
				});
			}
			
		}
	});
}

function post_item_form_submit(response)
{
	if(response.success)
	{
		$("#item").attr("value",response.item_id);
		$("#add_item_form").submit();
	}
}

function post_person_form_submit(response)
{
	if(response.success)
	{
		$("#customer").attr("value",response.person_id);
		$("#select_customer_form").submit();
	}
}

function checkPaymentTypeGiftcard()
{
	if ($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>")
	{
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
		$("#amount_tendered").val('');
		$("#amount_tendered").focus();
	}
	else
	{
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
	}
}

</script>
