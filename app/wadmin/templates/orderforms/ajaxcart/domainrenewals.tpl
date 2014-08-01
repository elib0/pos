{include file='orderforms/ajaxcart/ajaxcartheader.tpl'}

<div id="renewalscontainer">

<h2>{$LANG.cartchooseproduct}</h2>

<table width="100%" cellspacing="0" cellpadding="0">
<tr class="rowcolor1"><td>
{foreach from=$productgroups item=group}<input type="radio" name="gid" value="{$group.gid}" id="gid{$group.gid}" onclick="window.location='cart.php?gid={$group.gid}'"{if $group.gid eq $gid} checked{/if} /> <label for="gid{$group.gid}">{$group.name}</label> {/foreach}
{if $loggedin}<input type="radio" name="gid" id="gidaddons" onclick="window.location='cart.php?gid=addons'" /> <label for="gidaddons">{$LANG.cartproductaddons}</label>
<input type="radio" name="gid" id="gidrenewals" onclick="window.location='cart.php?gid=renewals'" checked /> <label for="gidrenewals">{$LANG.domainrenewals}</label> {/if}
{if $registerdomainenabled}<input type="radio" name="gid" id="gidregdomain" onclick="window.location='cart.php?a=add&domain=register'" /> <label for="gidregdomain">{$LANG.registerdomain}</label> {/if}
{if $transferdomainenabled}<input type="radio" name="gid" id="gidtransdomain" onclick="window.location='cart.php?a=add&domain=transfer'" /> <label for="gidtransdomain">{$LANG.transferdomain}</label>{/if}
</td></tr>
</table>

<h2>{$LANG.domainrenewals}</h2>

<p>{$LANG.domainrenewdesc}</p>

{foreach from=$renewals key=num item=renewal}
<div class="addoncontainer">
<div class="addon">
<div class="title">{$renewal.domain}</div>
<div class="pricing">
    {if $renewal.daysuntilexpiry > 30}
    <span class="textgreen">{$renewal.daysuntilexpiry} {$LANG.domainrenewalsdays}</span>
    {elseif $renewal.daysuntilexpiry > 0}
    <span class="textred">{$renewal.daysuntilexpiry} {$LANG.domainrenewalsdays}</span>
    {else}
    <span class="textblack">{$renewal.daysuntilexpiry*-1} {$LANG.domainrenewalsdaysago}</span>
    {/if}
    <br />
    <span style="font-size:11px;color: #000;">{$LANG.domaindaysuntilexpiry}</span>
</div>
<div class="clear"></div>
{$addon.description}
<div class="product">
<select id="renewalperiod{$num}">
    {foreach from=$renewal.renewaloptions item=renewaloption}
    <option value="{$renewaloption.period}">{$renewaloption.period} {$LANG.orderyears} @ {$renewaloption.price}</option>
    {/foreach}
</select> <input type="submit" value="{$LANG.addtocart} &raquo;" onclick="renewaladdtocart('{$renewal.id}','{$num}')" />
</div>
</div>
</div>
{foreachelse}
<div class="errorbox">{$LANG.domainrenewalsnoneavailable}</div>
{/foreach}
<div class="clear"></div>

</div>

<div id="signupcontainer"></div>

{include file='orderforms/ajaxcart/ajaxcartfooter.tpl'}