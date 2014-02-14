<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url();?>" />
	<title><?php echo $this->config->item('company');?></title>
	<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/ospos.css" />
	<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/ospos_print.css"  media="print"/>
	<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" />
	<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/notifIt.css" />
	<script>BASE_URL = '<?php echo site_url(); ?>';</script>
	<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/notifIt.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.formatCurrency.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/jquery-ui.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.color.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.metadata.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.form.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.tablesorter.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.ajax_queue.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.bgiframe.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.autocomplete.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.validate.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/jquery.jkey-1.1.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/thickbox.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/common.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/manage_tables.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/swfobject.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/date.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
	<script src="<?php echo base_url();?>js/datepicker.js" type="text/javascript" language="javascript" charset="UTF-8"></script>

<style type="text/css">
html {
    overflow: auto;
}
.ui-dialog .overlay{
	display: block;
	overflow: hidden;
}
.overlay {
	display: none;
}

.server-offline, .server-online{
	width: 24px;
	height: 24px;
	border-radius: 50%;
	display: inline-block;
	position: absolute;
}

.server-online{
	background-color: #80FF00;
}

.server-offline{
	background-color: #FF4242;
}

#logout_overlay {
	text-align: center;
}

#logout_overlay td{
	text-align: left;
}
</style>

</head>
<body>
<div id="logout_overlay" class="overlay">
</div>
<div id="menubar">
	<div id="menubar_container">
		<div id="menubar_company_info">
		<span ><img src="images/logo.png" border="0" /><?php //echo $this->config->item('company'); ?></span>
		</div>

		<div id="menubar_navigation">
			<?php
			foreach($allowed_modules->result() as $module)
			{
			?>
			<div class="menu_item">
				<a href="<?php echo site_url("$module->module_id");?>">
				<img src="<?php echo base_url().'images/menubar/'.$module->module_id.'.png';?>" border="0" alt="Menubar Image" /></a><br />
				<a href="<?php echo site_url("$module->module_id");?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a>
			</div>
			<?php
			}
			?>
			<div class="menu_item">
				<a href="index.php/share_inventories">En pruebas</a>
			</div>
		</div>

		<div id="menubar_footer">
		<?php
			echo $this->lang->line('common_welcome')." $user_info->first_name $user_info->last_name! | ";

			$people = $this->Employee->get_all();
		?>

		<nav id="menu_changeuser">
			<?php echo $this->lang->line('common_changeuser').' | '; ?>
			<ul>
				<?php
					foreach($people->result() as $person)
					{
						?>
						<li><?php echo anchor( "cajas/index/".$person->person_id , $person->last_name.' '.$person->first_name, 'rel="#logout_overlay"' ); ?></li>
						<?php
					}
				?>
			</ul>
		</nav>
		<?php echo anchor("cajas",$this->lang->line("common_logout"), 'rel="#logout_overlay"'); ?>
		</div>

		<div id="menubar_date">
			<?php echo date('F d, Y') ?>
			<div id="time" style="display:inline;"></div>
			<!-- <div id="state_server">
				<?php
					include 'application/config/database.php';
					$url = $db[$active_group]['onlinehost'];
					$port = $db[$active_group]['onlineport'];
					$conn = @fsockopen($url, $port, $errno, $errstr, 30);
					if ($conn) { 
						echo '<div class="server-online"></div>'; 
					} else { 
						echo '<div class="server-offonline"></div>';  
					} 
				?>
			</div> -->
		</div>
		
	</div>
</div>
<div id="overlay_cash">
	<div class="contentWrap"></div>
</div>
<div id="content_area_wrapper">
<div id="content_area">
<?php $hoy = date('Y-m-d'); ?>
<script>
	function mostrarHora(){
		var hoy=new Date();
		var h=hoy.getHours();
		var m=hoy.getMinutes();
		var s=hoy.getSeconds();

		if(s <= 9) s = '0'+s;
		if(m <= 9) m = '0'+m;

		var hora = h+":"+m+":"+s
		$("#menubar_date > #time").html( hora );
		setTimeout(function(){mostrarHora()},500);
	}

	//On dom ready
	$(document).ready(function() {
		mostrarHora();
		//Control de enlaces logout
		$('#menubar_footer a').click(function(e, href){
			var href = $(this).attr('href');
			$('#realLogOut').attr('href', href);

			$('#logout_overlay').dialog({
				width: 400,
				height: 260,
				modal: true,
				resizable: false,
				draggable: false,
				hide: 'slide',
				beforeclose: function(){ $('#logout_overlay').dialog("close"); return false;},
				open: function() {
					$("#logout_overlay").load(href);
				}
			});
			$('.ui-dialog').css('overflow', 'visible');
			e.preventDefault();
		});

		// setInterval(function(){
		// 	$.get('<?php echo site_url(); ?>/Employees/ajax_check_logged_in', function(data) {
		// 		console.log(data);
		// 		if (data==0) {
		// 			location.reload();
		// 		}
		// 	});
		// }, (1000*60)*5);
	});
</script>
