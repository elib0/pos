{include file='orderforms/ajaxcart/ajaxcartheader.tpl'}

{if $pid}<script type="text/javascript">
selectproduct('{$pid}');
$(document).ready(function(){ldelim}
    jQuery("#pid{$pid}").attr("checked","checked");
{rdelim});
</script>{/if}

<div id="prodcontainer"{if $smarty.get.skip && $pid} style="display:none;"{/if}>

<h2>{$LANG.cartchooseproduct}</h2>

<table width="100%" cellspacing="0" cellpadding="0">
<tr class="rowcolor1"><td>
{foreach from=$productgroups item=group}<input type="radio" name="gid" value="{$group.gid}" id="gid{$group.gid}" onclick="window.location='cart.php?gid={$group.gid}'"{if $group.gid eq $gid} checked{/if} /> <label for="gid{$group.gid}">{$group.name}</label> {/foreach}
{if $loggedin}<input type="radio" name="gid" id="gidaddons" onclick="window.location='cart.php?gid=addons'" /> <label for="gidaddons">{$LANG.cartproductaddons}</label>
<input type="radio" name="gid" id="gidrenewals" onclick="window.location='cart.php?gid=renewals'" /> <label for="gidrenewals">{$LANG.domainrenewals}</label> {/if}
{if $registerdomainenabled}<input type="radio" name="gid" id="gidregdomain" onclick="window.location='cart.php?a=add&domain=register'" /> <label for="gidregdomain">{$LANG.registerdomain}</label> {/if}
{if $transferdomainenabled}<input type="radio" name="gid" id="gidtransdomain" onclick="window.location='cart.php?a=add&domain=transfer'" /> <label for="gidtransdomain">{$LANG.transferdomain}</label>{/if}
</td></tr>
</table>

<br />

<table width="90%" cellspacing="0" cellpadding="0" align="center">
{foreach from=$products item=product key=num}
    <tr><td width="25"><input type="radio" name="pid" value="{$product.pid}" id="pid{$product.pid}" {if $product.qty!="" && $product.qty<=0}disabled{/if} onclick="selectproduct('{$product.pid}')"></td><td><label for="pid{$product.pid}"><strong>{$product.name}</strong>{if $product.qty!="" && $product.qty<=0} ({$LANG.outofstock}){/if}</label>{if $product.description} - {$product.description}{/if}</td></tr>
{/foreach}
</table>

</div>

{if $numitemsincart}<div id="checkoutbtn"><input type="button" value="{$LANG.ajaxcartcheckout}" onclick="checkout()" /></div>{/if}

{if $hiddenproduct}<input type="hidden" name="pid" value="{$pid}" />{/if}

<div id="loading1" class="loading"><img src="images/loading.gif" border="0" alt="{$LANG.loading}" /></div>

<div id="configcontainer1"></div>

<div id="configcontainer2"></div>

<div id="configcontainer3"></div>

<div id="signupcontainer"></div>

{include file='orderforms/ajaxcart/ajaxcartfooter.tpl'}