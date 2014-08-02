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
	<link type="text/css" href="<?=base_url()?>css/app.css" rel="stylesheet">
	
	<script src="<?=base_url()?>js/vendor/modernizr.js"></script>
</head>
<body>
    
	<div class="row">
		
		<h3>Work Order Approval</h3>
		<h5><small>I agree DASH works in my phone.</small></h5>
		
		<div class="row">
			<form data-abide name="frmContact" id="frmContact" action="" method="POST">
				<div class="large-12 columns">
					
					<div class="row" id="customer_search_label">
						<div class="large-12 columns">
							<h5>Customer:&nbsp;<small>(Required)</small></h5>
						</div>
					</div>
					<div class="row collapse panel radius" id="customer_search_box">
						<div class="small-10 columns">
							<input id="txtCustomer" name="txtCustomer" type="text" placeholder="Type to start search ...">
						</div>
						<div class="small-2 columns">
							<a href="<?=$config['not_click']?>" id="btn_new_customer" class="button postfix">Add</a>
						</div>
					</div>

					<fieldset id="new_customer">
    					<legend><h4>Customer Info</h4></legend>
    					<div class="row">
							<div class="large-3 columns">
								<label>First Name:&nbsp;<small>(Required)</small>
									<input type="text" name="txtFirstName" id="txtFirstName" pattern="alpha_numeric" placeholder="Such as: Ryan" required />
								</label>
								<small class="error radius">First name is required and it has to be alpha numeric.</small>
							</div>
							<div class="large-3 columns">
								<label>Last Name:&nbsp;<small>(Required)</small>
									<input type="text" name="txtLastName" id="txtLastName" pattern="alpha_numeric" placeholder="Such as: Jones" required />
								</label>
								<small class="error radius">Last name is required and it has to be alpha numeric.</small>
							</div>
							<div class="large-3 columns">
								<label>Phone Number:&nbsp;<small>(Required)</small>
									<input type="text" name="txtPhoneNumber" id="txtPhoneNumber" placeholder="Such as: 405 510 86 82" required />
								</label>
								<small class="error radius">Phone number is required.</small>
							</div>
							<div class="large-3 columns">
								<label>Email:&nbsp;<small>(Required)</small>
									<input type="text" name="txtEmail" id="txtEmail" pattern="email" placeholder="Such as: info@fast-i-repair.com" required />
								</label>
								<small class="error radius">Email is required and it has to have a valid format.</small>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns">
								<label>State, City or Zip Code:&nbsp;<small>(Required)</small>
									<input type="text" name="txtCity" id="txtCity"  placeholder="You can start the search typing States, Cities or Zip codes ..." required />
								</label>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns">
								&nbsp;
							</div>
							<div class="large-2 columns">
								<label>
									<button type="button" id="btnBackSearch" name="btnBackSearch" class="button tiny">Back to Search</button>
								</label>
							</div>
						</div>
					</fieldset>

					
					<fieldset>
	    				<legend><h4>Device Info</h4></legend>
						<div class="row">
							<div class="large-4 columns">
								<label>Model:&nbsp;<small>(Required)</small>
									<input id="txtModel" name="txtModel" type="text" placeholder="You can type either Brand or Model">
								</label>
							</div>
							<div class="large-4 columns">
								<label>IMEI:&nbsp;<small>(Required)</small>
									<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="IMEI number" required />
								</label>
								<small class="error radius">error.</small>
							</div>
							<div class="large-4 columns">
								<label>Color:&nbsp;<small>(Required)</small>
									<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="Device color" required />
								</label>
								<small class="error radius">error.</small>
							</div>
						</div>	
					</fieldset>


					<fieldset>
	    				<legend><h4>Problem</h4></legend>
							<div class="row">
								<div class="large-6 columns">
									<label>Alternate:&nbsp;<small>(Required)</small>
										<input id="txtAlternate" name="txtAlternate" type="text" placeholder="Type the name person who is helping you">
									</label>
									<small class="error radius">error.</small>
								</div>
								<div class="large-12 columns">
									<label>Description:&nbsp;<small>(Required)</small>
										<textarea placeholder="Fill the customer request"></textarea>
									</label>
									<small class="error radius">error.</small>
								</div>
							</div>
					</fieldset>

					<h5>Signature:&nbsp;<small>(Required)</small></h5>
					
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

		$( "#btn_new_customer" ).click(function() {
			$("#customer_search_label,#customer_search_box").fadeOut(1000,function(){
				$("#new_customer").fadeIn(500);
			});
		});

		$( "#btnBackSearch" ).click(function() {
			$("#new_customer").fadeOut(1000,function(){
				$("#customer_search_label,#customer_search_box").fadeIn(500);
			});
		});

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

		$("#txtModel").keyup(function() {
			var txt = $(this);
			$.ajax({
				url: "<?=$config['domain']?>/phonemodels/complete/"+txt.val(),
			    dataType: 'json',
			    success : function(data) {
					var _customers = [];
					$.each(data, function(i, item) {
					    _customers.push(item.name); 
					});

					$( "#txtModel" ).autocomplete({
						source: _customers
					});
			    }
			});
		});	

		$("#txtAlternate").keyup(function() {
			var txt = $(this);
			$.ajax({
				url: "<?=$config['domain']?>/employee/complete/"+txt.val(),
			    dataType: 'json',
			    success : function(data) {
					var _customers = [];
					$.each(data, function(i, item) {
					    _customers.push(item.name); 
					});

					$( "#txtAlternate" ).autocomplete({
						source: _customers
					});
			    }
			});
		});	

		$("#txtCity").keyup(function() {
			var txt = $(this);
			$.ajax({
				url: "<?=$config['domain']?>/zips/complete/"+txt.val(),
			    dataType: 'json',
			    success : function(data) {
					var _customers = [];
					$.each(data, function(i, item) {
					    _customers.push(item.name); 
					});

					$( "#txtCity" ).autocomplete({
						source: _customers
					});
			    }
			});
		});		

	</script>
    
  </body>
</html>