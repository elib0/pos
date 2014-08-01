
<h3>{if $domain eq "register"}{$LANG.registerdomain}{elseif $domain eq "transfer"}{$LANG.transferdomain}{/if}</h3>



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
<a href="cart.php?a=add&domain{$domain}&currency={$curr.id}"><img src="images/flags/{if $curr.code eq "AUD"}au{elseif $curr.code eq "CAD"}ca{elseif $curr.code eq "EUR"}eu{elseif $curr.code eq "GBP"}gb{elseif $curr.code eq "INR"}in{elseif $curr.code eq "JPY"}jp{elseif $curr.code eq "USD"}us{elseif $curr.code eq "ZAR"}za{else}na{/if}.png" border="0" alt="" /> {$curr.code}</a>
{/foreach}
</div>
<div class="clear"></div>
{else}
<br />
{/if}

<br />

<div class="panel">

<p>{if $domain eq "register"}{$LANG.registerdomaindesc}{else}{$LANG.transferdomaindesc}{/if}</p>

{if $errormessage}<div class="errorbox">{$errormessage|replace:'<li>':' &nbsp;#&nbsp; '} &nbsp;#&nbsp; </div><br />{/if}

<form onsubmit="checkavailability();return false">


		<div class="row collapse">
            <div class="small-1 columns">
              <span class="prefix radius">www.</span>
            </div>
            <div class="small-10 columns">
              <input type="text" id="sld" class="imput-domains" value="{$sld}" /> 
            </div>
            <div class="small-1 columns">
              <select name="tld" id="tld" class="button radius postfix" >
                {foreach key=num item=listtld from=$tlds}
                <option value="{$listtld}"{if $listtld eq $tld} selected="selected"{/if}>{$listtld}</option>
                {/foreach}
             </select> 
            </div>
            
          </div>

        
        <input type="submit" class="button  radius" value="{$LANG.checkavailability}" />



</form>

</div>

<div id="loading" style='display:none'><img src="images/loading.gif" border="0" alt="{$LANG.loading}" /></div>

<form method="post" action="cart.php?a=add&domain={$domain}">

<div id="domainresults"></div>

</form>

{literal}
<script language="javascript">
function checkavailability() {

    jQuery("#loading").slideDown();
    jQuery.post("cart.php", { ajax: 1, a: "domainoptions", sld: jQuery("#sld").val(), tld: jQuery("#tld").val(), checktype: '{/literal}{$domain}{literal}' },
    function(data){
        jQuery("#domainresults").html(data);
        jQuery("#domainresults").slideDown();
        jQuery("#loading").slideUp();

        jQuery("#domainresults p a").addClass('button radius');
        jQuery("#domainresults p input").addClass('button radius');
        jQuery("#domainresults .domainavailable").addClass('button success radius');
        jQuery("#domainresults .domainunavailable").addClass('button alert radius');
        jQuery("#domainresults .domaininvalid").addClass('button secondary radius');
    });
}
function cancelcheck() {
    jQuery("#domainresults").slideUp();

}
</script>
{/literal}