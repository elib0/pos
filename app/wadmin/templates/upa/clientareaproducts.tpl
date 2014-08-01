<h2>{$LANG.clientareaproducts}</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td>{$numproducts} {$LANG.recordsfound},  {$LANG.page} {$pagenumber} {$LANG.pageof} {$totalpages}</td>
    <td align="right">{if $prevpage}<a href="clientarea.php?action=products&amp;page={$prevpage}">{/if}&laquo; {$LANG.previouspage}{if $prevpage}</a>{/if} &nbsp; {if $nextpage}<a href="clientarea.php?action=products&amp;page={$nextpage}">{/if}{$LANG.nextpage} &raquo;{if $nextpage}</a>{/if}</td>
  </tr>
</table>
<br />
<table class="data" width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <th>{$LANG.orderproduct}</th>
    <th>{$LANG.orderprice}</th>
    <th>{$LANG.orderbillingcycle}</th>
    <th>{$LANG.clientareahostingnextduedate}</th>
    <th width="20">&nbsp;</th>
  </tr>
  {foreach key=num item=service from=$services}
  <tr class="clientareatable{$service.class}">
    <td>{$service.group} - {$service.product}{if $service.domain}<br />
    <a href="http://{$service.domain}" target="_blank">{$service.domain}</a>{/if}</td>
    <td>{$service.amount}</td>
    <td>{$service.billingcycle}</td>
    <td>{$service.nextduedate}</td>
    <td><form method="post" action="{$smarty.server.PHP_SELF}?action=productdetails">
        <input type="hidden" name="id" value="{$service.id}" />
        <input type="image" src="images/viewdetails.gif" alt="{$LANG.clientareaviewdetails}" />
    </form></td>
  </tr>
  {foreachelse}
  <tr>
    <td colspan="6">{$LANG.norecordsfound}</td>
  </tr>
  {/foreach}
</table>
<br />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td>{$LANG.show}: <a href="clientarea.php?action=products&itemlimit=10">10</a> <a href="clientarea.php?action=products&itemlimit=25">25</a> <a href="clientarea.php?action=products&itemlimit=50">50</a> <a href="clientarea.php?action=products&itemlimit=100">100</a> <a href="clientarea.php?action=products&itemlimit=all">{$LANG.all}</a></td>
    <td align="right">{if $prevpage}<a href="clientarea.php?action=products&amp;page={$prevpage}">{/if}&laquo; {$LANG.previouspage}{if $prevpage}</a>{/if} &nbsp; {if $nextpage}<a href="clientarea.php?action=products&amp;page={$nextpage}">{/if}{$LANG.nextpage} &raquo;{if $nextpage}</a>{/if}</td>
  </tr>
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="10" align="right" class="clientareatableactive">&nbsp;</td>
    <td>{$LANG.clientareaactive}</td>
    <td width="10" align="right" class="clientareatablepending">&nbsp;</td>
    <td>{$LANG.clientareapending}</td>
    <td width="10" align="right" class="clientareatablesuspended">&nbsp;</td>
    <td>{$LANG.clientareasuspended}</td>
    <td width="10" align="right" class="clientareatableterminated">&nbsp;</td>
    <td>{$LANG.clientareaterminated}</td>
  </tr>
</table><br />