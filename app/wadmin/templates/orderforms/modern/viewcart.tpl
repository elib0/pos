<script type="text/javascript" src="templates/orderforms/{$carttpl}/js/main.js"></script>
<script type="text/javascript" src="includes/jscript/statesdropdown.js"></script>
<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>

{literal}<script language="javascript">
function removeItem(type,num) {
	var response = confirm("{/literal}{$LANG.cartremoveitemconfirm}{literal}");
	if (response) {
		window.location = 'cart.php?a=remove&r='+type+'&i='+num; 
	}
}
function emptyCart(type,num) {
	var response = confirm("{/literal}{$LANG.cartemptyconfirm}{literal}");
	if (response) {
		window.location = 'cart.php?a=empty';
	}
}


$(function() {
  $('#signupfrm input').attr('disabled','disabled');
});


</script>{/literal}

<h3>{$LANG.cartreviewcheckout}</h3>

{if $errormessage}
<ul class="alert side-nav">{$errormessage}</ul>
{elseif $promotioncode && $rawdiscount eq "0.00"}
<div class="alert radius button" >{$LANG.promoappliedbutnodiscount}</div>
{/if}

{if !$loggedin && $currencies}
<div id="currencychooser">
{foreach from=$currencies item=curr}
<a href="cart.php?a=view&currency={$curr.id}"><img src="images/flags/{if $curr.code eq "AUD"}au{elseif $curr.code eq "CAD"}ca{elseif $curr.code eq "EUR"}eu{elseif $curr.code eq "GBP"}gb{elseif $curr.code eq "INR"}in{elseif $curr.code eq "JPY"}jp{elseif $curr.code eq "USD"}us{elseif $curr.code eq "ZAR"}za{else}na{/if}.png" border="0" alt="" /> {$curr.code}</a>
{/foreach}
</div>
<div class="clear"></div>
{else}
<br />
{/if}

<table class="cart" cellspacing="1">
<tr><th width="100%">{$LANG.orderdesc}</th><th width="40%">{$LANG.orderprice}</th></tr>

{foreach key=num item=product from=$products}
<tr class="carttableproduct"><td>
<strong><em>{$product.productinfo.groupname}</em> - {$product.productinfo.name}</strong>{if $product.domain} ({$product.domain}){/if}<br />
{if $product.configoptions}
{foreach key=confnum item=configoption from=$product.configoptions}&nbsp;&raquo; {$configoption.name}: {if $configoption.type eq 1 || $configoption.type eq 2}{$configoption.option}{elseif $configoption.type eq 3}{if $configoption.qty}{$LANG.yes}{else}{$LANG.no}{/if}{elseif $configoption.type eq 4}{$configoption.qty} x {$configoption.option}{/if}<br />{/foreach}
{/if}
<a href="{$smarty.server.PHP_SELF}?a=confproduct&i={$num}" class="cartedit">[{$LANG.carteditproductconfig}]</a> <a href="#" onclick="removeItem('p','{$num}');return false" class="cartremove">[{$LANG.cartremove}]</a>
</td><td align="center"><strong>{$product.pricingtext}{if $product.proratadate}<br />({$LANG.orderprorata} {$product.proratadate}){/if}</strong></td></tr>
{foreach key=addonnum item=addon from=$product.addons}
<tr class="carttableproduct"><td><strong>{$LANG.orderaddon}</strong> - {$addon.name}</td><td align="center"><strong>{$addon.pricingtext}</strong></td></tr>
{/foreach}
{/foreach}

{foreach key=num item=addon from=$addons}
<tr class="carttableproduct"><td>
<strong>{$addon.name}</strong><br />
{$addon.productname}{if $addon.domainname} - {$addon.domainname}<br />{/if}
<a href="#" onclick="removeItem('a','{$num}');return false" class="cartremove">[{$LANG.cartremove}]</a>
</td><td align="center"><strong>{$addon.pricingtext}</strong></td></tr>
{/foreach}

