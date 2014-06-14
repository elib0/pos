<?=$this->load->view("partial/header")?>
<div id="title_bar">
	<div id="title" class="float_left"><?=$this->lang->line('common_list_of').' '.$this->lang->line('module_'.$controller_name)?></div>
	<div id="new_button">
		<?php
			echo anchor("$controller_name/view/-1/width:660/height:465",
			"<span>".$this->lang->line($controller_name.'_new')."</span>",
			array('class'=>'big_button thickbox','title'=>$this->lang->line($controller_name.'_new')));
		?>
	</div>
</div>
<div id="search_filter_section" style="text-align: right; font-weight: bold; height: 30px; font-size: 12px; display:<?=isset($search_section_state)&&$search_section_state?'block':'none'?>;">
	<?php echo form_open("$controller_name/refresh",array('id'=>'services_filter_form')); ?>
	<?php echo form_label($this->lang->line('services_low_inventory_services').' '.':', 'low_inventory');?>
	<?php echo form_checkbox(array('name'=>'low_inventory','id'=>'low_inventory','value'=>1,'checked'=>isset($low_inventory)?  ( ($low_inventory)? 1 : 0) : 0)).' | ';?>
	<?php echo form_label($this->lang->line('services_serialized_services').' '.':', 'is_serialized');?>
	<?php echo form_checkbox(array('name'=>'is_serialized','id'=>'is_serialized','value'=>1,'checked'=>isset($is_serialized)?  ( ($is_serialized)? 1 : 0) : 0)).' | ';?>
	<?php echo form_label($this->lang->line('services_no_description_services').' '.':', 'no_description');?>
	<?php echo form_checkbox(array('name'=>'no_description','id'=>'no_description','value'=>1,'checked'=>isset($no_description)?  ( ($no_description)? 1 : 0) : 0));?>
	<input type="hidden" name="search_section_state" id="search_section_state" value="<?=isset($search_section_state)?(($search_section_state)?'block':'none'):'none'?>"/>
	</form>
</div>

<div style="padding:3px;margin:3px 0;"> <?=$this->pagination->create_links()?> </div>

<div id="table_action_header">
	<ul>
		<?php if($this->Employee->has_privilege('delete', $controller_name)):  ?>
		<li class="float_left"><?=form_button(array('href'=>"$controller_name/delete",'id'=>'delete','class'=>'small_button'),$this->lang->line("common_delete"))?></li>
		<?php endif ?>
		
		<li class="float_right">
		<img src='<?=base_url()?>images/spinner_small.gif' alt='spinner' id='spinner'/>
		<?=form_open("$controller_name/search",array('id'=>'search_form'))?>
		<input type="text" name='search' id='search' placeholder="Search ..." style="-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;border:1px solid #CCC"/>
		</form>
		</li>
	</ul>
</div>
<div id="table_holder">
<?=$manage_table?>
</div>
<div id="feedback_bar"></div>
<?php $this->load->view("partial/footer"); ?>
<script type="text/javascript">
jQuerySwitch('jQueryNew');
(function($){
	var count=0;
	$('.tablesorter').off('.tslocked').on('change.tslocked','input:checkbox.locked',function(){
		if(this.checked) count++; else count--;
		$('#delete').attr('title',count>0?"<?=$this->lang->line('services_is_locked_alert')?>":null)
			.prop('disabled',count>0);
	});
})(jQuery);

jQuerySwitch('jQueryOld');
$(function(){
	init_table_sorting();
	enable_select_all();
	enable_checkboxes();
	enable_row_selection();
	enable_search('<?=site_url("$controller_name/suggest")?>','<?=$this->lang->line("common_confirm_search")?>');
	enable_delete('<?=$this->lang->line($controller_name."_confirm_delete")?>','<?=$this->lang->line($controller_name."_none_selected")?>');
	enable_bulk_edit('<?=$this->lang->line($controller_name."_none_selected")?>');
	$('#locationbd').change(function(event){
		$('#form_services_location').ajaxSubmit({
			success:function(response){
				// $('#title span').html(response);
				location.reload();
			}
		});
	});
	$('#generate_barcodes').click(function()
	{
		var selected = get_selected_values();
		if (selected.length === 0){
			alert('<?=$this->lang->line('services_must_select_item_for_barcode')?>');
			return false;
		}
		$(this).attr('href','index.php/services/generate_barcodes/'+selected.join(':'));
	});
	$("#low_inventory,#is_serialized,#no_description").click(function()
	{
		$('#services_filter_form').submit();
	});
});

function init_table_sorting(){
	//Only init if there is more than one row
	if($('.tablesorter tbody tr').length >1)
	{
		$("#sortable_table").tablesorter({
			sortList:[[1,0]],
			headers:{
				0:{sorter:false},
				8:{sorter:false},
				9:{sorter:false}
			}

		});
	}
}
function post_item_form_submit(response){
	if(!response.success){
		set_feedback(response.message,'error_message',true);
	}else{
		//This is an update, just update one row
		if(jQuery.inArray(response.item_id,get_visible_checkbox_ids()) != -1){
			//update_row(response.item_id,'<?php echo site_url("$controller_name/get_row")?>');
			set_feedback(response.message,'success_message',false);
			setTimeout(function() { location.reload(); }, 1000);
		}else{ //refresh entire table 	
			setTimeout(function() { location.reload(); }, 1000);
			do_search(true,function(){
				//highlight new row
				hightlight_row(response.item_id);
				set_feedback(response.message,'success_message',false);
			});
		}
	}
}

function post_bulk_form_submit(response){
	if(!response.success) set_feedback(response.message,'error_message',true);
	else{
		//var selected_item_ids=get_selected_values();
		// for(k=0;k<selected_item_ids.length;k++)
		// { 	
		// 	//update_row(selected_item_ids[k],'<?php echo site_url("$controller_name/get_row")?>');
		// }
		set_feedback(response.message,'success_message',false);
		setTimeout(function() { location.reload(); }, 1000);
	}
}

function show_hide_search_filter(search_filter_section, switchImgTag) {
	var ele = document.getElementById(search_filter_section);
	var imageEle = document.getElementById(switchImgTag);
	var elesearchstate = document.getElementById('search_section_state');
	if(ele.style.display == "block"){
		ele.style.display = "none";
		imageEle.innerHTML = '<img src=" <?php echo base_url()?>images/plus.png" style="border:0;outline:none;padding:0px;margin:0px;position:relative;top:-5px;" >';
		elesearchstate.value="none";
	}else{
		ele.style.display = "block";
		imageEle.innerHTML = '<img src=" <?php echo base_url()?>images/minus.png" style="border:0;outline:none;padding:0px;margin:0px;position:relative;top:-5px;" >';
		elesearchstate.value="block";
	}
}
</script>