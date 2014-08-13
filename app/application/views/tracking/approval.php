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
<form name="fromApproval" id="fromApproval"  action="<?=$config['domain']?>/tracking/save/" method="POST" enctype="multipart/form-data">
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
			<div class="field"><?=$customer_name?></div>
		</div>

		<div class="cell">
			<div><h4>Device</h4></div>
			<div class="field"><?=$device?></div>
		</div>

		<div class="cell">
			<div><h4>IMEI</h4></div>
			<div class="field"><?=$case['serial']?></div>
		</div>

		<div class="cell">
			<div><h4>Color</h4></div>
			<div class="field"><?=$case['color']?></div>
		</div>

		<div class="cell">
			<div><h4>Problem</h4></div>
			<div class="field"><?=$case['problem']?></div>
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
		<input type="submit" name="btnSend" class="appbutton" value="Save">
	</div>
	<?php
		foreach($case as $key => $value){
			echo '<input type = "hidden" name="'.$key.'" id="'.$key.'" value="'.$value.'">';
		}

		if (count($customer)>0){
			foreach($customer as $key => $value){
				echo '<input type = "hidden" name="'.$key.'" id="'.$key.'" value="'.$value.'">';
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