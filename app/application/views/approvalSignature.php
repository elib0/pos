<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Work Order Approval</title>
  <style>
    body { font: normal 100.01%/1.375 "Helvetica Neue",Helvetica,Arial,sans-serif; }
  </style>
  <link href="<?=base_url()?>css/signature/jquery.signaturepad.css" rel="stylesheet">
  <link type="text/css" href="<?=base_url()?>css/app.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="<?=base_url()?>/js/signature/flashcanvas.js"></script><![endif]-->
  <script src="<?=base_url()?>js/vendor/jquery.min.js"></script>
</head>
<body>
<form name="fromApproval" id="fromApproval"  action="<?=$config['domain']?>/tracking/approval/" method="POST" enctype="multipart/form-data">
	<div class="wrap">
		<div>
			<h1>Work Order Approval</h1>
		</div>

		<div>
			<div><h4>Date</h4></div>
			<div class="field"><?=date('Y-m-d')?></div>
		</div>

		<div class="cell">
			<div><h4>Customer</h4></div>
			<div class="field"><?=$customer?></div>
		</div>

		<div class="cell">
			<div><h4>Device</h4></div>
			<div class="field"><?=$device?></div>
		</div>

		<div class="cell">
			<div><h4>IMEI</h4></div>
			<div class="field"><?=$imei?></div>
		</div>

		<div class="cell">
			<div><h4>Color</h4></div>
			<div class="field"><?=$color?></div>
		</div>

		<div class="cell">
			<div><h4>Problem</h4></div>
			<div class="field"><?=$problem?></div>
		</div>
	</div>

	<div class="sigPad">
		<ul class="sigNav">
			<li class="drawIt"><a href="#draw-it" >Signature</a></li>
			<li class="clearButton"><a href="#clear">Reset</a></li>
		</ul>
		<div class="sig sigWrapper">
			<div class="typed"></div>
			<canvas class="pad" width="410"height="55"></canvas>
			<input type="hidden" name="output" class="output">
		</div>
	</div>

	<div class="wrap">
		<input type="submit" name="btnSend" class="appbutton" value="Send">
	</div>
	<?php 
		while ($value = current($case)) {
			echo '<input type="hidden" name="'.key($case).'" id="'.key($case).'" value="'.$value.'">';
			next($case);
		}
		if (count($arrayCustomer)>0){
			while ($value = current($arrayCustomer)) {
				echo '<input type="hidden" name="'.key($arrayCustomer).'" id="'.key($arrayCustomer).'" value="'.$value.'">';
				next($arrayCustomer);
			}
		}
	?>
	<input type="hidden" name="id_customer" id="id_customer" value="<?=$id_customer?>">
</form>

<script src="<?=base_url()?>js/signature/jquery.signaturepad.js"></script>
<script>
$(document).ready(function() {
$('.sigPad').signaturePad({drawOnly:true});
});
</script>
<script src="<?=base_url()?>js/signature/json2.min.js"></script>
</body>