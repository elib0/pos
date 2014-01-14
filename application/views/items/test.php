<?php
$this->load->view("partial/header");
?>
<link rel="stylesheet" href="css/compare_stock.css" media="print">
<div id="page_title" style="margin-bottom:8px;"><?php echo $title ?></div>
<div id="page_subtitle" style="margin-bottom:8px;">
    <?php echo $subtitle ?><br>
    <?php echo '<img src="'.site_url().'/barcode?barcode='.$barcode.'&text='.$barcodetext.'&width=256" />';  ?>
</div>
<div class="product-shipped-report">
	<table class="tablesorter report compare-stock" id="sortable_table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Previous Amount</th>
                <th>New Amount</th>
                <th>Deduction</th>
            </tr>
        </thead>
        <tbody>

        <?php for ($i=0;$i<count($items_info);$i++): ?>
        	<tr>
        		<td><?php echo $items_info[$i]->item_id; ?></td>
        		<td><?php echo $items_info[$i]->name; ?></td>
        		<td><?php echo $items_info[$i]->quantity; ?></td>
        		<td><?php echo $items_info[$i]->quantity-$form[$i]['amount']; ?></td>
        		<td><?php echo $form[$i]['amount']; ?></td>
        	</tr>
        <?php endfor; ?>
        </tbody>
	</table>
</div>
<a class="linkPrint" href="#">
    <div class="big_button" style="float: left;"><span>Print</span></div>
</a>
<?php
$this->load->view("partial/footer");
?>
<script>
	$('.linkPrint').click(function(){
        window.print();
        return false;
    });
</script>