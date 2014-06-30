<div id="conten-option" class="<?php echo $control; ?>">
	<ul>
		<?php $io=0; 
		if($this->Employee->has_privilege('Receivings','stock_control')){ $io++; ?>
		<li id="recvs-option"><a href="<?php echo base_url().'index.php/stock_control/goto_receiving'; ?>"><?php echo $this->lang->line('recvs_register'); ?></a></li>
		<?php }
			if($this->Employee->has_privilege('Shipping','stock_control')){ $io++;  ?>
		<li id="shipp-option"><a href="<?php echo base_url().'index.php/stock_control/goto_shipping'; ?>"><?php echo $this->lang->line('sales_shipping'); ?></a></li>
		<?php }
			if($this->Employee->has_privilege('Orders','stock_control')){ $io++; ?>
		<li id="ordrs-option"><a href="<?php echo base_url().'index.php/stock_control/goto_orders'; ?>"><?php echo $this->lang->line('orders'); ?></a></li>
		<?php } ?>
	</ul>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$('#conten-option ul li').css('width','<?php echo ($io?((100/$io)-1)."%":"0px"); ?>');
</script>