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

{if $viewincometotals}<div class="contentbox" style="font-size:18px;"><a href="transactions.php"><img src="images/icons/transactions.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.billing.income}</b></a> {$_ADMINLANG.billing.incometoday}: <span class="textgreen"><b>{$stats.income.today}</b></span> {$_ADMINLANG.billing.incomethismonth}: <span class="textred"><b>{$stats.income.thismonth}</b></span> {$_ADMINLANG.billing.incomethisyear}: <span class="textblack"><b>{$stats.income.thisyear}</b></span></div>

<br />{/if}

{foreach from=$addons_html item=addon_html}
<div style="margin-bottom:15px;">{$addon_html}</div>
{/foreach}

<table width="100%" cellspacing="0" cellpadding="0"><tr><td align="center">

<table width="250" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><a href="orders.php?status=Pending"><img src="images/icons/orders.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.orders.title}</b></a></td></tr>
<tr><td width="160" class="fieldlabel"><a href="orders.php">{$_ADMINLANG.stats.todaysorders}</a></td><td class="fieldarea"><span class="textblue"><b>{$stats.orders.today.total}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Pending">{$_ADMINLANG.stats.todayspending}</a></td><td class="fieldarea"><span class="textred"><b>{$stats.orders.today.pending}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Active">{$_ADMINLANG.stats.todayscompleted}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.orders.today.active}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.yesterdaysorders}</td><td class="fieldarea"><span class="textblue"><b>{$stats.orders.yesterday.total}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.yesterdayscompleted}</td><td class="fieldarea"><span class="textgreen"><b>{$stats.orders.yesterday.active}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.monthtodatetotal}</td><td class="fieldarea"><span class="textgold"><b>{$stats.orders.thismonth.total}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.yeartodatetotal}</td><td class="fieldarea"><span class="textblack"><b>{$stats.orders.thisyear.total}</b></span></td></tr>
</table>

</td><td align="center">

<table width="250" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><img src="images/icons/stats.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.stats.title}</b></td></tr>
<tr><td width="180" class="fieldlabel"><a href="clients.php?status=Active">{$_ADMINLANG.stats.activeclients}</a></td><td class="fieldarea"><span class="textgreen"><b>{$sidebarstats.clients.active}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="invoices.php?status=Unpaid">{$_ADMINLANG.stats.unpaidinvoices}</a></td><td class="fieldarea"><span class="textred"><b>{$sidebarstats.invoices.unpaid}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="invoices.php?status=Overdue">{$_ADMINLANG.stats.overdueinvoices}</a></td><td class="fieldarea"><span class="textblack"><b>{$sidebarstats.invoices.overdue}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientsdomainlist.php?status=Pending%20Transfer">{$_ADMINLANG.stats.pendingtransferdomains}</a></td><td class="fieldarea"><span class="textgold"><b>{$sidebarstats.domains.pendingtransfer}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientshostinglist.php?status=Suspended">{$_ADMINLANG.stats.suspendedservices}</a></td><td class="fieldarea"><span class="testblue"><b>{$sidebarstats.services.suspended}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="billableitems.php?status=Uninvoiced">{$_ADMINLANG.stats.uninvoicedbillableitems}</a></td><td class="fieldarea"><span class="textred"><b>{$stats.billableitems.uninvoiced}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="quotes.php?validity=Valid">{$_ADMINLANG.stats.validquotes}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.quotes.valid}</b></span></td></tr>
</table>

</td><td width="400">

<img src="reports.php?displaygraph=graph_monthly_signups&homepage=true">

</td></tr></table>

<br />

<div class="errorbox" style="font-size:14px;"><a href="supporttickets.php">{$sidebarstats.tickets.awaitingreply} {$_ADMINLANG.stats.ticketsawaitingreply}</a> || <a href="cancelrequests.php">{$stats.cancellations.pending} {$_ADMINLANG.stats.pendingcancellations}</a> || <a href="todolist.php">{$stats.todoitems.due} {$_ADMINLANG.stats.todoitemsdue}</a> || <a href="networkissues.php">{$stats.networkissues.open} {$_ADMINLANG.stats.opennetworkissues}</a></div>

<br />

<div class="contentbox"><form method="post" action="index.php"><input type="hidden" name="action" value="savenotes"><table width="100%"><tr><td width="40"><b>{$_ADMINLANG.global.mynotes}</b></td><td><textarea name="notes" class="expanding" style="width:95%;">{$adminnotes}</textarea></td><td width="40"><input type="submit" value="{$_ADMINLANG.global.savechanges}"></td></tr></table></form></div>

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
<tr bgcolor="#ffffff"><td align="center" colspan="6">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<a name="checknetwork"></a>

<h3 align="center">{$_ADMINLANG.home.networkstatus} - <a href="{$smarty.server.PHP_SELF}?checknetwork=true#checknetwork">{$_ADMINLANG.home.checknow}</a></h3>

<table width=100% bgcolor="#cccccc" cellspacing=1>
<tr style="background-color:#efefef;font-weight:bold;text-align:center"><td>{$_ADMINLANG.mergefields.servername}</td><td>HTTP</td><td>{$_ADMINLANG.home.load}</td><td>{$_ADMINLANG.home.uptime}</td><td>{$_ADMINLANG.home.percentuse}</td></tr>
{foreach key=num from=$servers item=server}
<tr bgcolor="#ffffff"><td align="center">{$server.name}</td><td align="center">{$server.http}</td><td align="center">{$server.load}</td><td align="center">{$server.uptime}</td><td align="center">{$server.usage}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="5">{$_ADMINLANG.global.norecordsfound}</td></tr>
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