{foreach key=num item=domain from=$domains}
<tr class="carttableproduct"><td>
<strong>{if $domain.type eq "register"}{$LANG.orderdomainregistration}{else}{$LANG.orderdomaintransfer}{/if}</strong> - {$domain.domain} - {$domain.regperiod} {$LANG.orderyears}<br />
{if $domain.dnsmanagement}&nbsp;&raquo; {$LANG.domaindnsmanagement}<br />{/if}
{if $domain.emailforwarding}&nbsp;&raquo; {$LANG.domainemailforwarding}<br />{/if}
{if $domain.idprotection}&nbsp;&raquo; {$LANG.domainidprotection}<br />{/if}
<a href="{$smarty.server.PHP_SELF}?a=confdomains" class="cartedit">[{$LANG.cartconfigdomainextras}]</a> <a href="#" onclick="removeItem('d','{$num}');return false" class="cartremove">[{$LANG.cartremove}]</a>
</td><td align="center"><strong>{$domain.price}</strong></td></tr>
{/foreach}

{foreach key=num item=domain from=$renewals}
<tr class="carttableproduct"><td>
<strong>{$LANG.domainrenewal}</strong> - {$domain.domain} - {$domain.regperiod} {$LANG.orderyears}<br />
{if $domain.dnsmanagement}&nbsp;&raquo; {$LANG.domaindnsmanagement}<br />{/if}
{if $domain.emailforwarding}&nbsp;&raquo; {$LANG.domainemailforwarding}<br />{/if}
{if $domain.idprotection}&nbsp;&raquo; {$LANG.domainidprotection}<br />{/if}
<a href="#" onclick="removeItem('r','{$num}');return false" class="cartremove">[{$LANG.cartremove}]</a>
</td><td align="center"><strong>{$domain.price}</strong></td></tr>
{/foreach}

{if $cartitems==0}
<tr class="clientareatableactive"><td colspan="2" align="center">
<br />
{$LANG.cartempty}
<br /><br />
</td></tr>
{/if}

<tr class="subtotal"><td align="right">{$LANG.ordersubtotal}: &nbsp;</td><td align="center">{$subtotal}</td></tr>
{if $promotioncode}
<tr class="promotion"><td align="right">{$promotiondescription}: &nbsp;</td><td align="center">{$discount}</td></tr>
{/if}
{if $taxrate}
<tr class="subtotal"><td align="right">{$taxname} @ {$taxrate}%: &nbsp;</td><td align="center">{$taxtotal}</td></tr>
{/if}
{if $taxrate2}
<tr class="subtotal"><td align="right">{$taxname2} @ {$taxrate2}%: &nbsp;</td><td align="center">{$taxtotal2}</td></tr>
{/if}
<tr class="total"><td align="right">{$LANG.ordertotalduetoday}: &nbsp;</td><td align="center">{$total}</td></tr>
{if $totalrecurringmonthly || $totalrecurringquarterly || $totalrecurringsemiannually || $totalrecurringannually || $totalrecurringbiennially || $totalrecurringtriennially}
<tr class="recurring"><td align="right">{$LANG.ordertotalrecurring}: &nbsp;</td><td align="center">
{if $totalrecurringmonthly}{$totalrecurringmonthly} {$LANG.orderpaymenttermmonthly}<br />{/if}
{if $totalrecurringquarterly}{$totalrecurringquarterly} {$LANG.orderpaymenttermquarterly}<br />{/if}
{if $totalrecurringsemiannually}{$totalrecurringsemiannually} {$LANG.orderpaymenttermsemiannually}<br />{/if}
{if $totalrecurringannually}{$totalrecurringannually} {$LANG.orderpaymenttermannually}<br />{/if}
{if $totalrecurringbiennially}{$totalrecurringbiennially} {$LANG.orderpaymenttermbiennially}<br />{/if}
{if $totalrecurringtriennially}{$totalrecurringtriennially} {$LANG.orderpaymenttermtriennially}<br />{/if}
</td></tr>
{/if}
</table>



