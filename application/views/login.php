<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/login.css" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Point Of Sale <?php echo $this->lang->line('login_login'); ?></title>
<script src="<?php echo base_url();?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#login_form input:first").focus();
});
</script>
</head>
<body>

<?php
include('application/config/database.php'); //Incluyo donde estaran todas las config de las databses
$dbs = array();
foreach ($db as $key => $value) $dbs[$key] = ucwords($key); //Creo arreglo para mis <option>
?>

<div>
	<img src="<?=base_url()?>images/<?=file_exists('images/'.$this->Appconfig->get('logo'))?$this->Appconfig->get('logo'):'logo.png'?>" border="0" />
</div>

<div class="box-login">
	<?php echo form_open('login') ?>
	<div  class="box-title clearfix">
		<?php 
			if (trim(validation_errors())!=''){ 
				echo validation_errors();
		 	}else{ 
		 		echo 'Welcome to Fast i repair System. To continue, please login using your username and password below.';
		 	}
		?>
	</div>

	<div  class="clearfix">
		<table class="box-table" border="0" cellpadding="0" cellspacing="0" width="340px">
			<tr>
				<td colspan="2" class="box-bkg-label-location"><?php echo form_label('Select your location:', 'locationbd'); ?></td>
			</tr>
			<tr>
				<td colspan="2" class="box-bkg-drop-location"><?php echo form_dropdown('locationbd', $dbs, $this->input->post('locationbd')); ?></td>
			</tr>
			<tr>
				<td colspan="2" height="1"></td>
			</tr>
			<tr>
				<td class="icon-user"></td>
				<td class="bkg-input-login"><?php
						echo form_input(array(
							'name'=>'username',
							'size'=>'20', 
							'value'=>$fastUser,
							'placeholder'=>$this->lang->line('login_username')
						));
					?></td>
			</tr>
			<tr>
				<td colspan="2" height="1"></td>
			</tr>
			<tr>
				<td class="icon-lock"></td>
				<td class="bkg-input-login"><?php 
						echo form_password(array(
							'name'=>'password',
							'size'=>'20',
							'placeholder'=>$this->lang->line('login_password'))
						); 
					?></td>
			</tr>
			<tr>
				<td colspan="2" height="1"></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo form_submit('loginButton','Login', 'class = "form-button"'); ?></td>
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
echo form_close();
?>
</body>
</html>
