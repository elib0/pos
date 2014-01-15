<?php
$this->load->view("partial/header");
?>
<style>
	#search{
		width: 60%;
	}
	.td-info{
		text-align: center;
		font-size: 24px;
		font-weight: bold;
	}
	.location-option, .delete-options{
		display: inline-block;
		margin: 5px 0;
	}
	.delete-options{
		float: right;
	}
</style>
<div id="page_title" style="margin-bottom:8px;"><?php echo $title ?></div>
<div id="page_subtitle" style="margin-bottom:8px;"><?php echo $subtitle ?></div>
<?php echo form_open(site_url("$controller_name/search"),array('id'=>'search_form', 'method'=>'GET')); ?>
	<label for="search">Search Item</label>
	<input type="text" name ='search' id='search' placeholder="Search Item by Name"/>
<?php echo form_close() ?>
<?=form_open(site_url("$controller_name/save_dispatch"), array('id'=>'frmShareIvn', 'method'=>'GET'))?>
	<?php
	include('application/config/database.php'); //Incluyo donde estaran todas las config de las databses
	$dbs = array('...'=>'...');
	foreach ($db as $key => $value){
		$dbs[$key] = ucwords($key);
	}
	$options = 'id="dbselected"';
	?>
	<div class="location-option">
	<?php echo form_label('Location:', 'dbselected'); ?>
	<?php echo form_dropdown('dbselected', $dbs, '...', $options); ?>
	<h6 class="wire" style="display:inline-block">(This option to send to another location and are deducted in this store!)</h6>
	</div>
	<div class="delete-options">
		<a href="#" id="selectall">Select All</a>|
		<a href="#" id="deselectall">Deselect All</a>
	</div>
	<div class="products-to-send">
		<table class="tablesorter report share-inventorie-report" id="sortable_table">
	        <thead>
	            <tr>
	                <?php foreach ($headers as $header) { ?>
	                <th><?php echo $header; ?></th>
	                <?php } ?>
	            </tr>
	        </thead>
	        <tbody>
	            <tr>
	            	<td colspan="5" class="td-info">Add products to pass from the search box</td>
	            </tr>
	        </tbody>
	    </table>
	    <a class="linkPrint" href="#" id="btnSubmit">
	        <div class="big_button" style="float: left;"><span>Send</span></div>
	    </a>
	</div>
<?=form_close()?>
<?php
$this->load->view("partial/footer");
?>
<script>
	enable_search_form('<?php echo site_url("$controller_name/suggest")?>','<?php echo $this->lang->line("common_confirm_search")?>', false);
	
	$$('.cb').each(function(index, el) {
		var id = this.id;
		if ($$(this).is(':not:checked')) {
			$$('#amount'+id).attr('disabled', 'disabled');
		}else{
			$$('#amount'+id).attr('disabled', 'false');
		}

	});

	$$('#btnSubmit').click(function(){
		var dbselected = document.getElementById('dbselected').selectedIndex;
		// console.log('Base de datos seleccionada'+dbselected);
		if (dbselected > 0) {
			var items = $$('tbody tr input').length;
			if (items > 0) {
				// $$('#frmShareIvn').submit();	
				var form = $$('#frmShareIvn');
				console.log(form.attr('action'));console.log(form.attr('method'));console.log(form.serialize());
				$$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success: function(data){
						if (data.id) {
							alert(data.msg);
							window.location = 'index.php/share_inventories/dispatch_details/'+data.id;
						};
					}
				});
			}else{
				alert('You must have at least one item to transfer!');	
			}
		}else{
			alert('You must select a database');
		}

		return false;
	});
	$$('#sortable_table tbody').on('click','input.cb',function(){
		// if (!$$(this).is(':checked')) {
		// 	$$(this).parents('tr').remove();		
		// }
		// var items = $$('#sortable_table tbody tr').length;
		// if(items<=0){
		// 	$$('#sortable_table tbody').html('<tr><td colspan="5" class="td-info">Please serach a item to add</td></tr>');
		// }
	});
	$$('#selectall').click(function(){
		$('.cb').attr('checked','checked');
		return false
	});
	$$('#deselectall').click(function(){
		$('.cb').removeAttr('checked');
		return false
	});
</script>