{if $cartitems!=0}

<form method="post" action="{$smarty.server.PHP_SELF}?a=checkout" id="mainfrm">
<input type="hidden" name="submit" value="true" />
<input type="hidden" name="custtype" id="custtype" value="existing" />

<h4>{$LANG.yourdetails}</h4>

{if !$loggedin}
<dl class="tabs " data-tab>
   <dd class="active" ><a href="#loginfrm" onclick="$('#custtype').val('existing'); $('#signupfrm input').attr('disabled','disabled');
   												    $('#loginfrm input').removeAttr('disabled');">{$LANG.existingcustomer}</a></dd>
   <dd  ><a href="#signupfrm" onclick="$('#custtype').val('new'); $('#signupfrm input').removeAttr('disabled');
   									   $('#loginfrm input').attr('disabled','disabled'); ">{$LANG.newcustomer}</a></dd>
 
  
</dl>


<div class="tabs-content panel">

<div class="content {if !$loggedin}active{/if}" id="loginfrm">

	<div class="row">
	    <div class="large-6 columns">
	      <label>{$LANG.clientareaemail}
	        <input type="text" name="loginemail" required  />
	      </label>
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareapassword}
	        <input type="password" name="loginpw" required />
	      </label>
	    </div>
    </div>

</div>
{/if}
<div class=" content{if $loggedin}active{/if} " id="signupfrm">


	 <div class="row">
	    <div class="large-6 columns">
	      <label>{$LANG.clientareafirstname} :
	        {if $loggedin}{$clientsdetails.firstname}{else}<input type="text" required name="firstname"  value="{$clientsdetails.firstname}" />{/if}
	      </label>
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientarealastname} :
	        {if $loggedin}{$clientsdetails.lastname}{else}<input type="text" required name="lastname"  value="{$clientsdetails.lastname}" />{/if}
	      </label>
	    </div>
    </div>

    <div class="row">
	    <div class="large-6 columns">
	      <label>{$LANG.clientareaaddress1} :
	        {if $loggedin}{$clientsdetails.address1}{else}<input type="text" required name="address1"  value="{$clientsdetails.address1}" />{/if}
	      </label>
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareaaddress2}
	        {if $loggedin}{$clientsdetails.address2}{else}<input type="text" required name="address2"  value="{$clientsdetails.address2}" />{/if}
	      </label>
	    </div>
    </div>

	<div class="row">
	    <div class="large-6 columns">
	      <label>{$LANG.clientareacompanyname} :
	        {if $loggedin}{$clientsdetails.companyname}{else}<input type="text" required name="companyname"  value="{$clientsdetails.companyname}" />{/if}
	      </label>
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareacity} :
	        {if $loggedin}{$clientsdetails.city}{else}<input type="text" required name="city"  value="{$clientsdetails.city}" />{/if}
	      </label>
	    </div>
    </div>

    <div class="row">
	    <div class="large-6 columns">
	      <label>{$LANG.clientareaemail} :
	        {if $loggedin}{$clientsdetails.email}{else}<input type="text" required name="email"  value="{$clientsdetails.email}" />{/if}
	      </label>
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareastate} :
	        {if $loggedin}{$clientsdetails.state}{else}<input type="text" required name="state"  value="{$clientsdetails.state}" />{/if}
	      </label>
	    </div>
    </div>

    <div class="row">
	    <div class="large-6 columns">
	      {if !$loggedin}
	      <label>{$LANG.clientareapassword} :
	        <input type="password" required name="password" id="newpw"  value="{$password}" />
	      </label>
	      {/if}
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareapostcode} :
	        {if $loggedin}{$clientsdetails.postcode}{else}<input type="text" required name="postcode"  value="{$clientsdetails.postcode}" />{/if}
	      </label>
	    </div>
    </div>

	
	<div class="row">
	    <div class="large-6 columns">
	    {if !$loggedin}
	      <label>{$LANG.clientareaconfirmpassword} :
	        <input type="password" required name="password2"  value="{$password2}" />
	      </label>
	    {/if}  
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareacountry} :
	        {if $loggedin}{$clientsdetails.country}{else}{$clientcountrydropdown}{/if}
	      </label>
	    </div>
    </div>

	<div class="row">
	    <div class="large-6 columns">
	    {if !$loggedin}<script language="javascript">showStrengthBar();</script>{/if} 
	    </div>
	    <div class="large-6 columns">
	      <label>{$LANG.clientareaphonenumber} :
	        {if $loggedin}{$clientsdetails.phonenumber}{else}<input type="text" required name="phonenumber"  value="{$clientsdetails.phonenumber}" />{/if}
	      </label>
	    </div>
    </div>



	{if $customfields || $securityquestions}
		{if $securityquestions && !$loggedin}
			<div class="row">
			    
			    <div class="large-12 columns">
			      <label>{$LANG.clientareasecurityquestion} :
					<select name="securityqid">
					{foreach key=num item=question from=$securityquestions}
						<option value={$question.id}>{$question.question}</option>
					{/foreach}
					</select>
			      </label>
			    </div>
		    </div>

			<div class="row">
			    
			    <div class="large-12 columns">
			      <label>{$LANG.clientareasecurityanswer} :
					<input type="password" name="securityqans" >
			      </label>
			    </div>
		    </div>

		{/if}
		{foreach key=num item=customfield from=$customfields}

		<div class="row">
			    
			    <div class="large-12 columns">
			      <label>{$customfield.name} :
					{$customfield.input} {$customfield.description}
			      </label>
			    </div>
		</div>

		{/foreach}
	{/if}

