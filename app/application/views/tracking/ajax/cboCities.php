<label>City:&nbsp;<small>(Required)</small>
	<select name="cboCity" id="cboCity">
		<option value="">---</option>
		<?php foreach ($cities as $array){ ?>
			<option value="<?=$array['city']?>"><?=$array['city']?></option>
		<?php } ?>	
	</select>
</label>
<small class="error radius">City is required.</small>