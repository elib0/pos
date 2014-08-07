<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>DASH | Work Order</title>
	<link rel="stylesheet" href="<?=base_url()?>css/foundation.css" />
	<link href="<?=base_url()?>css/quicksign.css" rel="stylesheet">
	<link type="text/css" href="<?=base_url()?>css/jquery-ui.css" rel="stylesheet">
	<link type="text/css" href="<?=base_url()?>css/app.css" rel="stylesheet">
	
	<script src="<?=base_url()?>js/vendor/modernizr.js"></script>
</head>
<body>
    
	<div class="row">
		
		<h3>Work Order Approval</h3>
		<h5><small>I agree DASH works in my phone.</small></h5>
		
		<div class="row">
			<!-- data-abide -->
			<form data-abide name="frmCases" id="frmCases" action="<?=$config['domain']?>/tracking/save/" method="POST" enctype="multipart/form-data">
				<div class="large-12 columns">
					
					<div class="row" id="customer_search_label">
						<div class="large-12 columns">
							<h5>Customer:&nbsp;<small>(Required)</small></h5>
						</div>
					</div>
					<div class="row collapse panel" id="customer_search_box">
						<div class="small-10 columns">
							<input id="txtCustomer" name="txtCustomer" type="text" placeholder="Type to start search ..." required>
							<small class="error">Customer is required.</small>
						</div>
						<div class="small-2 columns">
							<a href="<?=$config['not_click']?>" id="btn_new_customer" class="button postfix">Add</a>
						</div>
					</div>
					
					<div class="row"  >
						<div class="large-12 columns" id="customers_form"></div>
					</div>

					<fieldset>
	    				<legend><h4>Device Info</h4></legend>
						<div class="row">
							<div class="large-4 columns">
								<label>Model:&nbsp;<small>(Required)</small>
									<input id="txtModel" name="txtModel" type="text" placeholder="You can type either Brand or Model" required>
								</label>
								<small class="error">Model is required.</small>
							</div>
							<div class="large-4 columns">
								<label>IMEI / Serial number:&nbsp;<small>(Required)</small>
									<input type="text" name="txtImei" id="txtImei" pattern="alpha_numeric" placeholder="IMEI or Serial number" required />
								</label>
								<small class="error">IMEI / Serial number is required.</small>
							</div>
							<div class="large-4 columns">
								<label>Color:&nbsp;
									<input type="text" name="txtColor" id="txtColor" pattern="alpha_numeric" placeholder="Device color" required />
								</label>
								<small class="error">Color is required.</small>
							</div>
						</div>	
					</fieldset>


					<fieldset>
	    				<legend><h4>Problem</h4></legend>
							<div class="row">
								<div class="large-12 columns">
									<textarea id="txtProblem" name="txtProblem" placeholder="Fill the customer request" required></textarea></label>
									<small class="error">Problem is required.</small>
								</div>
							</div>
					</fieldset>

					<div class="row">
						<div class="large-12 columns">
							<input id="chkTerm" type="checkbox" required><label for="chkTerm">I accept DASH term and conditions.</label>
							<small class="error">Term and Conditions are required.</small>
						</div>
					</div>

					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnSave" name="btnSave" class="button tiny">&nbsp;&nbsp;&nbsp;&nbsp;Send&nbsp;&nbsp;&nbsp;&nbsp;</button>
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

	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.js"></script>
	
	<script type="text/javascript" src="<?=base_url()?>js/foundation.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>js/jquery.form.min.js"></script>
	
	<script>
		$(document).foundation();
		
		$("#btn_new_customer").click(function() {
			$.ajax({
				url: "<?=$config['domain']?>/tracking/new_customer_form",
			    dataType: 'html',
			    success : function(data) {
					$("#customer_search_label,#customer_search_box").hide();
			    	$("#customers_form").html(data);

			    	//cities complete	
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

					//back button
					$( "#btnBackSearch").click(function() {
						$("#new_customer").fadeOut(1000,function(){
							$("#customer_search_label,#customer_search_box").fadeIn(500);
						});
					});

			    } //success
			});
			
		});

		
		$("#txtCustomer").keyup(function() {
			var txt = $(this);
			$.ajax({
				url: "<?=$config['domain']?>/people/complete/"+txt.val(),
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

		//save
		$("#btnSave").click(function() {
			$('#frmCases').submit();
		});

		$('#frmCases').ajaxForm({
			type: "POST",
		    dataType: 'json',
		    success : function(data) { 
				$('#contact-reveal h2').html(data['title']);
				$('#contact-reveal h5').append(data['message']+'<br>'+data['work_order']);
				$('#contact-reveal').foundation('reveal', 'open');
				if (data['out']=='ok'){
		            setTimeout(function(){
		                redirect(data['url']);
		            }, 3000);
		        }
		    }
		});

	</script>
    
  </body>
</html>