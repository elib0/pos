<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>DASH | Work Order</title>
	<link rel="stylesheet" href="<?=base_url()?>css/foundation.css" />
	<link href="<?=base_url()?>css/jquery.signaturepad.css" rel="stylesheet">
	<script src="<?=base_url()?>js/vendor/modernizr.js"></script>
	  <style>
    body { font: normal 100.01%/1.375 "Helvetica Neue",Helvetica,Arial,sans-serif; }
  </style>
</head>
<body>
    










    
<div class="row">
	
		<h3>Work Order Approval</h3>
		<h5><small>I agree DASH works in my phone.</small></h5>
		
		<div class="row">
			<form data-abide name="frmContact" id="frmContact" action="" method="POST">
				<div class="large-12 columns">
					
					<div class="row">
						<div class="large-4 columns">
							<label>Name&nbsp;<small>(Required)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Tu Nombre" required />
							</label>
							<small class="error radius">error.</small>
						</div>
						<div class="large-4 columns">
							<label>Last Name&nbsp;<small>(Required)</small>
								<input type="text" name="txtContactLastName" id="txtContactLastName" pattern="alpha_numeric" placeholder="Tu Apellido" required />
							</label>
							<small class="error">error.</small>
						</div>
						<div class="large-4 columns">
							<label>Alternate:
								<select name="cboContactReason" id="cboContactReason">
									<option value="1">Muna</option>
									<option value="2">Alex</option>
									<option value="3">George</option>
								</select>
							</label>
						</div>
					</div>
					
					<h5>Contact Info</h5>
					<hr>

					<div class="row">
						<div class="large-3 columns">
							<label>Phone Number&nbsp;<small>(Required)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Tu Nombre" required />
							</label>
							<small class="error radius">error.</small>
						</div>
						<div class="large-3 columns">
							<label>State:
								<select name="cboContactReason" id="cboContactReason">
									<option value="">...</option>
								</select>
							</label>
						</div>
						<div class="large-3 columns">
							<label>City:
								<select name="cboContactReason" id="cboContactReason">
									<option value="">...</option>
								</select>
							</label>
						</div>
						<div class="large-3 columns">
							<label>Zip Code&nbsp;<small>(Required)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Tu Nombre" required />
							</label>
							<small class="error radius">error.</small>
						</div>
					</div>

					<h5>Device Info</h5>
					<hr>

					<div class="row">
						<div class="large-3 columns">
							<label>Brand:
								<select name="cboContactReason" id="cboContactReason">
									<option value="">...</option>
								</select>
							</label>
						</div>
						<div class="large-3 columns">
							<label>Model:
								<select name="cboContactReason" id="cboContactReason">
									<option value="">...</option>
								</select>
							</label>
						</div>
						<div class="large-4 columns">
							<label>IMEI&nbsp;<small>(Required)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Tu Nombre" required />
							</label>
							<small class="error radius">error.</small>
						</div>
						<div class="large-2 columns">
							<label>Color&nbsp;<small>(Required)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Tu Nombre" required />
							</label>
							<small class="error radius">error.</small>
						</div>
					</div>

					<h5>Case Description</h5>
					<hr>

					<div class="row">
						<div class="large-12 columns">
							<label>Problem&nbsp;<small>(Required)</small>
								<textarea placeholder="small-12.columns"></textarea>
							</label>
							<small class="error radius">error.</small>
						</div>
						<div class="large-12 columns sigPad">
							


<!-- <ul class="sigNav">
      <li class="drawIt"><a href="#draw-it" >Draw It</a></li>
      <li class="clearButton"><a href="#clear">Clear</a></li>
    </ul> -->
    <div class="sig sigWrapper">
      <div class="typed"></div>
      <canvas class="pad" width="500" height="55"></canvas>
      <input type="hidden" name="output" class="output">
    </div>


						</div>
					</div>


					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnContactSave" name="btnContactSave" class="button radius tiny">&nbsp;&nbsp;&nbsp;&nbsp;Send&nbsp;&nbsp;&nbsp;&nbsp;</button>
						</div>
						<div class="large-2 columns">
							&nbsp;
						</div>
						<div class="large-6 columns">
							<div id="contact-reveal" class="reveal-modal small" data-reveal>
								<h2></h2>
								<h5></h5>
								<a class="close-reveal-modal">&#215;</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			
		</div>

		
	
</div>









    
    <script src="<?=base_url()?>js/vendor/jquery.js"></script>
    <script src="<?=base_url()?>js/foundation.min.js"></script>
    <script src="<?=base_url()?>js/jquery.signaturepad.js"></script>
    <script>
      $(document).foundation();


      $('.sigPad').signaturePad({drawOnly:true});

    </script>

    <script src="<?=base_url()?>js/json2.min.js"></script>
  </body>
</html>