</div>
{if !$loggedin}
</div>
{/if}

{if $taxenabled && !$loggedin}
<div class="carttaxwarning">{$LANG.carttaxupdateselections} 
	<input type="submit" value="{$LANG.carttaxupdateselectionsupdate}" class="button  radius tiny" name="updateonly" />
</div>
{/if}

{if $domainsinorder}
<div class="panel">
	<span class="cartsubheading">{$LANG.domainregistrantinfo}</span>
	<select name="contact" id="domaincontact" onchange="domaincontactchange()">
			<option value="">{$LANG.usedefaultcontact}</option>
		{foreach key=num item=domaincontact from=$domaincontacts}
			<option value="{$domaincontact.id}">{$domaincontact.name}</option>
		{/foreach}
			<option value="addingnew"{if $contact eq "addingnew"} selected{/if}>{$LANG.clientareanavaddcontact}...</option>
	</select>

	<div style="display: none"  id="domaincontactfields">
		
	
			<div class="row">
			    <div class="large-6 columns">
			      <label>{$LANG.clientareafirstname} :
			        <input type="text" name="domaincontactfirstname"  value="{$domaincontact.firstname}" />
			      </label>
			     
			    </div>
			    <div class="large-6 columns">
			      <label>{$LANG.clientareaaddress1} :
			       <input type="text" name="domaincontactaddress1"  value="{$domaincontact.address1}" />
			      </label>
			    </div>
		    </div>
			
			<div class="row">
			    <div class="large-6 columns">
			      <label>{$LANG.clientarealastname} :
			        <input type="text" name="domaincontactlastname"  value="{$domaincontact.lastname}" />
			      </label>
			     
			    </div>
			    <div class="large-6 columns">
			      <label>{$LANG.clientareaaddress2} :
			       <input type="text" name="domaincontactaddress2"  value="{$domaincontact.address2}" />
			      </label>
			    </div>
		    </div>
		    <div class="row">
			    <div class="large-6 columns">
			      <label>{$LANG.clientareacompanyname} :
			        <input type="text" name="domaincontactcompanyname"  value="{$domaincontact.companyname}" />
			      </label>
			     
			    </div>
			    <div class="large-6 columns">
			      <label>{$LANG.clientareacity} :
			       <input type="text" name="domaincontactcity"  value="{$domaincontact.city}" />
			      </label>
			    </div>
		    </div>
   			<div class="row">
			    <div class="large-6 columns">
			      <label>{$LANG.clientareaemail} :
			        <input type="text" name="domaincontactemail"  value="{$domaincontact.email}" />
			      </label>
			     
			    </div>
			    <div class="large-6 columns">
			      <label>{$LANG.clientareastate} :
			       <input type="text" name="domaincontactstate"  value="{$domaincontact.state}" />
			      </label>
			    </div>
		    </div>

   			<div class="row">
			    <div class="large-6 columns">
			      <label>{$LANG.clientareaphonenumber} :
			        <input type="text" name="domaincontactphonenumber" size="20" value="{$domaincontact.phonenumber}" />
			      </label>
			     
			    </div>
			    <div class="large-6 columns">
			      <label>{$LANG.clientareapostcode} :
			       <input type="text" name="domaincontactpostcode" size="15" value="{$domaincontact.postcode}" />
			      </label>
			    </div>
		    </div>

   			<div class="row">

			    <div class="large-12 columns">
			      <label>{$LANG.clientareacountry} :
			       {$domaincontactcountrydropdown}
			      </label>
			    </div>
		    </div>

		
	</div>
