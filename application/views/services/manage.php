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
<div style="padding:3px;margin:3px 0;"> <?=$this->pagination->create_links()?> </div>
<div id="table_action_header">
	<ul>
		<li class="float_left">
		<?php if($this->Employee->has_privilege('delete', $controller_name)&&false):  ?>
		<li class="float_left">
			<?php echo anchor('#', $this->lang->line("common_delete"), 'id="delete" class="small_button"'); ?>
		</li>
		<?php endif ?>
		</li>
		<li class="float_right">
		<img src='<?=base_url()?>images/spinner_small.gif' alt='spinner' id='spinner'/>
		<?=form_open("$controller_name/search",array('id'=>'search_form'))?>
		<input type="text" name='search' id='search' placeholder="Search ..." style="-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;border:1px solid #CCC"/>
		</form>
		</li>
	</ul>
</div>
<div id="table_holder">
<?php // echo form_open("$controller_name/delete", array('id'=>'delete-form')); ?>
<?=$manage_table?>
<?php //echo form_close(); ?>
</div>
<div id="feedback_bar"></div>
<?php $this->load->view("partial/footer"); ?>
<script type="text/javascript">
jQuerySwitch('jQueryNew');
(function($){
	var count=0;
	$('.tablesorter').off('.tslocked').on('change.tslocked','input:checkbox.locked',function(){
		if(this.checked) count++; else count--;
		$('#delete').attr('title',count>0?"<?=$this->lang->line('services_is_locked_alert')?>":null).prop('disabled',count>0);
	});
})(jQuery);

jQuerySwitch('jQueryOld');
$(function(){
	init_table_sorting();
	enable_select_all();
	enable_search('<?=site_url("$controller_name/suggest")?>','<?=$this->lang->line("common_confirm_search")?>');
	$('#delete').click(function(e) {
		e.preventDefault();
		$('#delete-form').submit();
		return false;
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
</script>