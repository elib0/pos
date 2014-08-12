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
<body><?php echo $output; ?>
<form name="fromApproval" id="fromApproval"  action="<?=$config['domain']?>/tracking/approval/" method="POST" enctype="multipart/form-data">
	
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

</form>

<script src="<?=base_url()?>js/signature/jquery.signaturepad.js"></script>
<script>
$(document).ready(function() {
$('.sigPad').signaturePad({displayOnly:true}).regenerate(<?=$output?>);
});
</script>
<script src="<?=base_url()?>js/signature/json2.min.js"></script>
</body>