</div>	
{/if}

<table width="100%" cellspacing="0" cellpadding="0">
<tr><td>

<div class="signupfields padded">
<span class="cartsubheading">{$LANG.orderpaymentmethod}</span><br /><br />
{foreach key=num item=gateway from=$gateways}<input type="radio" name="paymentmethod" value="{$gateway.sysname}" id="pgbtn{$num}" {if $selectedgateway eq $gateway.sysname} checked{/if} /><label for="pgbtn{$num}">{$gateway.name}</label> {/foreach}


<!--
<div id="ccinputform" class="signupfields{if $selectedgatewaytype neq "CC"} hidden{/if}">

<table width="100%" cellspacing="0" cellpadding="0" class="configtable">
{if $clientsdetails.cclastfour}
	<tr>
		<td class="fieldlabel">uu</td>
		<td class="fieldarea">
			<input type="radio" name="ccinfo" value="useexisting" id="useexisting" onclick="useExistingCC()"{if $clientsdetails.cclastfour} checked{else} disabled{/if} /> <label for="useexisting">{$LANG.creditcarduseexisting}{if $clientsdetails.cclastfour} ({$clientsdetails.cclastfour}){/if}</label><br />
<input type="radio" name="ccinfo" value="new" id="new" onclick="enterNewCC()"{if !$clientsdetails.cclastfour || $ccinfo eq "new"} checked{/if} /> <label for="new">{$LANG.creditcardenternewcard}</label>
		</td>
	</tr>{else}<input type="hidden" name="ccinfo" value="new" />{/if}
	<tr class="newccinfo"{if $clientsdetails.cclastfour && $ccinfo neq "new"} style="display:none;"{/if}>
		<td class="fieldlabel">{$LANG.creditcardcardtype}</td>
		<td class="fieldarea">
			<select name="cctype">
			{foreach key=num item=cardtype from=$acceptedcctypes}
				<option{if $cctype eq $cardtype} selected{/if}>{$cardtype}</option>
			{/foreach}
			</select>
		</td>
	</tr>
