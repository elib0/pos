
<ul id="error_message_box"></ul>
<?php
echo form_open('items/save_inventory/'.$item_info->item_id,array('id'=>'item_form'));
?>
<fieldset id="item_basic_info">
<legend><?php echo $this->lang->line("items_basic_information"); ?></legend>

<table align="center" border="0">
<!-- <div class="field_row clearfix"> no hace nada este div, incluso al encerrar la tabla con el -->
	<tr>
		<td>
			<strong><?php echo form_label($this->lang->line('items_item_number').':', 'name',array('class'=>'wide')); ?></strong>
		</td>
		<td>
			<?php 
				$inumber = array (
					'name'=>'item_number',
					'id'=>'item_number',
					'value'=>$item_info->item_number,
					'style'       => 'border:none',
					'readonly' => 'readonly'
				);

				echo form_input($inumber);
			?>
		</td>
	</tr>

	<tr>
		<td>
			<strong><?php echo form_label($this->lang->line('items_name').':', 'name',array('class'=>'wide')); ?></strong>
		</td>
		<td>
			<?php $iname = array (
				'name'=>'name',
				'id'=>'name',
				'value'=>$item_info->name,
				'style'       => 'border:none',
				'readonly' => 'readonly'
			);
				echo form_input($iname);
				?>
		</td>
	</tr>

	<tr>
		<td>
			<strong><?php echo form_label($this->lang->line('items_category').':', 'category',array('class'=>'wide')); ?></strong>
		</td>
		<td>
			<?php $cat = array (

				'name'=>'category',
				'id'=>'category',
				'value'=>$item_info->category,
				'style'       => 'border:none',
				'readonly' => 'readonly'
				);

				echo form_input($cat);
				?>
		</td>
	</tr>

	<tr>
		<td>
			<strong><?php echo form_label($this->lang->line('items_current_quantity').':', 'quantity',array('class'=>'wide')); ?></strong>
		</td>
		<td>
			<?php $qty = array (

				'name'=>'quantity',
				'id'=>'quantity',
				'value'=>$item_info->quantity,
				'style'       => 'border:none',
				'readonly' => 'readonly'
				);

				echo form_input($qty);
			?>
		</td>
	</tr>
<!-- </div> -->
</table>
</fieldset>

<br>

<fieldset id="item_basic_info">
<legend><?=$this->lang->line('items_inventory_manipulation_title')?></legend>


<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_add_minus').':', 'quantity',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'newquantity',
		'id'=>'newquantity'
		)
	);?>
	</div>
</div>



<div class="field_row clearfix">
<?php
include('application/config/database.php'); //Incluyo donde estaran todas las config de las databses
$dbs = array('...'=>'...');
foreach ($db as $key => $value){
	if($_SESSION['dblocation'] != $key ) $dbs[$key] = ucwords($key);
}
$options = 'id="dbselected"';
// echo form_label('To:', 'newquantityTo');
?>
	<!-- <div class='form_field'>
	<?php //echo form_dropdown('dbselected', $dbs, '...', $options); ?>
	</div> -->
	<!-- <h6 clas="wire">(This option to send to another location and are deducted in this store!)</h6> -->
</div>

<div class="field_row clearfix">
<strong><?php echo form_label($this->lang->line('items_inventory_comments').':', 'description',array('class'=>'wide')); ?></strong>
	<div class='form_field'>
	<?php echo form_textarea(array(
		'name'=>'trans_comment',
		'id'=>'trans_comment',
		'rows'=>'3',
		'cols'=>'17')
	);?>
	</div>
</div>

</fieldset>


<br/>

<div class="field_row clearfix">
	<strong><?=$this->lang->line('items_inventory_manipulation_title_note')?>:</strong>
	<ul style="padding: 0; margin: 3px 0 0 30px">
		<li><?php echo $this->lang->line('common_fields_required_message'); ?></li>
		<li><?=$this->lang->line('items_inventory_manipulation_note')?></li>
	</ul>
</div>

<!-- <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div> -->
<br/><br/>
<?php
	echo form_submit(array(
		'name'=>'submit',
		'id'=>'submit',
		'value'=>$this->lang->line('common_submit'),
		'class'=>'submit_button')
	);

	echo form_close();
?>


<script type='text/javascript'>

//validation and submit handling
$(document).ready(function()
{
	$('#item_form').validate({
		submitHandler:function(form)
		{
			$(form).ajaxSubmit({
			success:function(response)
			{
				tb_remove();
				post_item_form_submit(response);
			},
			dataType:'json'
		});

		},
		errorLabelContainer: "#error_message_box",
 		wrapper: "li",
		rules:
		{
			newquantity:
			{
				required:true,
				number:true
			}
   		},
		messages:
		{

			newquantity:
			{
				required:"<?php echo $this->lang->line('items_quantity_required'); ?>",
				number:"<?php echo $this->lang->line('items_quantity_number'); ?>"
			}
		}
	});
});
</script>
