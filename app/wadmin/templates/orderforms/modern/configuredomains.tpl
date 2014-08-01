

<h3>{$LANG.cartdomainsconfig}</h3>

<!-- <p class='panel radius'>{$LANG.cartdomainsconfiginfo}</p> -->

{if $errormessage}<div class="errorbox" style="display:block;">{$errormessage|replace:'<li>':' &nbsp;#&nbsp; '} &nbsp;#&nbsp; </div><br />{/if}

<form method="post" action="{$smarty.server.PHP_SELF}?a=confdomains">
<input type="hidden" name="update" value="true" />

{foreach key=num item=domain from=$domains}


	<div id="domainconfig">

	<table width="100%">
	<tr>
		<td>{$LANG.domainname}:</td>
		<td><h4>{$domain.domain}</h4> </td>
	</tr>
	<tr>
		<td width="30%">Hosting:</td>
		<td>{if $domain.hosting}<span style="color:#009900;">[{$LANG.cartdomainshashosting}]</span>{else}<a href="cart.php" class="button radius tiny">{$LANG.cartdomainsnohosting}</a><br />{/if}</td>
	</tr>
	<tr>
		<td>{$LANG.orderregperiod}:</td>
		<td>{$domain.regperiod} {$LANG.orderyears}</td>
	</tr>
	{if $domain.eppenabled}<tr><td>{$LANG.domaineppcode}:</td><td><input type="text" name="epp[{$num}]"  value="{$domain.eppvalue}" /> {$LANG.domaineppcodedesc}</td></tr>{/if}
	{if $domain.dnsmanagement || $domain.emailforwarding || $domain.idprotection}<tr><td class="fieldlabel">{$LANG.cartaddons}:</td><td>
	{if $domain.dnsmanagement}<input type="checkbox" name="dnsmanagement[{$num}]" id="dnsm{$num}"{if $domain.dnsmanagementselected} checked{/if} /> <label for="dnsm{$num}">{$LANG.domaindnsmanagement} ({$domain.dnsmanagementprice})</label><br />{/if}
	{if $domain.emailforwarding}<input type="checkbox" name="emailforwarding[{$num}]" id="emf{$num}"{if $domain.emailforwardingselected} checked{/if} /> <label for="emf{$num}">{$LANG.domainemailforwarding} ({$domain.emailforwardingprice})</label><br />{/if}
	{if $domain.idprotection}<input type="checkbox" name="idprotection[{$num}]" id="idp{$num}"{if $domain.idprotectionselected} checked{/if} /> <label for="idp{$num}">{$LANG.domainidprotection} ({$domain.idprotectionprice})</label><br />{/if}
	</td></tr>{/if}
	{foreach key=domainfieldname item=domainfield from=$domain.fields}
	<tr><td>{$domainfieldname}:</td><td>{$domainfield}</td></tr>
	{/foreach}
	</table>

	</div>

{/foreach}

{if $atleastonenohosting}
<h4>{$LANG.domainnameservers}</h4>

{$LANG.cartnameserversdesc}
<table width="100%">
	<tr><td width="30%">{$LANG.domainnameserver1}:</td><td><input type="text" name="domainns1"  value="{$domainns1}" /></td></tr>
	<tr><td>{$LANG.domainnameserver2}:</td><td><input type="text" name="domainns2"  value="{$domainns2}" /></td></tr>
	<tr><td>{$LANG.domainnameserver3}:</td><td><input type="text" name="domainns3"  value="{$domainns3}" /></td></tr>
	<tr><td>{$LANG.domainnameserver4}:</td><td><input type="text" name="domainns4"  value="{$domainns4}" /></td></tr>
</table>

{/if}

<input type="submit" class="button radius tiny rigth" value="{$LANG.updatecart}" />

</form>