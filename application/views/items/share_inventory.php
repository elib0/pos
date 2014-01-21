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

	#frmShareIvn input{margin: 5px;}
    #frmShareIvn input[type=text] {width: 90%;}
    #frmShareIvn input[type=checkbox] {display: none;}
    #frmShareIvn input[type=checkbox] + label {
        background: #fff;
        display: inline-block;
        width: 16px;
        height: 16px;
        background: url(images/inputs/checkbox.png) 0px 0px no-repeat;
        text-indent: -1000em;
        cursor: pointer;
        margin: 5px;
    }
    #frmShareIvn input[type=checkbox]:checked + label {
        background: url(images/inputs/checkbox.png) 0px -16px no-repeat;
    }
    #alert-message{
    	background-color: #CCC;
    }
</style>
<?php print_r($session).' Cantidad de elementos:'.count($session); ?>
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
		if ( $key != $_SESSION['dblocation'] ) {
			$dbs[$key] = ucwords($key);
		}
	}
	$options = 'id="dbselected"';
	?>
	<div class="location-option">
	<?php echo form_label('Location:', 'dbselected'); ?>
	<?php echo form_dropdown('dbselected', $dbs, '...', $options); ?>
	<h6 class="wire" style="display:inline-block">(This option to send to another location and are deducted in this store!)</h6>
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
	            	<td colspan="5" class="td-info">Use the search box to add an item to TRANSFER</td>
	            </tr>
	        </tbody>
	    </table>
	    <div class="delete-options">
			<!-- <a href="#" id="deselectall">Delete All Items Selected</a> -->
			<div class="big_button" style="float: left;" id="deselectall"><span>Delete All Items</span></div>
		</div>
	    <a class="linkPrint" href="#" id="btnSubmit">
	        <div class="big_button" style="float: left;"><span>Send</span></div>
	    </a>
	</div>
<?=form_close()?>
<?php
$this->load->view("partial/footer");
?>
<script>
	var default_table_row = '<tr><td colspan="5" class="td-info">Use the search box to add an item to TRANSFER</td></tr>';

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
				notif({
				    type: "warning",
				    msg: "You must have at least one item to transfer!",
				    width: "all",
				    height: 100,
				    position: "center"
				});
			}
		}else{
			// alert('You must select a database');
			notif({
			  type: "error",
			  msg: "You must select a database",
			  width: "all",
			  height: 100,
			  position: "center"
			});
		}

		return false;
	});
	$$('#sortable_table tbody').on('click','input.cb',function(){
		if (!$$(this).is(':checked')) {
			var id = $$(this).parents('tr').find('td:first-child').html();
			$$(this).parents('tr').remove();
			$$.get('index.php/<?php echo $controller_name ?>/delete_suggest', {'id': id});
		}
		
		var items = $$('#sortable_table tbody tr').length;
		if(items<=0){
			$$('#sortable_table tbody').html(default_table_row);
		}
	});
	$$('#deselectall').click(function(){
		$$('#sortable_table tbody tr').remove();
		$$('#sortable_table tbody').html(default_table_row);
		$.get('index.php/<?php echo $controller_name ?>/delete_suggest');
		return false
	});
</script>