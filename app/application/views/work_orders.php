<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>DASH | Work Order</title>
	<link rel="stylesheet" href="<?=base_url()?>css/foundation.css" />
	<link href="<?=base_url()?>css/quicksign.css" rel="stylesheet">
	<link type="text/css" href="<?=base_url()?>css/jquery-ui.css" rel="stylesheet">
	<link type="text/css" href="<?=base_url()?>css/jquery.signature.css" rel="stylesheet">
	
	<script src="<?=base_url()?>js/vendor/modernizr.js"></script>
</head>
<body>
    
	<div class="row">
		
		<h3>Work Order Approval</h3>
		<h5><small>I agree DASH works in my phone.</small></h5>
		
		<div class="row">
			<form data-abide name="frmContact" id="frmContact" action="" method="POST">
				<div class="large-12 columns">
					
					<div class="row">
						<div class="large-10 columns">
							<label><h5>Customer</h5>
								<input id="txtCustomer" name="txtCustomer" type="text" placeholder="type to start search ...">
							</label>
							<small class="error radius">error.</small>
						</div>
						<div class="large-2 columns">
							<label><h5 style="color:#FFF">New</h5>&nbsp;
								<input type="button" value="&nbsp;&nbsp;&nbsp;New Customer&nbsp;&nbsp;&nbsp;" class="button tiny">
							</label>
						</div>
					</div>
						

					<div class="row">
						<div class="large-12 columns">
							<label><h5>Alternate</h5>
								<select name="cboContactReason" id="cboContactReason">
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</label>
							<small class="error radius">error.</small>
						</div>
					</div>

					<fieldset>
    					<legend>Customer Info</legend>
						<div class="row">
							<div class="large-4 columns">
								<label>Name&nbsp;<small>(Required)</small>
									<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" required />
								</label>
								<small class="error radius">error.</small>
							</div>
							<div class="large-4 columns">
								<label>Last Name&nbsp;<small>(Required)</small>
									<input type="text" name="txtContactLastName" id="txtContactLastName" pattern="alpha_numeric" required />
								</label>
								<small class="error">error.</small>
							</div>
							<div class="large-4 columns">
								<label>Phone Number&nbsp;<small>(Required)</small>
									<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" required />
								</label>
								<small class="error radius">error.</small>
							</div>
						</div>
						<div class="row">
							<div class="large-4 columns">
								<label>State:
									<select name="cboContactReason" id="cboContactReason">
										<option value="">...</option>
									</select>
								</label>
							</div>
							<div class="large-4 columns">
								<label>City:
									<select name="cboContactReason" id="cboContactReason">
										<option value="">...</option>
									</select>
								</label>
							</div>
							<div class="large-4 columns">
								<label>Zip Code&nbsp;<small>(Required)</small>
									<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" required />
								</label>
								<small class="error radius">error.</small>
							</div>
						</div>
					</fieldset>

					
					<fieldset>
	    				<legend>Device Info</legend>
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
					</fieldset>

					<h5>Request:</h5>

					<div class="row">
						<div class="large-12 columns">
							<label>
								<textarea placeholder="Fill the customer request"></textarea>
							</label>
							<small class="error radius">error.</small>
						</div>
					</div>

					<h5>Signature:</h5>
					
					<div class="row">
						<div class="large-12 columns">
							<div id="sig"></div>
						</div>
					</div>

					<div class="row">&nbsp;</div>

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

	<script type="text/javascript" src="<?=base_url()?>js/jquery.1.8.2.min.js"></script>
	
	<script type="text/javascript" src="<?=base_url()?>js/foundation.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>js/jquery.signature.js"></script>
	

	<script>
		$(document).foundation();
		
		$('#sig').signature();

		$("#txtCustomer").keyup(function() {
			var txt = $(this);
			$.ajax({
				url: "<?=$config['domain']?>/customers/complete/"+txt.val(),
			    dataType: 'json',
			    success : function(data) {
					var _customers = [];
					$.each(data, function(i, item) {
					    _customers.push(item.name); 
					});

					$( "#txtCustomer" ).autocomplete({
						source: _customers
					});
			    }
			});
		});		

	</script>
    
  </body>
</html>