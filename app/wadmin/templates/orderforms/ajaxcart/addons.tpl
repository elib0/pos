{include file='orderforms/ajaxcart/ajaxcartheader.tpl'}

<div id="addonscontainer">

<h2>{$LANG.cartchooseproduct}</h2>

<table width="100%" cellspacing="0" cellpadding="0">
<tr class="rowcolor1"><td>
{foreach from=$productgroups item=group}<input type="radio" name="gid" value="{$group.gid}" id="gid{$group.gid}" onclick="window.location='cart.php?gid={$group.gid}'"{if $group.gid eq $gid} checked{/if} /> <label for="gid{$group.gid}">{$group.name}</label> {/foreach}
{if $loggedin}<input type="radio" name="gid" id="gidaddons" onclick="window.location='cart.php?gid=addons'" checked /> <label for="gidaddons">{$LANG.cartproductaddons}</label>
<input type="radio" name="gid" id="gidrenewals" onclick="window.location='cart.php?gid=renewals'" /> <label for="gidrenewals">{$LANG.domainrenewals}</label> {/if}
{if $registerdomainenabled}<input type="radio" name="gid" id="gidregdomain" onclick="window.location='cart.php?a=add&domain=register'" /> <label for="gidregdomain">{$LANG.registerdomain}</label> {/if}
{if $transferdomainenabled}<input type="radio" name="gid" id="gidtransdomain" onclick="window.location='cart.php?a=add&domain=transfer'" /> <label for="gidtransdomain">{$LANG.transferdomain}</label>{/if}
</td></tr>
</table>

<h2>{$LANG.cartproductaddons}</h2>

<p>{$LANG.cartfollowingaddonsavailable}</p>

{foreach from=$addons key=num item=addon}
<div class="addoncontainer">
<div class="addon">
<div class="title">{$addon.name}</div>
<div class="pricing">{if $addon.free}
{$LANG.orderfree}
{else}
{$addon.recurringamount} {$addon.billingcycle}
{if $addon.setupfee}<br /><span class="setup">{$addon.setupfee} {$LANG.ordersetupfee}</span>{/if}
{/if}</div>
<div class="clear"></div>
{$addon.description}
<div class="product">
<select id="addonpid{$num}">
{foreach from=$addon.productids item=product}
<option value="{$product.id}">{$product.product}{if $product.domain} - {$product.domain}{/if}</option>
{/foreach}
</select> <input type="submit" value="{$LANG.addtocart} &raquo;" onclick="addonaddtocart('{$addon.id}','{$num}')" />
</div>
</div>
</div>
{/foreach}
<div class="clear"></div>

{if $noaddons}
<div class="errorbox">{$LANG.cartproductaddonsnone}</div>
{/if}

</div>

<div id="signupcontainer"></div>

{include file='orderforms/ajaxcart/ajaxcartfooter.tpl'}