<script type="text/javascript" src="../includes/jscript/jqueryag.js"></script>

{if $maintenancemode}
<div class="errorbox" style="font-size:14px;">
{$_ADMINLANG.home.maintenancemode}
</div>
<br />
{/if}

{if $freetrial}
<div class="errorbox" style="font-size:14px;">
You are currently running our 15 Day Free Trial!  <a href="http://dereferer.ws/?http://www.whmcs.com/order.php" target="_blank">Click here to order a full license</a>
</div>
<br />
{/if}

{$infobox}

{foreach from=$addons_html item=addon_html}
<div style="margin-bottom:15px;">{$addon_html}</div>
{/foreach}

<table width="100%" cellspacing="0" cellpadding="0"><tr>

{if $viewincometotals}
<td align="center">

<table width="90%" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><a href="transactions.php"><img src="images/icons/transactions.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.billing.income}</b></a></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.billing.incometoday}</td><td class="fieldarea"><span class="textgreen"><b>{$stats.income.today}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.billing.incomethismonth}</td><td class="fieldarea"><span class="textred"><b>{$stats.income.thismonth}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.billing.incomethisyear}</td><td class="fieldarea"><span class="textblack"><b>{$stats.income.thisyear}</b></span></td></tr>
</table>

</td>
{/if}
<td align="center">

<table width="90%" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><a href="orders.php"><img src="images/icons/orders.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.orders.title}</b></a></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Pending">{$_ADMINLANG.stats.pendingorders}</a></td><td class="fieldarea"><span class="textred"><b>{$sidebarstats.orders.pending}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.monthtodatetotal}</td><td class="fieldarea"><span class="textgreen"><b>{$stats.orders.thismonth.total}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.yeartodatetotal}</td><td class="fieldarea"><span class="textblack"><b>{$stats.orders.thisyear.total}</b></span></td></tr>
</table>

</td><td align="center">

<table width="90%" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><a href="clientshostinglist.php"><img src="images/icons/products.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.services.title}</b></a></td></tr>
<tr><td class="fieldlabel"><a href="clientshostinglist.php?status=Active">{$_ADMINLANG.status.active}</a></td><td class="fieldarea"><span class="textgreen"><b>{$sidebarstats.services.active}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientshostinglist.php?status=Suspended">{$_ADMINLANG.status.suspended}</a></td><td class="fieldarea"><span class="textred"><b>{$sidebarstats.services.suspended}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientshostinglist.php?status=Terminated">{$_ADMINLANG.status.terminated}</a></td><td class="fieldarea"><span class="textblack"><b>{$sidebarstats.services.terminated}</b></span></td></tr>
</table>

</td><td align="center">

<table width="90%" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><img src="images/icons/networkissues.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.home.misc}</b></td></tr>
<tr><td class="fieldlabel"><a href="cancelrequests.php">{$_ADMINLANG.stats.pendingcancellations}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.cancellations.pending}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="billableitems.php?status=Uninvoiced">{$_ADMINLANG.stats.uninvoicedbillableitems}</a></td><td class="fieldarea"><span class="textblack"><b>{$stats.billableitems.uninvoiced}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="networkissues.php">{$_ADMINLANG.stats.opennetworkissues}</a></td><td class="fieldarea"><span class="textred"><b>{$stats.networkissues.open}</b></span></td></tr>
</table>

</td><td align="center">

<table width="90%" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><a href="supporttickets.php?view=active"><img src="images/icons/tickets.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.support.supporttickets}</b></a></td></tr>
<tr><td class="fieldlabel"><a href="supporttickets.php">Awaiting Reply</a></td><td class="fieldarea"><span class="textgreen"><b>{$sidebarstats.tickets.awaitingreply}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="supporttickets.php?view=On Hold">On Hold</a></td><td class="fieldarea"><span class="textred"><b>{$sidebarstats.tickets.onhold}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="supporttickets.php?view=In Progress">In Progress</a></td><td class="fieldarea"><span class="testblue"><b>{$sidebarstats.tickets.inprogress}</b></span></td></tr>
</table>

</td></tr></table>

<br />

<table width="100%" cellspacing="0" cellpadding="0"><tr><td width="49%" valign="top">

