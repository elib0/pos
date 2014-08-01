
<script type="text/javascript" src="templates/orderforms/{$carttpl}/js/main.js"></script>

<form id="orderfrm" >
<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">
<input type="hidden" name="configure" value="true" />
<input type="hidden" name="i" value="{$i}" />

{if !$firstconfig || $firstconfig && !$domain}<p class="cartheading">{$LANG.orderconfigure}</p>{/if}

<div id="configproducterror" class="errorbox"></div>



{if $pricing.type eq "recurring"}
<li>
<div class="billingcycle panel" >
<h3 class="cartsubheading">{$LANG.cartchoosecycle}</h3>
	<ul  class="side-nav" >
	{if $pricing.monthly}<li><input type="radio" name="billingcycle" id="cycle1" value="monthly"{if $billingcycle eq "monthly"} checked{/if} onclick="recalctotals()" /></td><td class="fieldarea"><label for="cycle1">{$pricing.monthly}</label></li>{/if}
	{if $pricing.quarterly}<li><input type="radio" name="billingcycle" id="cycle2" value="quarterly"{if $billingcycle eq "quarterly"} checked{/if} onclick="recalctotals()" /></td><td class="fieldarea"><label for="cycle2">{$pricing.quarterly}</label></li>{/if}
	 {if $pricing.semiannually}<li><input type="radio" name="billingcycle" id="cycle3" value="semiannually"{if $billingcycle eq "semiannually"} checked{/if} onclick="recalctotals()" /></td><td class="fieldarea"><label for="cycle3">{$pricing.semiannually}</label></li>{/if}
	{if $pricing.annually}<li><input type="radio" name="billingcycle" id="cycle4" value="annually"{if $billingcycle eq "annually"} checked{/if} onclick="recalctotals()" /></td><td class="fieldarea"><label for="cycle4">{$pricing.annually}</label></li>{/if}
	 {if $pricing.biennially}<li><input type="radio" name="billingcycle" id="cycle5" value="biennially"{if $billingcycle eq "biennially"} checked{/if} onclick="recalctotals()" /></td><td class="fieldarea"><label for="cycle5">{$pricing.biennially}</label></li>{/if}
	{if $pricing.triennially}<li><input type="radio" name="billingcycle" id="cycle6" value="triennially"{if $billingcycle eq "triennially"} checked{/if} onclick="recalctotals()" /></td><td class="fieldarea"><label for="cycle6">{$pricing.triennially}</label></li>{/if}
	</ul>
</div>
</li>
{/if}

{if $productinfo.type eq "server"}
<li>
<p class="cartsubheading">{$LANG.cartconfigserver}</p>
<div class="serverconfig">
	<ul>
		<li>{$LANG.serverhostname}: <input type="text" name="hostname" size="15" value="{$server.hostname}" /> eg. server1(.yourdomain.com)</li>
		<li>{$LANG.serverns1prefix}: <input type="text" name="ns1prefix" size="10" value="{$server.ns1prefix}" /> eg. ns1(.yourdomain.com)</li>
		<li>{$LANG.serverns2prefix}: <input type="text" name="ns2prefix" size="10" value="{$server.ns2prefix}" /> eg. ns2(.yourdomain.com)</li>
		<li>{$LANG.serverrootpw}: <input type="password" name="rootpw" size="20" value="{$server.rootpw}" /></li>
	</ul>
</div></li>
{/if}

