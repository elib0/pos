<?php $this->load->view("partial/header"); ?>
<div id="page_title" style="margin-bottom:8px;"><?php echo 'Schedule Employee '.$this->lang->line('reports_report_input'); ?></div>
<?php echo form_open($controller_name.'/report/'); ?>
<?php echo form_label('Search a Employee:', 'search', $labels_attrib); ?><br>
<input type="text" name ='search' id='search'/><br>
<?php echo form_label('Select date:','month', $labels_attrib); ?><br>
<?php echo form_dropdown('month', $months_of_year); ?><br>
<?php echo form_label('Select Year:', 'year',$labels_attrib); ?><br>
<?php echo form_dropdown('year', $years); ?><br>
<input type="submit" value="Send" name="submit" id="submit" class="submit_button">
<?php echo form_close(); ?>
<script>
	$(function() {
		$("#search").autocomplete('index.php/<?php echo $controller_name; ?>/suggest/1',
			{
				max:100,
				delay:10,
				selectFirst: false,
				formatItem: function(row) {
					return row[1];
				}
			}
		);

		// $("#search").result(function(event, data, formatted){
		// 	if ( $(this).val() != '' ) {
		// 		$.get('index.php/<?php echo $controller_name; ?>/worked_months', {'id': $(this).val()}, function(data) {
		// 			console.log(data);
		// 		});
		// 	}
		// });

		$('#submit').click(function(e){
			if ($('#search').val().length < 1) {
				notif({
				    type: "error",
				    msg: 'Search Employee can not be empty, Please Try Again!',
				    width: "all",
				    height: 100,
				    position: "center"
				});
				e.preventDefault();
				return false;
			}
		});
	});
</script>
<?php $this->load->view("partial/footer"); ?>
