<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?=base_url()?>" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?=$this->config->item('company')?></title>
	<link rel="stylesheet" rev="stylesheet" href="css/ospos.css" />
	<link rel="stylesheet" rev="stylesheet" href="css/ospos_print.css" media="print"/>
	<link rel="stylesheet" rev="stylesheet" href="css/jquery-ui.css" />
	<link rel="stylesheet" rev="stylesheet" href="css/notifIt.css" />
	<script>BASE_URL = '<?=site_url()?>';</script>
	<script src="js/jquery.switch.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery-1.10.2.min.js" type="text/javascript" charset="UTF-8"></script>
	<script>window.$$=window.jQueryNew=jQuerySwitch('jQueryNew',jQuery);</script>
	<!-- jquery new -->
	<script src="js/jquery.form.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/notifIt.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/thickbox.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.validate.min.js" type="text/javascript" charset="UTF-8"></script>
	<!-- end jquery new -->
	<script src="js/jquery-1.2.6.min.js" type="text/javascript" charset="UTF-8"></script>
	<script>window.jQueryOld=jQuerySwitch('jQueryOld',jQuery);</script>
	<!-- jquery old -->
	<script src="js/jquery.formatCurrency.js" type="text/javascript"></script>
	<script src="js/jquery-ui.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.color.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.metadata.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.form.old.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.ajax_queue.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.bgiframe.min.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.autocomplete.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.validate.min.old.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery.jkey-1.1.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/common.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/manage_tables.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/swfobject.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/date.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/datepicker.js" type="text/javascript" charset="UTF-8"></script>
	<!-- end jquery old -->

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

#logout_overlay {
	text-align: center;
}

#logout_overlay td{
	text-align: left;
}
</style>

</head>
<body>
<nav class="main-menu">
	<ul>
		<?php
		foreach($allowed_modules->result() as $module)
		{
		?>
		<li class="menu_item" id="<?=$module->module_id?>">
			<ul url="<?=site_url("$module->module_id")?>">
				<li>
					<img src="<?=base_url().'images/menubar/'.$module->module_id.'.png'?>" border="0" alt="Menubar Image" />
				</li>
				<li><a><?=$this->lang->line("module_".$module->module_id)?></a></li>
			</ul>
		</li>
		<?php
		}
		?>
		<li class="menu_item" id="assistance">
			<ul>
				<li><img src="<?=base_url().'images/menubar/schedule.png'?>" border="0" alt="Menubar Image" style="cursor: pointer" /></li>
				<li><a>Schedule</a></li>
			</ul>
		</li>
	</ul>
</nav>

<nav class="user">
	<a class="logo" href="index.php"><img src="images/<?=file_exists('images/'.$this->Appconfig->get('logo'))?$this->Appconfig->get('logo'):'logo.png'?>" border="0"/><?php //echo $this->config->item('company'); ?></a>
	<?php
		include('application/config/database.php');
		$dbs = array();
		foreach ($db as $key => $value){
			if ($key != $this->session->userdata('dblocation')) {
				$dbs[$key] = ucwords($key); //Creo arreglo para mis <option>
			}
		}

		$people = $this->Employee->get_all();
	?>
	<div class="container-menus">
		<nav id="notifications">
			<?php foreach ($notifications as $notification => $data): ?>
				<div class="notification-<?php echo $notification ?>">
				<?=anchor($data['url'],count($data['data']), 'title="'.$data['title'].'"')?>
				</div>
			<?php endforeach ?>
		</nav>
		<nav id="menu_changelocation">
			<span>User:</span><?=' '.$user_info->first_name.' '.$user_info->last_name; ?>
		</nav>
		<nav id="menu_location" class="alternative-menu">
			<span>
				<?php echo '<span>Location: </span>'.$this->session->userdata('dblocation');
				if ($this->Employee->isAdmin()){ ?>
				<ul>
					<?php foreach($dbs as $db){ ?>
							<li><?=anchor("employees/set_location/".$db,$db)?></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</span> 
		</nav>
		<nav id="menu_changeuser" class="alternative-menu">
			<span><?=$this->lang->line('common_changeuser')?></span>
			<ul>
				<?php
					foreach($people->result() as $person)
					{
						?>
						<li><?=anchor("cajas/index/".$person->person_id,$person->last_name.' '.$person->first_name,'rel="#logout_overlay"')?></li>
						<?php
					}
				?>
			</ul>
		</nav>
		<nav id="menu_logout">
			<a href="index.php/cajas" rel="#logout_overlay " id="btnLogout"><?php echo $this->lang->line("common_logout") ?></a>
		</nav>
	</div>
	<div id="menubar_date">
		<?=date('F d, Y')?>
		<span></span>
	</div>
</nav>
<div id="overlay_cash">
	<div class="contentWrap"></div>
</div>
<div id="content_area_wrapper">
<div id="content_area">
<?php $hoy = date('Y-m-d'); ?>
<script>
(function($){
	function mostrarHora(){
		var hoy=new Date();
		var h=hoy.getHours();
		var m=hoy.getMinutes();
		var s=hoy.getSeconds();

		if(s <= 9) s = '0'+s;
		if(m <= 9) m = '0'+m;

		var hora = h+":"+m+":"+s
		$("#menubar_date > span").html( hora );
		setTimeout(function(){mostrarHora()},500);
	}

	$('nav.main-menu ul>li>ul').click(function(event) {
		var href=$(this).attr('url');
		location.href=href;
	});
	
	$('#assistance').click(function(event) {
		location.href='index.php/employees/assistance';
	});

	if ('<?=$this->uri->segment(2)?>'=='assistance') {
		$('#assistance').addClass('nav-main-menu-active');
	}else{
		$('nav.main-menu ul>li#<?=$this->uri->segment(1)?>').addClass('nav-main-menu-active');
	};


	//On dom ready
	$(function() {
		mostrarHora();
		//Control de enlaces logout
		$('nav.user #menu_changeuser a,#btnLogout').click(function(e,href){
			var href=$(this).attr('href');
			$('#realLogOut').attr('href',href);
			$('<div id="logout_overlay" class="overlay"></div>').appendTo('body').dialog({
				width:400,
				height:260,
				modal:true,
				resizable:false,
				draggable:false,
				open:function(){
					$(this).load(href);
				},
				close:function(){
					$(this).remove();
					$('#fxWrapper').remove();
				}
			}).parents('.ui-dialog').css({
				'overflow':'visible'
			}).find('.ui-dialog-titlebar-close').attr('href',document.location);
			//$('.ui-dialog').css('overflow', 'visible');
			return false;
		});

	});
})(jQueryOld);
</script>