<h3 align="center">{$_ADMINLANG.home.recentclientactivity}</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.client}</td><td>{$_ADMINLANG.fields.ipaddress}</td><td>{$_ADMINLANG.system.lastaccess}</td></tr>
{foreach from=$recentclients item=activity}
<tr bgcolor="#ffffff" style="text-align:center;"><td><a href="clientssummary.php?userid={$activity.id}">{$activity.firstname} {$activity.lastname}</a></td><td><a href="http://www.geoiptool.com/en/?IP={$activity.ip}" target="_blank">{$activity.ip}</a></td><td>{$activity.lastlogin}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="3">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

</td><td width="2%"></td><td width="49%" valign="top">

<h3 align="center">{$_ADMINLANG.home.recentadminactivity}</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.admin}</td><td>{$_ADMINLANG.fields.ipaddress}</td><td>{$_ADMINLANG.system.lastaccess}</td></tr>
{foreach from=$recentadmins item=activity}
<tr bgcolor="#ffffff" style="text-align:center;"><td>{$activity.username}</td><td><a href="http://www.geoiptool.com/en/?IP={$activity.ip}" target="_blank">{$activity.ip}</a></td><td>{$activity.lastvisit}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="3">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

</td></tr></table>

<h3 align="center">{$_ADMINLANG.utilities.todolist} - <a href="todolist.php">{$_ADMINLANG.home.manage}</a></h3>

<table width=100% cellspacing=1 bgcolor="#cccccc">
<tr bgcolor=#efefef style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.date}</td><td>{$_ADMINLANG.fields.title}</td><td>{$_ADMINLANG.fields.description}</td><td>{$_ADMINLANG.fields.duedate}</td><td>{$_ADMINLANG.fields.status}</td><td width="20"></td></tr>
{foreach key=num from=$todoitems item=todoitem}
<tr bgcolor="{$todoitem.bgcolor}"><td align=center>{$todoitem.date}</td><td align=center>{$todoitem.title}</td><td>{$todoitem.description|truncate:80:"..."}</td><td align=center>{$todoitem.duedate}</td><td align=center>{$todoitem.status}</td><td><a href="todolist.php?action=edit&id={$todoitem.id}"><img src="images/edit.gif" border="0"></a></td></tr>
{foreachelse}
<tr bgcolor=#ffffff><td align=center colspan=6>{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<a name="checknetwork"></a>

<h3 align="center">{$_ADMINLANG.home.networkstatus} - <a href="{$smarty.server.PHP_SELF}?checknetwork=true#checknetwork">{$_ADMINLANG.home.checknow}</a></h3>

<table width=100% bgcolor="#cccccc" cellspacing=1>
<tr style="background-color:#efefef;font-weight:bold;text-align:center"><td>{$_ADMINLANG.mergefields.servername}</td><td>HTTP</td><td>{$_ADMINLANG.home.load}</td><td>{$_ADMINLANG.home.uptime}</td><td>{$_ADMINLANG.home.percentuse}</td></tr>
{foreach key=num from=$servers item=server}
<tr bgcolor="#ffffff"><td align="center">{$server.name}</td><td align="center">{$server.http}</td><td align="center">{$server.load}</td><td align="center">{$server.uptime}</td><td align="center">{$server.usage}</td></tr>
{foreachelse}
<tr bgcolor=#ffffff><td align=center colspan=5>{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<h3 align="center">{$_ADMINLANG.home.recentactivity}</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.date}</td><td>{$_ADMINLANG.fields.description}</td><td>{$_ADMINLANG.fields.username}</td><td>{$_ADMINLANG.fields.ipaddress}</td></tr>
{foreach from=$recentactivity item=activity}
<tr bgcolor="#ffffff"><td align="center">{$activity.date}</td><td>{$activity.description}</td><td align="center">{$activity.username}</td><td align="center">{$activity.ipaddr}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="4">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<div id="geninvoices" title="{$_ADMINLANG.invoices.geninvoices}">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span>{$_ADMINLANG.invoices.geninvoicessendemails}</p>
</div>
<div id="cccapture" title="{$_ADMINLANG.invoices.attemptcccaptures}">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span>{$_ADMINLANG.invoices.attemptcccapturessure}</p>
</div>