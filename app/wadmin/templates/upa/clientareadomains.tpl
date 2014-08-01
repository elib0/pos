<h2>{$LANG.clientareanavdomains}</h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td>{$numproducts} {$LANG.recordsfound},  {$LANG.page} {$pagenumber} {$LANG.pageof} {$totalpages}</td>
    <td align="right">{if $prevpage}<a href="clientarea.php?action=domains&amp;page={$prevpage}">{/if}&laquo; {$LANG.previouspage}{if $prevpage}</a>{/if} &nbsp; {if $nextpage}<a href="clientarea.php?action=domains&amp;page={$nextpage}">{/if}{$LANG.nextpage} &raquo;{if $nextpage}</a>{/if}</td>
  </tr>
</table>
<br />
<table class="data" width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <th>{$LANG.clientareahostingregdate}</th>
    <th>{$LANG.clientareahostingdomain}</th>
    <th>{$LANG.clientareahostingnextduedate}</th>
    <th>{$LANG.orderprice}</th>
    <th width="20">&nbsp;</th>
  </tr>
  {foreach key=num item=domain from=$domains}
  <tr class="clientareatable{if $domain.status eq "expired"}terminated{else}{$domain.status}{/if}">
    <td>{$domain.registrationdate}</td>
    <td><a href="http://{$domain.domain}" target="_blank">{$domain.domain}</a></td>
    <td>{$domain.nextduedate}</td>
    <td>{$domain.amount}</td>
    <td><form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails">
        <input type="hidden" name="id" value="{$domain.id}">
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
    <td>{$LANG.show}: <a href="clientarea.php?action=domains&itemlimit=10">10</a> <a href="clientarea.php?action=domains&itemlimit=25">25</a> <a href="clientarea.php?action=domains&itemlimit=50">50</a> <a href="clientarea.php?action=domains&itemlimit=100">100</a> <a href="clientarea.php?action=domains&itemlimit=all">{$LANG.all}</a></td>
    <td align="right">{if $prevpage}<a href="clientarea.php?action=domains&amp;page={$prevpage}">{/if}&laquo; {$LANG.previouspage}{if $prevpage}</a>{/if} &nbsp; {if $nextpage}<a href="clientarea.php?action=domains&amp;page={$nextpage}">{/if}{$LANG.nextpage} &raquo;{if $nextpage}</a>{/if}</td>
  </tr>
</table>
<br />
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="10" align="right" class="clientareatableactive">&nbsp;</td>
    <td>{$LANG.clientareaactive}</td>
    <td width="10" align="right" class="clientareatablepending">&nbsp;</td>
    <td>{$LANG.clientareapending}</td>
    <td width="10" align="right" class="clientareatableterminated">&nbsp;</td>
    <td>{$LANG.clientareaterminated}</td>
  </tr>
</table><br />