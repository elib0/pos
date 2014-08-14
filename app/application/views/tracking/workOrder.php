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
		
		<h3>DASH - Work Order</h3>
		
		<div class="row">
			<form data-abide name="frmCases" id="frmCases" action="<?=$config['domain']?>/tracking/approval/" method="POST">
				<div class="large-12 columns">
					
					<div class="row" id="customer_search_label">
						<div class="large-12 columns">
							<h5>Customer:&nbsp;<small>(Required)</small></h5>
						</div>
					</div>
					<div class="row collapse panel radius" id="customer_search_box">
						<div class="small-10 columns">
							<input id="txtCustomer" name="txtCustomer" type="text" placeholder="Type to start search ...">
							<small class="error">Customer is required.</small>
						</div>
						<div class="small-2 columns">
							<a href="<?=$config['not_click']?>" id="btn_new_customer" class="button postfix success">New Customer</a>
						</div>
					</div>
					<div class="row" id="layerBackButton">
						<div class="large-10 columns">
							&nbsp;
						</div>
						<div class="large-2 columns">
							<button type="button" id="btnBackSearch" name="btnBackSearch" class="button expand">Back to Search</button>
						</div>
					</div>
					
					<div class="row">
						<div class="large-12 columns" id="customers_form"></div>
					</div>

					<fieldset>
	    				<legend><h4>Device Info</h4></legend>
						<div class="row">
							<div class="large-4 columns">
								<label>Brand:&nbsp;<small>(Required)</small>
								<select name="cboPhoneModel" id="cboPhoneModel" required>
									<option value="">---</option>
										<?php foreach ($phone_models as $array){ ?>
									<option value="<?=$array['model_id']?>"><?=$array['model_name']?></option>
									<?php } ?>	
								</select>
								</label>
								<small class="error radius">Make is required.</small>
							</div>
							<div class="large-4 columns">
								<label>IMEI / Serial number:
									<input type="text" name="txtImei" id="txtImei" pattern="alpha_numeric" placeholder="IMEI or Serial number" />
								</label>
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
							<label for="chkTerm">
								<input id="chkTerm" type="checkbox" required>&nbsp;Term of Services
							</label>
							<h5 class="subheader justify">
								<small>
									I understand that Dash is not responsible for any damage to any items due to previous condition and/or usage. 
									Failure to inform the technician of any prior or current condition may result in testing, troubleshooting and repair methods being used 
									when they should not. In this case the customer is responsible for the damage of the product and any damage to equipment used to 
									troubleshoot the product, unless a technician has been negligent and/or abusive. Dash is not responsible for any damage to product 
									caused by attempting a repair in a proper way. Any equipment left over 30 days will be recycled. All personal data will be irrevocable 
									destroyed to protect your privacy. I understand that services rendered by Dash and any damage to this device or data are incidental to 
									the services rendered. Any warranty expressed or implied only covers that part and the labor provided on the part. All parts come with a 
									30 day warranty which does not include physical and/or liquid damage.
								</small>
							</h5>
						</div>
					</div>
					
					<hr>

					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnSave" name="btnSave" class="button expand radius">&nbsp;&nbsp;&nbsp;&nbsp;Send&nbsp;&nbsp;&nbsp;&nbsp;</button>
							<input type="hidden" id="isNewCustomer" name="isNewCustomer" value="0">
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

	<script type="text/javascript" src="<?=base_url()?>js/functions.js"></script>
	
	<script>
		$(document).foundation();

		var out = '<?=(isset($out)?$out:'')?>';
		var title = '<?=(isset($title)?$title:'')?>';
		var message = '<?=(isset($message)?$message:'')?>';
		var work_order = '<?=(isset($work_order)?$work_order:'')?>';

		if (out=='ok'&&title!=''&&message!=''&&work_order!=''){
			$('#contact-reveal h2').html(title);
	        $('#contact-reveal h5').append(message);
	        $('#contact-reveal h5').append('<br/><br/>'+work_order);
	        $('#contact-reveal').foundation('reveal', 'open');
		        setTimeout(function(){
	                redirect('<?=(isset($url))?$url:base_url()?>');
	            }, 3000);
		}

		$("#btn_new_customer").click(function() {

			$('#isNewCustomer').val(1);
			$('#layerBackButton').show();

			$.ajax({
				url: "<?=$config['domain']?>/tracking/new_customer",
			    dataType: 'html',
			    success : function(data) {
					
					$("#customer_search_label,#customer_search_box").hide();
			    	$("#customers_form").html(data);

			    	//cities complete	
					$("#cboState").change(function() {
						var txt = $(this);
						$.ajax({
							url: "<?=$config['domain']?>/zips/get_cities/"+txt.val(),
						    dataType: 'html',
						    success : function(data) {
						    	$('#citiesLayer').html(data);
						    }
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

		//back
		$("#btnBackSearch").click(function(){
			$('#layerBackButton').hide();
			$("#customer_search_label,#customer_search_box").show();
			$('#isNewCustomer').val(0);
			$('#txtCustomer').attr('required','required');
		});

		//save
		$("#btnSave").click(function() {
			if ($('#isNewCustomer').val() == 1){
				$('#txtCustomer').removeAttr('required');
				$('#txtCustomer').removeAttr('data-invalid');
			}else{
				$('#txtCustomer').attr('required','required');
			}

			$('#frmCases').submit();
		});

		

	</script>
    
  </body>
</html>