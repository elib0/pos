<fieldset>
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
			<label>Email:&nbsp;
				<input type="text" name="txtEmail" id="txtEmail" pattern="email" placeholder="Such as: info@fast-i-repair.com" />
			</label>
			<small class="error radius">Email is required and it has to have a valid format.</small>
		</div>
	</div>
	<!-- <div class="row">
		<div class="large-12 columns">
			<label>State, City or Zip Code:&nbsp;<small>(Required)</small>
				<input type="text" name="txtCity" id="txtCity"  placeholder="You can start the search typing States, Cities or Zip codes ..." />
			</label>
		</div>
	</div>	 -->
	<div class="row">
		<div class="large-3 columns">
			<label>State:&nbsp;<small>(Required)</small>
				<select name="cboState" id="cboState">
					<option value="">---</option>
					<?php foreach ($states as $array){ ?>
						<option value="<?=$array['state']?>"><?=$array['state']?></option>
					<?php } ?>	
				</select>
			</label>
			<small class="error radius">State is required.</small>
		</div>
		<div class="large-3 columns" id="citiesLayer">
			<label>City:&nbsp;<small>(Required)</small>
				<select name="cboCity" id="cboCity">
					<option value="">---</option>	
				</select>
			</label>
			<small class="error radius">City is required.</small>
		</div>
		<div class="large-3 columns">
			<label>Zip Code:&nbsp;<small>(Required)</small>
				<input type="text" name="txtZip" id="txtZip"  placeholder="" required />
			</label>
			<small class="error radius">Zip Code is required.</small>
		</div>
		<div class="large-3 columns">&nbsp;</div>
	</div>
</fieldset>