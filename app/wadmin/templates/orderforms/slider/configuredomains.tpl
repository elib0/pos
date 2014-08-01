<link rel="stylesheet" type="text/css" href="templates/orderforms/{$carttpl}/style.css" />

<p class="cartheading">{$LANG.cartdomainsconfig}</p>

<p>{$LANG.cartdomainsconfiginfo}</p>

{if $errormessage}<div class="errorbox" style="display:block;">{$errormessage|replace:'<li>':' &nbsp;#&nbsp; '} &nbsp;#&nbsp; </div><br />{/if}

<form method="post" action="{$smarty.server.PHP_SELF}?a=confdomains">
<input type="hidden" name="update" value="true" />

{foreach key=num item=domain from=$domains}

<p class="cartsubheading">{$domain.domain} - {$domain.regperiod} {$LANG.orderyears} {if $domain.hosting}<span style="color:#009900;">[{$LANG.cartdomainshashosting}]</span>{else}<a href="cart.php" style="color:#cc0000;">[{$LANG.cartdomainsnohosting}]</a><br />{/if}</p>

<div id="domainconfig">

<table>
<tr><td width="120">Hosting:</td><td>{if $domain.hosting}<span style="color:#009900;">[{$LANG.cartdomainshashosting}]</span>{else}<a href="cart.php" style="color:#cc0000;">[{$LANG.cartdomainsnohosting}]</a><br />{/if}</td></tr>
<tr><td>{$LANG.orderregperiod}:</td><td>{$domain.regperiod} {$LANG.orderyears}</td></tr>
{if $domain.eppenabled}<tr><td>{$LANG.domaineppcode}:</td><td><input type="text" name="epp[{$num}]" size="20" value="{$domain.eppvalue}" /> {$LANG.domaineppcodedesc}</td></tr>{/if}
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
<p class="cartsubheading">{$LANG.domainnameservers}</p>
<div id="domainconfig">
{$LANG.cartnameserversdesc}
<table align="center">
<tr><td width="120">{$LANG.domainnameserver1}:</td><td><input type="text" name="domainns1" size="40" value="{$domainns1}" /></td></tr>
<tr><td>{$LANG.domainnameserver2}:</td><td><input type="text" name="domainns2" size="40" value="{$domainns2}" /></td></tr>
<tr><td>{$LANG.domainnameserver3}:</td><td><input type="text" name="domainns3" size="40" value="{$domainns3}" /></td></tr>
<tr><td>{$LANG.domainnameserver4}:</td><td><input type="text" name="domainns4" size="40" value="{$domainns4}" /></td></tr>
</table>
</div>
{/if}

<p align="center"><input type="submit" value="{$LANG.updatecart}" /></p>

</form>