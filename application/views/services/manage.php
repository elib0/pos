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
		<?=form_open("$controller_name/search",array('id'=>'search_form'))?>
		<input type="text" name='search' id='search' style="-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;border:1px solid #CCC"/>
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
(function($){
	var count=0;
	$('.tablesorter').off('.tslocked').on('change.tslocked','input:checkbox.locked',function(){
		if(this.checked) count++; else count--;
		$('#delete').attr('title',count>0?"<?=$this->lang->line('services_is_locked_alert')?>":null).prop('disabled',count>0);
	});

	// $('#search').select2({
	// 	placeholder: 'Service ID, Nombre o Apellido...',
	// 	minimumInputLength: 3,
	// 	maximumInputLength: 11,
	// 	allowClear: true,
	// 	formatSelection: function (item) { return item.id; },
	// 	// formatResult: function (item) { return item.text; },
	// 	ajax:{
	// 		url: 'index.php/services/suggest2',
	// 		dataType: 'json',
	// 		quietMillis: 100,
	// 		data: function (term, page) {
 //                return {
 //                    term: term,
 //                };
 //            },
 //            results: function (data, page) {
 //            	console.log(data);
 //                return { results: data };
 //            }
	// 	}
	// }).change(function(val, added, removed){
	// 	console.log(val);
	// 	if (val.added) {
	// 		//$('#search-form').submit();
	// 	}
	// });
})(jQueryNew);

$(function(){
	init_table_sorting();
	enable_select_all();
	enable_search('<?=site_url("$controller_name/suggest")?>','<?=$this->lang->line("common_confirm_search")?>')
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


</script>