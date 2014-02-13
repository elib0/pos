<?php $this->load->view("partial/header"); ?>
<div id="page_title" style="margin-bottom:8px;"><?php echo $this->lang->line('reports_report_input'); ?></div>
<?php echo form_open($controller_name.'/report/'); ?>
<label for="search">Search Employee: </label>
<input type="text" name ='search' id='search'/>
<?php echo form_label('Select date','month'); ?>:
<?php echo form_dropdown('month', $months_of_year); ?>
<?php echo form_dropdown('year', $years); ?>
<input type="submit" value="Send" name="submit">
<?php echo form_close(); ?>
<script>
	$(function() {
		$("#search").autocomplete('http://localhost/pos/index.php/employees/suggest',
			{
				max:100,
				delay:10,
				selectFirst: false,
				formatItem: function(row) {
					return row[1];
				}
			}
		);
	});
</script>
<?php $this->load->view("partial/footer"); ?>
