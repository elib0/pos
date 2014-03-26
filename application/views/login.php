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
	<img src="<?=base_url()?>images/logo.png" alt="" />
</div>

<?php echo form_open('login') ?>
<div id="container">
<?php echo validation_errors(); ?>
	<div id="top">
	<?php echo $this->lang->line('login_login'); ?>
	</div>
	<div id="login_form">

		<div id="welcome_message">
			<?php //echo $this->lang->line('login_welcome_message'); ?>
		</div>

		<div class="form-row">
			<div class="form_field_label"><?php echo form_label('Location:', 'locationbd'); ?></div>
			<div class="form_field"><?php echo form_dropdown('locationbd', $dbs, $_SESSION['dblocation']); ?></div>
		</div>

		<div class="form-row">
			<div class="form_field_label"><?php echo $this->lang->line('login_username'); ?>:</div>
			<div class="form_field">
				<?php
					echo form_input(array(
						'name'=>'username',
						'size'=>'20', 'value'=>$fastUser
					));
				?>
			</div>
		</div>

		<div class="form-row">
			<div class="form_field_label"><?php echo $this->lang->line('login_password'); ?>:</div>
			<div class="form_field">
				<?php 
					echo form_password(array(
						'name'=>'password',
						'size'=>'20')
					); 
				?>
			</div>
		</div>
		
		<div class="form-row">
			<?php echo form_submit('loginButton','Login', 'class = "form-button"'); ?>
		</div>

		<div class="form-row">
			&nbsp;
		</div>

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
