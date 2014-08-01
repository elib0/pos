<script type="text/javascript" src="includes/jscript/jqueryui.js"></script>
<script type="text/javascript" src="templates/orderforms/{$carttpl}/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="templates/orderforms/{$carttpl}/style.css" />
<link rel="stylesheet" type="text/css" href="templates/orderforms/{$carttpl}/css/style.css" />

<br />

<div align="center"><span class="cartheading">{$LANG.cartproductaddons}</span><br /><a href="#" onclick="showcats();return false;">({$LANG.cartchooseanothercategory})</a></div>

<div id="categories">
{foreach key=num item=productgroup from=$productgroups}
{if $productgroup.gid neq $gid}<div class="cat"><a href="cart.php?gid={$productgroup.gid}">{$productgroup.name}</a></div>{/if}
{/foreach}
{if $loggedin}
{if $renewalsenabled && $gid neq "renewals"}<div class="cat"><a href="cart.php?gid=renewals">{$LANG.domainrenewals}</a></div>{/if}
{/if}
{if $registerdomainenabled && $domain neq "register"}<div class="cat"><a href="cart.php?a=add&domain=register">{$LANG.registerdomain}</a></div>{/if}
{if $transferdomainenabled && $domain neq "transfer"}<div class="cat"><a href="cart.php?a=add&domain=transfer">{$LANG.transferdomain}</a></div>{/if}
</div>
<div class="clear"></div>

<br />
<br />

{foreach from=$addons item=addon}
<div class="addoncontainer">
<form method="post" action="{$smarty.server.PHP_SELF}?a=add">
<input type="hidden" name="aid" value="{$addon.id}" />
<div class="title">{$addon.name}</div>
<div class="desc">{$addon.description}</div>
<div class="pricing">
{if $addon.free}
{$LANG.orderfree}
{else}
{if $addon.setupfee}{$addon.setupfee} {$LANG.ordersetupfee} + {/if}
{$addon.recurringamount} {$addon.billingcycle}
{/if}
</div>
<div align="center"><select name="productid">{foreach from=$addon.productids item=product}
<option value="{$product.id}">{$product.product}{if $product.domain} - {$product.domain}{/if}</option>
{/foreach}</select> <input type="submit" value="{$LANG.ordernowbutton}" /></div>
</form>
</div>
{/foreach}

{if $noaddons}
<div class="errorbox" style="display:block;">{$LANG.cartproductaddonsnone}</div>
{/if}

<br />

<p align="center"><input type="button" value="{$LANG.viewcart}" onclick="window.location='cart.php?a=view'" /></p>

<br />