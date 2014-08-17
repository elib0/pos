<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Work Order Approval</title>
 <link rel="stylesheet" href="<?=base_url()?>css/foundation.css" />
  <link href="<?=base_url()?>css/signature/jquery.signaturepad.css" rel="stylesheet">
  <link type="text/css" href="<?=base_url()?>css/app.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="<?=base_url()?>/js/signature/flashcanvas.js"></script><![endif]-->
  <script src="<?=base_url()?>js/vendor/jquery.min.js"></script>
  <script src="<?=base_url()?>js/vendor/modernizr.js"></script>
</head>
<body>

<div class="row">

	<h3>Work Order Approval</h3>

	<div class="row">
		<form name="fromApproval" id="fromApproval"  action="<?=$config['domain']?>/tracking/save/" method="POST" enctype="multipart/form-data">
			
			<div class="large-12 columns">
				<h3><small><strong>Date:</strong>&nbsp;<?=date('Y-m-d')?></small></h3>
			</div>

			<hr>

			<div class="large-12 columns">
				<h3><small><strong>Customer:</strong>&nbsp;<?=$customer_name?></small></h3>
			</div>

			<hr>

			<div class="large-12 columns">
				<h3><small><strong>Device:</strong>&nbsp;<?=$device?></small></h3>
			</div>

			<hr>

			<div class="large-12 columns">
				<h3><small><strong>IMEI:</strong>&nbsp;<?=$case['serial']?></small></h3>
			</div>

			<hr>

			<div class="large-12 columns">
				<h3><small><strong>Color:</strong>&nbsp;<?=$case['color']?></small></h3>
			</div>

			<hr>

			<div class="large-12 columns">
				<h3><small><strong>Problem:</strong>&nbsp;<?=$case['problem']?></small></h3>
			</div>

			<hr>

			<div class="large-12 columns">

				<div class="sigPad">
						<ul class="sigNav">
							<li class="drawIt"><a href="#draw-it" >Signature</a></li>
							<li class="clearButton"><a href="#clear">Reset</a></li>
						</ul>
						<div class="sig sigWrapper">
							<div class="typed"></div>
							<canvas class="pad" width="800" height="55"></canvas>
							<input type="hidden" name="output" class="output">
						</div>
					</div>

			</div>

			<div class="large-12 columns">&nbsp;</div>

			<hr>

			<div class="large-12 columns">&nbsp;</div>

			<div class="large-12 columns">
				<button type="button" id="btnSave" name="btnSave" class="button expand radius">Approval</button>
			</div>

			<div class="large-12 columns">

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
			</div>

		</form>
	</div>

</div>


<script type="text/javascript" src="<?=base_url()?>js/foundation.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/jquery.form.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/functions.js"></script>

<script src="<?=base_url()?>js/signature/jquery.signaturepad.js"></script>

<script>
	$(document).ready(function() {
		$(document).foundation();

		$('.sigPad').signaturePad({ drawOnly:true, lineTop:120, lineMargin:0, bgColour:'#F4F4F4' });

		$('#btnSave').click(function (){
			$('#fromApproval').submit();
		});

	});
</script>

<script src="<?=base_url()?>js/signature/json2.min.js"></script>

</body>