<tr class="newccinfo"{if $clientsdetails.cclastfour && $ccinfo neq "new"} style="display:none;"{/if}><td class="fieldlabel">{$LANG.creditcardcardnumber}</td><td class="fieldarea"><input type="text" name="ccnumber" size="30" value="{$ccnumber}" autocomplete="off" /></td></tr>
<tr class="newccinfo"{if $clientsdetails.cclastfour && $ccinfo neq "new"} style="display:none;"{/if}><td class="fieldlabel">{$LANG.creditcardcardexpires}</td><td class="fieldarea"><input type="text" name="ccexpirymonth" size="2" maxlength="2" value="{$ccexpirymonth}" />/<input type="text" name="ccexpiryyear" size="2" maxlength="2" value="{$ccexpiryyear}" /> (MM/YY)</td></tr>
{if $showccissuestart}
<tr class="newccinfo"{if $clientsdetails.cclastfour && $ccinfo neq "new"} style="display:none;"{/if}><td class="fieldlabel">{$LANG.creditcardcardstart}</td><td class="fieldarea"><input type="text" name="ccstartmonth" size="2" maxlength="2" value="{$ccstartmonth}">/<input type="text" name="ccstartyear" size="2" maxlength="2" value="{$ccstartyear}" /> (MM/YY)</td></tr>
<tr class="newccinfo"{if $clientsdetails.cclastfour && $ccinfo neq "new"} style="display:none;"{/if}><td class="fieldlabel">{$LANG.creditcardcardissuenum}</td><td class="fieldarea"><input type="text" name="ccissuenum" value="{$ccissuenum}" size="5" maxlength="3" /></td></tr>
{/if}
<tr><td class="fieldlabel">{$LANG.creditcardcvvnumber}</td><td class="fieldarea"><input type="text" name="cccvv" value="{$cccvv}" size="5" autocomplete="off" /> <a href="#" onclick="window.open('images/ccv.gif','','width=280,height=200,scrollbars=no,top=100,left=100');return false">{$LANG.creditcardcvvwhere}</a></td></tr>
{if $shownostore}<tr><td class="fieldlabel"><input type="checkbox" name="nostore" id="nostore" /></td><td><label for="nostore">{$LANG.creditcardnostore}</label></td></tr>{/if}
</table>

</div>

</div>

</td><td width="2%"></td><td width="49%" valign="top">

<div class="signupfields padded">
<span class="cartsubheading">{$LANG.orderpromotioncode}</span><br /><br />
{if $promotioncode}{$promotioncode} - {$promotiondescription}<br /><a href="{$smarty.server.PHP_SELF}?a=removepromo">{$LANG.orderdontusepromo}</a>{else}<input type="text" name="promocode" size="20" value="" /> <input type="submit" class="button  radius tiny" name="validatepromo" value="{$LANG.orderpromovalidatebutton}" />{/if}
</div>
-->
{if $shownotesfield}
<!--
<div class="signupfields padded">
<span class="cartsubheading">{$LANG.ordernotes}</span><br /><br />
<textarea name="notes" rows="2" style="width:100%" onFocus="if(this.value=='{$LANG.ordernotesdescription}'){ldelim}this.value='';{rdelim}" onBlur="if (this.value==''){ldelim}this.value='{$LANG.ordernotesdescription}';{rdelim}">{$notes}</textarea>
</div>
-->
{/if}
</div>
</td></tr></table>

{if $accepttos}
<div align="center"><input type="checkbox" name="accepttos" class="button  radius tiny" id="accepttos" /> <label for="accepttos">{$LANG.ordertosagreement} <a href="{$tosurl}" target="_blank">{$LANG.ordertos}</a></label></div>
<br />
{/if}




<div class="cartbuttons">
	<input type="button" value="{$LANG.emptycart}" class="button secondary  radius tiny" onclick="emptyCart();return false" /> 
	<input type="button" value="{$LANG.continueshopping}" class="button secondary  radius tiny" onclick="window.location='cart.php'" />
	<input type="submit" value="{$LANG.completeorder} >>"{if $cartitems==0} disabled{/if}  class="button  radius tiny right" />
</div>



</form>

{/if}

<div class="cartwarningbox"><img src="images/padlock.gif" align="absmiddle" border="0" alt="Secure Transaction" /> &nbsp;{$LANG.ordersecure} (<strong>{$ipaddress}</strong>) {$LANG.ordersecure2}</div>