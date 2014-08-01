<link rel="stylesheet" type="text/css" href="templates/orderforms/{$carttpl}/style.css" />

<table width="100%"><tr><td width="160" valign="top">

{include file="orderforms/verticalsteps/verticalsteps.tpl" step=1}

</td><td valign="top">

<form method="post" action="{$smarty.server.PHP_SELF}">
<p>{$LANG.ordercategories}: <select name="gid" onchange="submit()">
{foreach key=num item=productgroup from=$productgroups}
<option value="{$productgroup.gid}">{$productgroup.name}</option>
{/foreach}
<option value="addons" selected="selected">{$LANG.cartproductaddons}</option>
{if $renewalsenabled}<option value="renewals">{$LANG.domainrenewals}</option>{/if}
{if $registerdomainenabled}<option value="domains">{$LANG.orderdomainregonly}</option>{/if}
</select></p>
</form>

{foreach from=$addons item=addon}
<div class="orderbox">
<b class="orderboxrtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b>
<div class="orderboxpadding">
<form method="post" action="{$smarty.server.PHP_SELF}?a=add">
<input type="hidden" name="aid" value="{$addon.id}" />
<strong>{$addon.name}</strong><br />
{$addon.description}<br />
<div style="margin:5px;padding:2px;color:#cc0000;">
{if $addon.free}
{$LANG.orderfree}
{else}
{if $addon.setupfee}{$addon.setupfee} {$LANG.ordersetupfee}<br />{/if}
{$addon.recurringamount} {$addon.billingcycle}
{/if}
</div>
{$LANG.cartproductaddonschoosepackage}: <select name="productid">{foreach from=$addon.productids item=product}
<option value="{$product.id}">{$product.product}{if $product.domain} - {$product.domain}{/if}</option>
{/foreach}</select>
<br /><br />
<div align="center"><input type="submit" value="{$LANG.ordernowbutton}" class="buttongo" /></div>
</form>
</div>
<b class="orderboxrbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b>
</div>
{/foreach}

{if $noaddons}
<div class="errorbox">{$LANG.cartproductaddonsnone}</div>
{/if}

</td></tr></table>