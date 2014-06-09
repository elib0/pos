<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?=base_url()?>" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" rev="stylesheet" href="css/login.css" />
	<title>Point Of Sale <?=$this->lang->line('login_login')?></title>
	<script src="js/jquery.switch.js" type="text/javascript" charset="UTF-8"></script>
	<script src="js/jquery-1.10.2.min.js" type="text/javascript" charset="UTF-8"></script>
	<script>window.$$=window.jQueryNew=jQuerySwitch('jQueryNew',jQuery);</script>
	<!-- jquery new -->
	<script src="js/jquery.local.js" type="text/javascript" charset="UTF-8"></script>
	<!-- end jquery new -->
	<script src="js/jquery-1.2.6.min.js" type="text/javascript" charset="UTF-8"></script>
	<script>window.jQueryOld=jQuerySwitch('jQueryOld',jQuery);</script>
	<!-- jquery old -->
	<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
</head>
<body>

<?php
$dbs = $this->Location->get_select_option_list(false, true);
?>

<div>
	<img src="images/<?=file_exists('images/'.$this->Appconfig->get('logo'))?$this->Appconfig->get('logo'):'logo.png'?>" border="0" />
</div>

<div class="box-login">
	<?=form_open('login',array('id'=>'form_login'))?>
	<div  class="box-title clearfix">
		<?=(trim(validation_errors())!='')?validation_errors():'Welcome to Fast i repair System. To continue, please login using your username and password below.'?>
	</div>

	<div class="clearfix">
		<table class="box-table" border="0" cellpadding="0" cellspacing="0" width="340px">
			<tr>
				<td colspan="2" class="box-bkg-label-location"><?=form_label('Select your location:','locationbd')?></td>
			</tr>
			<tr>
				<td colspan="2" class="box-bkg-drop-location"><?=form_dropdown('locationbd',$dbs,$this->input->post('locationbd'))?></td>
			</tr>
			<tr>
				<td colspan="2" height="1"></td>
			</tr>
			<tr>
				<td class="icon-user"></td>
				<td class="bkg-input-login"><?=form_input(array(
					'name'=>'username',
					'size'=>'20',
					'value'=>$fastUser,
					'placeholder'=>$this->lang->line('login_username'),
				))?></td>
			</tr>
			<tr>
				<td colspan="2" height="1"></td>
			</tr>
			<tr>
				<td class="icon-lock"></td>
				<td class="bkg-input-login"><?=form_password(array(
					'name'=>'password',
					'size'=>'20',
					'placeholder'=>$this->lang->line('login_password'),
				))?>
			</td>
			</tr>
			<tr>
				<td colspan="2" height="1"></td>
			</tr>
			<tr>
				<td colspan="2"><?=form_submit('loginButton','Login','class="form-button"')?></td>
			</tr>
		</table>
	</div>
</div>
<?php
// include('application/config/database.php'); //Incluyo donde estaran todas las config de las databses
// $dbs = array();
// foreach ($db as $key => $value) $dbs[$key] = ucwords($key); //Creo arreglo para mis <option>

// echo form_label('Location:', 'locationbd');		//Etiqueta del helper form
// echo form_dropdown('locationbd', $dbs, $_SESSION['dblocation']);		//<select> generado con el helper
?>
<?=form_close()?>
<script type="text/javascript">
(function($){
	var select=$('select[name="locationbd"]')[0];
	select.value=$.local('last_db');
	if(select.value=='') select.selectedIndex=0;
	$('#form_login').submit(function(){
		$.local('last_db',select.value);
	}).find("input:first").focus();
})(jQueryNew);
</script>
</body>
</html>
