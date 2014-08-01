<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>
<h2>{$LANG.clientareaproductdetails}</h2>
<table width="100%" cellspacing="0" cellpadding="0" class="frame">
  <tr>
    <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td width="150" class="fieldarea">{$LANG.clientareahostingregdate}:</td>
          <td>{$regdate}</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.orderproduct}:</td>
          <td>{$groupname} - {$product}</td>
        </tr>
        {if $domain}<tr>
          <td class="fieldarea">{$LANG.clientareahostingdomain}:</td>
          <td><a href="http://{$domain}" target="_blank">{$domain}</a></td>
        </tr>
        {/if}
        {foreach from=$configoptions item=configoption}<tr>
          <td class="fieldarea">{$configoption.optionname}:</td>
          <td>{if $configoption.optiontype eq 3}{if $configoption.selectedqty}{$LANG.yes}{else}{$LANG.no}{/if}{elseif $configoption.optiontype eq 4}{$configoption.selectedqty} x {$configoption.selectedoption}{else}{$configoption.selectedoption}{/if}</td>
        </tr>
        {/foreach}
        {foreach from=$customfields item=customfield}
        <tr>
          <td class="fieldarea">{$customfield.name}:</td>
          <td>{$customfield.value}</td>
        </tr>
        {/foreach}
        {if $lastupdate}
        <tr>
          <td class="fieldarea">{$LANG.clientareadiskusage}:</td>
          <td>{$diskusage}MB / {$disklimit}MB (<strong>{$diskpercent}</strong>)</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.clientareabwusage}:</td>
          <td>{$bwusage}MB / {$bwlimit}MB (<strong>{$bwpercent}</strong>)</td>
        </tr>
        {/if}
        <tr>
          <td class="fieldarea">{$LANG.orderpaymentmethod}:</td>
          <td>{$paymentmethod}</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.firstpaymentamount}:</td>
          <td>{$firstpaymentamount}</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.recurringamount}:</td>
          <td>{$recurringamount}</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.clientareahostingnextduedate}:</td>
          <td>{$nextduedate}</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.orderbillingcycle}:</td>
          <td>{$billingcycle}</td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.clientareastatus}:</td>
          <td>{$status}</td>
        </tr>
    </table></td>
  </tr>
</table>

<p align="center">{$serverclientarea}</p>

{if $username}

{if $serverchangepassword}
<form method="post" action="{$smarty.server.PHP_SELF}?action=productdetails">
  <input type="hidden" name="id" value="{$id}" />
  <input type="hidden" name="serverchangepassword" value="true" />
  {/if}
  <h3>{$LANG.serverlogindetails}</h3>
  {if $serverchangepasswordmessage}
  <div class="errorbox">{$serverchangepasswordmessage|replace:'
    <li>':' &nbsp;#&nbsp; '} &nbsp;#&nbsp; 
  </div>
  <br />
  {/if}
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea">{$LANG.serverusername}/{$LANG.serverpassword}:</td>
            <td colspan="2">{$username}{if $password} / {$password}{/if}</td>
          </tr>
          {if $serverchangepassword}
          <tr>
            <td width="150" class="fieldarea">{$LANG.serverchangepasswordenter}:</td>
            <td width="175"><input type="password" name="newserverpassword1" id="newpw" size="25" /></td>
            <td><script language="javascript">showStrengthBar();</script></td>
          </tr>
          <tr>
            <td class="fieldarea">{$LANG.serverchangepasswordconfirm}:</td>
            <td colspan="2"><input type="password" name="newserverpassword2" size="25" /></td>
          </tr>
          {/if}
      </table></td>
    </tr>
  </table>
  {if $serverchangepassword}
  <p align="center">
    <input type="submit" value="{$LANG.serverchangepasswordupdate}" class="button" />
  </p>
</form>
{/if}

{/if}

{if $downloads}
<h3>{$LANG.downloadstitle}</h3>
{foreach key=num item=download from=$downloads}
<table width="100%" cellspacing="0" cellpadding="0" class="frame">
  <tr>
    <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td width="150" class="fieldarea">{$LANG.downloadname}:</td>
          <td>{$download.type} <a href="{$download.link}">{$download.title}</a></td>
        </tr>
        <tr>
          <td class="fieldarea">{$LANG.downloaddescription}:</td>
          <td>{$download.description}</td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
{/foreach}

{/if}
<h3>{$LANG.clientareaaccountaddons}</h3>
<p>{if $addonsavailable}<a href="cart.php?gid=addons&pid={$id}">{$LANG.orderavailableaddons}</a>{/if}</p>
<table class="data" width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th>{$LANG.clientareaaddon}</th>
    <th>{$LANG.clientareaaddonpricing}</th>
    <th>{$LANG.clientareahostingnextduedate}</th>
  </tr>
  {foreach key=num item=addon from=$addons}
  <tr class="{$addon.class}">
    <td>{$addon.name}</td>
    <td align="center">{$addon.pricing}</td>
    <td align="center">{$addon.nextduedate}</td>
  </tr>
  {foreachelse}
  <tr>
    <td colspan="3">{$LANG.clientareanoaddons}</td>
  </tr>
  {/foreach}
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatableactive">
          <td></td>
        </tr>
    </table></td>
    <td>{$LANG.clientareaactive}</td>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatablepending">
          <td></td>
        </tr>
    </table></td>
    <td>{$LANG.clientareapending}</td>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatablesuspended">
          <td></td>
        </tr>
    </table></td>
    <td>{$LANG.clientareasuspended}</td>
    <td width="10" align="right"><table style="width:10px;height:10px;" cellspacing="1" class="clientareatable">
        <tr class="clientareatableterminated">
          <td></td>
        </tr>
    </table></td>
    <td>{$LANG.clientareaterminated}</td>
  </tr>
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td><input type="button" value="{$LANG.clientareabacklink}" onclick="window.location='clientarea.php?action=products'" class="button" /></td>
    {if $packagesupgrade}<td>
      <form method="post" action="upgrade.php">
        <input type="hidden" name="id" value="{$id}" />
        <input type="hidden" name="type" value="package" />
        <p>
          <input type="submit" value="{$LANG.upgradedowngradepackage}" class="button" />
        </p>
      </form>
      </td>{/if}
    {if $configoptionsupgrade}<td>
      <form method="post" action="upgrade.php">
        <input type="hidden" name="id" value="{$id}" />
        <input type="hidden" name="type" value="configoptions" />
        <p>
          <input type="submit" value="{$LANG.upgradedowngradeconfigoptions}" class="button" />
        </p>
      </form>
      </td>{/if}
    {if $showcancelbutton}<td align="center">
      <input type="button" value="{$LANG.clientareacancelrequestbutton}" onclick="window.location='clientarea.php?action=cancel&amp;id={$id}'" class="button" />
      </td>{/if}
  </tr>
</table><br />