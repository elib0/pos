<h2>{$LANG.cartdomainsconfig}</h2>

<p>{$LANG.cartdomainsconfiginfo}</p>

<div id="configdomainerror" class="errorbox hidden"></div>

<form id="domainconfigfrm" onsubmit="completedomainconfig();return false">

{foreach key=num item=domain from=$domains}
<p class="domainconfigtitle"><b>{$domain.domain}</b></p>
<table width="100%" cellspacing="0" cellpadding="0">
{if $domain.eppenabled}<tr class="{cycle values="rowcolor1,rowcolor2"}"><td class="fieldlabel">{$LANG.domaineppcode}:</td><td class="fieldarea"><input type="text" name="epp[{$num}]" size="20" value="{$domain.eppvalue}" /> {$LANG.domaineppcodedesc}</td></tr>{/if}
{if $domain.dnsmanagement || $domain.emailforwarding || $domain.idprotection}<tr class="{cycle values="rowcolor1,rowcolor2"}"><td class="fieldlabel">{$LANG.cartaddons}:</td><td class="fieldarea">
{if $domain.dnsmanagement}<input type="checkbox" name="dnsmanagement[{$num}]" id="dnsm{$num}"{if $domain.dnsmanagementselected} checked{/if} onclick="domainconfigupdate();" /> <label for="dnsm{$num}">{$LANG.domaindnsmanagement} ({$domain.dnsmanagementprice})</label><br />{/if}
{if $domain.emailforwarding}<input type="checkbox" name="emailforwarding[{$num}]" id="emf{$num}"{if $domain.emailforwardingselected} checked{/if} onclick="domainconfigupdate();" /> <label for="emf{$num}">{$LANG.domainemailforwarding} ({$domain.emailforwardingprice})</label><br />{/if}
{if $domain.idprotection}<input type="checkbox" name="idprotection[{$num}]" id="idp{$num}"{if $domain.idprotectionselected} checked{/if} onclick="domainconfigupdate();" /> <label for="idp{$num}">{$LANG.domainidprotection} ({$domain.idprotectionprice})</label><br />{/if}
</td></tr>{/if}
{foreach key=domainfieldname item=domainfield from=$domain.fields}
<tr class="{cycle values="rowcolor1,rowcolor2"}"><td class="fieldlabel">{$domainfieldname}:</td><td class="fieldarea">{$domainfield}</td></tr>
{/foreach}
</table>
{/foreach}

{if $atleastonenohosting}
<h2>{$LANG.domainnameservers}</h2>
<table width="100%" cellspacing="0" cellpadding="0">
<tr class="rowcolor1"><td class="fieldlabel">{$LANG.cartnameserverchoice}:</td><td class="fieldarea"><input type="radio" name="customns" id="usedefaultns" onclick="showcustomns()" checked /> <label for="usedefaultns">{$LANG.cartnameserverchoicedefault}</label><br /><input type="radio" name="customns" id="usecustomns" onclick="showcustomns()" /> <label for="usecustomns">{$LANG.cartnameserverchoicecustom}</label></td></tr>
<tr class="rowcolor2 hiddenns"><td class="fieldlabel">{$LANG.domainnameserver1}:</td><td class="fieldarea"><input type="text" name="domainns1" size="40" value="{$domainns1}" /></td></tr>
<tr class="rowcolor1 hiddenns"><td class="fieldlabel">{$LANG.domainnameserver2}:</td><td class="fieldarea"><input type="text" name="domainns2" size="40" value="{$domainns2}" /></td></tr>
<tr class="rowcolor2 hiddenns"><td class="fieldlabel">{$LANG.domainnameserver3}:</td><td class="fieldarea"><input type="text" name="domainns3" size="40" value="{$domainns3}" /></td></tr>
<tr class="rowcolor1 hiddenns"><td class="fieldlabel">{$LANG.domainnameserver4}:</td><td class="fieldarea"><input type="text" name="domainns4" size="40" value="{$domainns4}" /></td></tr>
</table>
{/if}

<p align="center"><input type="submit" value="{$LANG.ordercontinuebutton}" /></p>

</form>

<div id="domainconfloading" class="loading"><img src="images/loading.gif" border="0" alt="{$LANG.loading}" /></div>