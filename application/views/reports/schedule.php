<!DOCTYPE html>
<html>
<head>
<link href='<?php echo base_url();?>css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src='<?php echo base_url();?>js/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {
	
		var date = new Date(2010, 1, 11);
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			year: y,
			month: m,
			header:{
				left: 'title',
				center: '',
				right: ''
			},
			weekMode: 'variable',
			events: [
				{
					title: '26/30',
					start: new Date(y, m, 6)
				},
				{
					title: '12/12',
					start: new Date(y, m, 2)
				},
				{
					title: '12/24',
					start: new Date(y, m, 24)
				}
			]
		});
		
	});


</script>
<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div id='calendar'></div>
</body>
</html>