{if $configurableoptions}
<li>
<p class="cartsubheading">{$LANG.orderconfigpackage}</p>
<div class="configoptions">
<table   >
{foreach from=$configurableoptions item=configoption}
<tr><td >{$configoption.optionname}</td><td class="fieldarea">
{if $configoption.optiontype eq 1}
<select name="configoption[{$configoption.id}]" onchange="recalctotals()">
{foreach key=num2 item=options from=$configoption.options}
<option value="{$options.id}"{if $configoption.selectedvalue eq $options.id} selected="selected"{/if}>{$options.name}</option>
{/foreach}
</select>
{elseif $configoption.optiontype eq 2}
{foreach key=num2 item=options from=$configoption.options}
<input type="radio" name="configoption[{$configoption.id}]" value="{$options.id}"{if $configoption.selectedvalue eq $options.id} checked="checked"{/if} onclick="recalctotals()" /> {$options.name}<br />
{/foreach}
{elseif $configoption.optiontype eq 3}
<input type="checkbox" name="configoption[{$configoption.id}]" value="1"{if $configoption.selectedqty} checked{/if} onclick="recalctotals()" /> {$configoption.options.0.name}
{elseif $configoption.optiontype eq 4}
{if $configoption.qtymaximum}
{literal}
	<script>
	jQuery(function() {
	    {/literal}
	    var configid = '{$configoption.id}';
	    var configmin = {$configoption.qtyminimum};
	    var configmax = {$configoption.qtymaximum};
	    var configval = {if $configoption.selectedqty}{$configoption.selectedqty}{else}{$configoption.qtyminimum}{/if};
        {literal}
		jQuery("#slider"+configid).slider({
            min: configmin,
            max: configmax,
            value: configval,
            range: "min",
            slide: function( event, ui ) {
				jQuery("#confop"+configid).val( ui.value );
				jQuery("#confoplabel"+configid).html( ui.value );
                recalctotals();
			}
        });
	});
	</script>
{/literal}
<table width="90%">
	<tr>
		<td width="30" id="confoplabel{$configoption.id}" class="configoplabel">
			{if $configoption.selectedqty}{$configoption.selectedqty}{else}{$configoption.qtyminimum}{/if}
		</td>
		<td>
			<div id="slider{$configoption.id}"></div>
		</td>
	</tr>
</table>
<input type="hidden" name="configoption[{$configoption.id}]" id="confop{$configoption.id}" value="{if $configoption.selectedqty}{$configoption.selectedqty}{else}{$configoption.qtyminimum}{/if}" />
{else}
<input type="text" name="configoption[{$configoption.id}]" value="{$configoption.selectedqty}" size="5" onkeyup="recalctotals()" /> x {$configoption.options.0.name}
{/if}
{/if}
</td></tr>
{/foreach}
</table>
</div>
</li>
{/if}

{if $addons}
<li>
	<p class="cartsubheading">{$LANG.cartavailableaddons}</p>
	<div class="addons">
	<ul>
	{foreach from=$addons item=addon}
	<li><input type="checkbox" name="addons[{$addon.id}]" id="a{$addon.id}"{if $addon.status} checked{/if} onclick="recalctotals()" /></li>
	<li><label for="a{$addon.id}"><strong>{$addon.name}</strong> - {$addon.pricing}<br />{$addon.description}</label></li>

	{/foreach}
	</ul>
	</div>
</li>
{/if}

{if $customfields}
<li>
	<p class="cartsubheading">{$LANG.orderadditionalrequiredinfo}</p>
	<div class="customfields">
		<ul >
			{foreach key=num item=customfield from=$customfields}
			<li>{$customfield.name} - {$customfield.input} {$customfield.description}</li>
			{/foreach}
		</ul>
	</div>
</li>
{/if}

<li class="panel">

	
	<h3 class="cartsubheading">{$LANG.ordersummary}</h3>
	<div class="ordersummary"  id="producttotal"></div>

</li>
</ul>

	<div class="checkoutbuttons small-12 columns" >
		<input type="button" value="{$LANG.checkout} &raquo;" class="button  radius right" onclick="addtocart();" />
		<input type="button" value="{$LANG.continueshopping}" class="button secondary radius " onclick="addtocart('{$productinfo.gid}');" />
		<input type="button" value="{$LANG.viewcart}" class="button secondary radius" onclick="window.location='cart.php?a=view'" />
	</div>



<script language="javascript">recalctotals();</script>

</form>