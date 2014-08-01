
<h3>{$groupname}</h3>

<ul class="breadcrumbs">
	{foreach key=num item=productgroup from=$productgroups}
	{if $productgroup.gid neq $gid} <li><a href="cart.php?gid={$productgroup.gid}">{$productgroup.name}</a></li> {/if}
	{/foreach}
	{if $loggedin}
	{if $gid neq "addons"} <li><a href="cart.php?gid=addons">{$LANG.cartproductaddons}</a></li>{/if}
	{if $renewalsenabled && $gid neq "renewals"} <li><a href="cart.php?gid=renewals">{$LANG.domainrenewals}</a></li>{/if}
	{/if}
	{if $registerdomainenabled && $domain neq "register"} <li><a href="cart.php?a=add&domain=register">{$LANG.registerdomain}</a></li>{/if}
	{if $transferdomainenabled && $domain neq "transfer"} <li><a href="cart.php?a=add&domain=transfer">{$LANG.transferdomain}</a></li>{/if}
	<li><a href="cart.php?a=view">{$LANG.viewcart}</a></li>
</ul>


{if !$loggedin && $currencies}
<div id="currencychooser">
{foreach from=$currencies item=curr}
<a href="cart.php?gid={$gid}&currency={$curr.id}"><img src="images/flags/{if $curr.code eq "AUD"}au{elseif $curr.code eq "CAD"}ca{elseif $curr.code eq "EUR"}eu{elseif $curr.code eq "GBP"}gb{elseif $curr.code eq "INR"}in{elseif $curr.code eq "JPY"}jp{elseif $curr.code eq "USD"}us{elseif $curr.code eq "ZAR"}za{else}na{/if}.png" border="0" alt="" /> {$curr.code}</a>
{/foreach}
</div>

{else}
<br />
{/if}

<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">

{foreach from=$products key=num item=product}
<li>
	<ul class="pricing-table" id="product{$num}">
	  <li class="title">{$product.name}{if $product.qty!=""} <span class="qty">({$product.qty} {$LANG.orderavailable})</span>{/if}</li>
	  <li class="price">{$product.pricing.minprice.price} {if $product.pricing.minprice.cycle eq "monthly"}
		{$LANG.orderpaymenttermmonthly}
		{elseif $product.pricing.minprice.cycle eq "quarterly"}
		{$LANG.orderpaymenttermquarterly}
		{elseif $product.pricing.minprice.cycle eq "semiannually"}
		{$LANG.orderpaymenttermsemiannually}
		{elseif $product.pricing.minprice.cycle eq "annually"}
		{$LANG.orderpaymenttermannually}
		{elseif $product.pricing.minprice.cycle eq "biennially"}
		{$LANG.orderpaymenttermbiennially}
		{elseif $product.pricing.minprice.cycle eq "triennially"}
		{$LANG.orderpaymenttermtriennially}
		{/if}</li>
	  <li class="description">{$product.featuresdesc}</li>
	  {foreach from=$product.features key=feature item=value}
		<li class="bullet-item">{$feature}  {$value}</li>
	  {/foreach}

	  <li class="cta-button">
	  	<form method="post" action="cart.php?a=add&pid={$product.pid}">
			<div class="ordernowbox"><input type="submit" value="{$LANG.ordernowbutton} &raquo;" class="button  radius" /></div>
	 	 </form>
	 </li>
	</ul>
</li>
{/foreach}
</ul>


{if !$loggedin && $currencies}
<div id="currencychooser">
{foreach from=$currencies item=curr}
<a href="cart.php?gid={$gid}&currency={$curr.id}"><img src="images/flags/{if $curr.code eq "AUD"}au{elseif $curr.code eq "CAD"}ca{elseif $curr.code eq "EUR"}eu{elseif $curr.code eq "GBP"}gb{elseif $curr.code eq "INR"}in{elseif $curr.code eq "JPY"}jp{elseif $curr.code eq "USD"}us{elseif $curr.code eq "ZAR"}za{else}na{/if}.png" border="0" alt="" /> {$curr.code}</a>
{/foreach}
</div>

{/if}