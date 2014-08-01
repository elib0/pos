<script type="text/javascript" src="../includes/jscript/jqueryag.js"></script>

{if $maintenancemode}
<div align="center" class="errorbox">
{$_ADMINLANG.home.maintenancemode}
</div>
<br />
{/if}

{if $freetrial}
<div align="center" class="errorbox">
You are currently running our 15 Day Free Trial!  <a href="http://dereferer.ws/?http://www.whmcs.com/order.php" target="_blank">Click here to order a full license</a>
</div>
<br />
{/if}

{$infobox}

<div class="errorbox">{$_ADMINLANG.home.quicksummary} &nbsp; &raquo; &nbsp; <span style="color:#000000;">{if $viewincometotals}{$_ADMINLANG.stats.todaysincome}: {$stats.income.today} &nbsp; - &nbsp; {/if}{$_ADMINLANG.stats.pendingorders}: {$stats.orders.today.pending} &nbsp; - &nbsp; {$_ADMINLANG.stats.pendingcancellations}: {$stats.cancellations.pending} &nbsp; - &nbsp; {$_ADMINLANG.stats.overdueinvoices}: {$sidebarstats.invoices.overdue}</span></div>

<br />

{foreach from=$addons_html item=addon_html}
<div style="margin-bottom:15px;">{$addon_html}</div>
{/foreach}

<table align="center"><tr><td valign="top">

{php}
$sidebarstats = $this->_tpl_vars["sidebarstats"];
$stats = $this->_tpl_vars["stats"];
{/php}

<table width="250" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.clients.title}</strong></div></td></tr>
<tr><td width="75" align="right"><a href="clients.php?status=Active">{$_ADMINLANG.status.active}</a></td><td width="104"><img src="images/percentbar.png" class="greenbar" style="background-position: -{php} echo 100-(round($sidebarstats["clients"]["active"]/($sidebarstats["clients"]["active"]+$sidebarstats["clients"]["inactive"]+$sidebarstats["clients"]["closed"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.clients.active}</td></tr>
<tr><td align="right"><a href="clients.php?status=Inactive">{$_ADMINLANG.status.inactive}</a></td><td><img src="images/percentbar.png" class="bluebar" style="background-position: -{php} echo 100-(round($sidebarstats["clients"]["inactive"]/($sidebarstats["clients"]["active"]+$sidebarstats["clients"]["inactive"]+$sidebarstats["clients"]["closed"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.clients.inactive}</td></tr>
<tr><td align="right"><a href="clients.php?status=Closed">{$_ADMINLANG.status.closed}</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($sidebarstats["clients"]["closed"]/($sidebarstats["clients"]["active"]+$sidebarstats["clients"]["inactive"]+$sidebarstats["clients"]["closed"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.clients.closed}</td></tr>
</table>

<img src="images/spacer.gif" width="1" height="4"><br>

<table width="250" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.support.supporttickets}</strong></div></td></tr>
<tr><td width="90" align="right"><a href="supporttickets.php?view=Open">Open</a></td><td width="104"><img src="images/percentbar.png" class="goldbar" style="background-position: -{php} echo 100-(round($stats["tickets"]["open"]/($stats["tickets"]["open"]+$stats["tickets"]["answered"]+$stats["tickets"]["customerreply"]+$stats["tickets"]["onhold"]+$stats["tickets"]["inprogress"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.tickets.open}</td></tr>
<tr><td align="right"><a href="supporttickets.php?view=Answered">Answered</a></td><td><img src="images/percentbar.png" class="greenbar" style="background-position: -{php} echo 100-(round($stats["tickets"]["answered"]/($stats["tickets"]["open"]+$stats["tickets"]["answered"]+$stats["tickets"]["customerreply"]+$stats["tickets"]["onhold"]+$stats["tickets"]["inprogress"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.tickets.answered}</td></tr>
<tr><td align="right"><a href="supporttickets.php?view=Customer-Reply">Customer-Reply</a></td><td><img src="images/percentbar.png" class="bluebar" style="background-position: -{php} echo 100-(round($stats["tickets"]["customerreply"]/($stats["tickets"]["open"]+$stats["tickets"]["answered"]+$stats["tickets"]["customerreply"]+$stats["tickets"]["onhold"]+$stats["tickets"]["inprogress"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.tickets.customerreply}</td></tr>
<tr><td align="right"><a href="supporttickets.php?view=On Hold">On Hold</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($stats["tickets"]["onhold"]/($stats["tickets"]["open"]+$stats["tickets"]["answered"]+$stats["tickets"]["customerreply"]+$stats["tickets"]["onhold"]+$stats["tickets"]["inprogress"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.tickets.onhold}</td></tr>
<tr><td align="right"><a href="supporttickets.php?view=In Progress">In Progress</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($stats["tickets"]["inprogress"]/($stats["tickets"]["open"]+$stats["tickets"]["answered"]+$stats["tickets"]["customerreply"]+$stats["tickets"]["onhold"]+$stats["tickets"]["inprogress"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.tickets.inprogress}</td></tr>
</table>

</td><td valign="top">

<table width="250" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.services.title}</strong></div></td></tr>
<tr><td width="75" align="right"><a href="clientshostinglist.php?status=Pending">{$_ADMINLANG.status.pending}</a></td><td width="104"><img src="images/percentbar.png" class="goldbar" style="background-position: -{php} echo 100-(round($sidebarstats["services"]["pending"]/($sidebarstats["services"]["pending"]+$sidebarstats["services"]["active"]+$sidebarstats["services"]["suspended"]+$sidebarstats["services"]["terminated"]+$sidebarstats["services"]["cancelled"]+$sidebarstats["services"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.services.pending}</td></tr>
<tr><td align="right"><a href="clientshostinglist.php?status=Active">{$_ADMINLANG.status.active}</a></td><td><img src="images/percentbar.png" class="greenbar" style="background-position: -{php} echo 100-(round($sidebarstats["services"]["active"]/($sidebarstats["services"]["pending"]+$sidebarstats["services"]["active"]+$sidebarstats["services"]["suspended"]+$sidebarstats["services"]["terminated"]+$sidebarstats["services"]["cancelled"]+$sidebarstats["services"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.services.active}</td></tr>
<tr><td align="right"><a href="clientshostinglist.php?status=Suspended">{$_ADMINLANG.status.suspended}</a></td><td><img src="images/percentbar.png" class="bluebar" style="background-position: -{php} echo 100-(round($sidebarstats["services"]["suspended"]/($sidebarstats["services"]["pending"]+$sidebarstats["services"]["active"]+$sidebarstats["services"]["suspended"]+$sidebarstats["services"]["terminated"]+$sidebarstats["services"]["cancelled"]+$sidebarstats["services"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.services.suspended}</td></tr>
<tr><td align="right"><a href="clientshostinglist.php?status=Terminated">{$_ADMINLANG.status.terminated}</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($sidebarstats["services"]["terminated"]/($sidebarstats["services"]["pending"]+$sidebarstats["services"]["active"]+$sidebarstats["services"]["suspended"]+$sidebarstats["services"]["terminated"]+$sidebarstats["services"]["cancelled"]+$sidebarstats["services"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.services.terminated}</td></tr>
<tr><td align="right"><a href="clientshostinglist.php?status=Cancelled">{$_ADMINLANG.status.cancelled}</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($sidebarstats["services"]["cancelled"]/($sidebarstats["services"]["pending"]+$sidebarstats["services"]["active"]+$sidebarstats["services"]["suspended"]+$sidebarstats["services"]["terminated"]+$sidebarstats["services"]["cancelled"]+$sidebarstats["services"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.services.cancelled}</td></tr>
<tr><td align="right"><a href="clientshostinglist.php?status=Fraud">{$_ADMINLANG.status.fraud}</a></td><td><img src="images/percentbar.png" class="blackbar" style="background-position: -{php} echo 100-(round($sidebarstats["services"]["fraud"]/($sidebarstats["services"]["pending"]+$sidebarstats["services"]["active"]+$sidebarstats["services"]["suspended"]+$sidebarstats["services"]["terminated"]+$sidebarstats["services"]["cancelled"]+$sidebarstats["services"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.services.fraud}</td></tr>
</table>

<img src="images/spacer.gif" width="1" height="4"><br>

<table width="250" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.stats.todaysorders}</strong></div></td></tr>
<tr><td width="75" align="right"><a href="orders.php?filter=true&status=Pending">{$_ADMINLANG.status.pending}</a></td><td width="104"><img src="images/percentbar.png"class="redbar" style="background-position: -{php} if ($stats["orders"]["today"]["total"]) echo 100-(round($stats["orders"]["today"]["pending"]/$stats["orders"]["today"]["total"],2)*100); else echo "100"; {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.orders.today.pending}</td></tr>
<tr><td align="right"><a href="orders.php?filter=true&status=Active">{$_ADMINLANG.status.active}</a></td><td><img src="images/percentbar.png" alt="{$todaysactiveorderspercent}%" title="{$todaysactiveorderspercent}%" class="goldbar" style="background-position: -{php} if ($stats["orders"]["today"]["total"]) echo 100-(round($stats["orders"]["today"]["active"]/$stats["orders"]["today"]["total"],2)*100); else echo "100"; {/php}px 0pt;" /></td><td class="fieldareasmall">{$stats.orders.today.active}</td></tr>
</table>

</td><td valign="top">

<table width="250" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.domains.title}</strong></div></td></tr>
<tr><td width="90" align="right"><a href="clientsdomainlist.php?status=Pending">{$_ADMINLANG.status.pending}</a></td><td width="104"><img src="images/percentbar.png" class="goldbar" style="background-position: -{php} echo 100-(round($sidebarstats["domains"]["pending"]/($sidebarstats["domains"]["pending"]+$sidebarstats["domains"]["pendingtransfer"]+$sidebarstats["domains"]["active"]+$sidebarstats["domains"]["expired"]+$sidebarstats["domains"]["cancelled"]+$sidebarstats["domains"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.domains.pending}</td></tr>
<tr><td align="right"><a href="clientsdomainlist.php?status=Pending Transfer">{$_ADMINLANG.status.pendingtransfer}</a></td><td width="104"><img src="images/percentbar.png" class="goldbar" style="background-position: -{php} echo 100-(round($sidebarstats["domains"]["pendingtransfer"]/($sidebarstats["domains"]["pending"]+$sidebarstats["domains"]["pendingtransfer"]+$sidebarstats["domains"]["active"]+$sidebarstats["domains"]["expired"]+$sidebarstats["domains"]["cancelled"]+$sidebarstats["domains"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.domains.pendingtransfer}</td></tr>
<tr><td align="right"><a href="clientsdomainlist.php?status=Active">{$_ADMINLANG.status.active}</a></td><td><img src="images/percentbar.png" class="greenbar" style="background-position: -{php} echo 100-(round($sidebarstats["domains"]["active"]/($sidebarstats["domains"]["pending"]+$sidebarstats["domains"]["pendingtransfer"]+$sidebarstats["domains"]["active"]+$sidebarstats["domains"]["expired"]+$sidebarstats["domains"]["cancelled"]+$sidebarstats["domains"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.domains.active}</td></tr>
<tr><td align="right"><a href="clientsdomainlist.php?status=Expired">{$_ADMINLANG.status.expired}</a></td><td><img src="images/percentbar.png" class="bluebar" style="background-position: -{php} echo 100-(round($sidebarstats["domains"]["expired"]/($sidebarstats["domains"]["pending"]+$sidebarstats["domains"]["pendingtransfer"]+$sidebarstats["domains"]["active"]+$sidebarstats["domains"]["expired"]+$sidebarstats["domains"]["cancelled"]+$sidebarstats["domains"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.domains.expired}</td></tr>
<tr><td align="right"><a href="clientsdomainlist.php?status=Cancelled">{$_ADMINLANG.status.cancelled}</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($sidebarstats["domains"]["cancelled"]/($sidebarstats["domains"]["pending"]+$sidebarstats["domains"]["pendingtransfer"]+$sidebarstats["domains"]["active"]+$sidebarstats["domains"]["expired"]+$sidebarstats["domains"]["cancelled"]+$sidebarstats["domains"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.domains.cancelled}</td></tr>
<tr><td align="right"><a href="clientsdomainlist.php?status=Fraud">{$_ADMINLANG.status.fraud}</a></td><td><img src="images/percentbar.png" class="blackbar" style="background-position: -{php} echo 100-(round($sidebarstats["domains"]["fraud"]/($sidebarstats["domains"]["pending"]+$sidebarstats["domains"]["pendingtransfer"]+$sidebarstats["domains"]["active"]+$sidebarstats["domains"]["expired"]+$sidebarstats["domains"]["cancelled"]+$sidebarstats["domains"]["fraud"]),2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.domains.fraud}</td></tr>
</table>

<img src="images/spacer.gif" width="1" height="4"><br>

<table width="250" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.invoices.title}</strong></div></td></tr>
<tr><td width="60" align="right"><a href="invoices.php?status=Unpaid">{$_ADMINLANG.status.unpaid}</a></td><td width="104"><img src="images/percentbar.png" alt="100%" title="100%" class="goldbar" style="background-position: 0px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.invoices.unpaid}</td></tr>
<tr><td align="right"><a href="invoices.php?status=Overdue">{$_ADMINLANG.status.overdue}</a></td><td><img src="images/percentbar.png" class="redbar" style="background-position: -{php} echo 100-(round($sidebarstats["invoices"]["overdue"]/$sidebarstats["invoices"]["unpaid"],2)*100); {/php}px 0pt;" /></td><td class="fieldareasmall">{$sidebarstats.invoices.overdue}</td></tr>
</table>

</td></tr></table>

<form method="post" action="{$smarty.server.PHP_SELF}?action=savenotes">
<table width="758" align="center" class="form">
<tr><td colspan=3 class="fieldarea"><div align="center"><strong>{$_ADMINLANG.global.mynotes}</strong></div></td></tr>
<tr><td class="fieldareasmall"><textarea name="notes" class="expanding" style="width:99%;border:1px dashed #8FBCE9;">{$adminnotes}</textarea></td></tr>
<tr><td align=center class="fieldareasmall"><input type="submit" value="{$_ADMINLANG.global.savechanges}" class="button" style="font-size:10px;height:16px;"></td></tr>
</table>
</form>

<h2>{$_ADMINLANG.utilities.todolist} - <a href="todolist.php">{$_ADMINLANG.home.manage}</a></h2>
<table width=100% cellspacing=1 bgcolor="#cccccc">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.date}</td><td>{$_ADMINLANG.fields.title}</td><td>{$_ADMINLANG.fields.description}</td><td>{$_ADMINLANG.fields.duedate}</td><td>{$_ADMINLANG.fields.status}</td><td width="20"></td></tr>
{foreach key=num from=$todoitems item=todoitem}
<tr bgcolor="{$todoitem.bgcolor}"><td align=center>{$todoitem.date}</td><td align=center>{$todoitem.title}</td><td align=center>{$todoitem.description|truncate:80:"..."}</td><td align=center>{$todoitem.duedate}</td><td align=center>{$todoitem.status}</td><td><a href="todolist.php?action=edit&id={$todoitem.id}"><img src="images/edit.gif" border="0"></a></td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="6">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<h2>{$_ADMINLANG.stats.unpaidinvoices} ({$totalunpaidinvoices}) - {$_ADMINLANG.home.5oldest} <a href="invoices.php?status=Unpaid">{$_ADMINLANG.home.viewall}</a></h2>

<table width=100% cellspacing=1 bgcolor="#cccccc"><tr bgcolor="#efefef" style="text-align:center;font-weight:bold"><td>{$_ADMINLANG.fields.invoicenum}</td><td>{$_ADMINLANG.fields.clientname}</td><td>{$_ADMINLANG.fields.invoicedate}</td><td>{$_ADMINLANG.fields.duedate}</td><td>{$_ADMINLANG.fields.totaldue}</td><td>{$_ADMINLANG.fields.paymentmethod}</td><td width="20"></td></tr>
{foreach key=num from=$unpaidinvoices item=unpaidinvoice}
<tr bgcolor="#ffffff"><td align=center><a href="invoices.php?action=edit&id={$unpaidinvoice.id}">{$unpaidinvoice.id}</a></td><td align=center><a href="clientssummary.php?userid={$unpaidinvoice.userid}">{$unpaidinvoice.client}</a><td align=center>{$unpaidinvoice.date}</td><td align=center>{$unpaidinvoice.duedate}</td><td align=center>{$unpaidinvoice.balance}</td><td align=center>{$unpaidinvoice.paymentmethod}</td><td align=center><a href="invoices.php?action=edit&id={$unpaidinvoice.id}"><img src="images/edit.gif" border="0"></a></td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="7">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<h2>{$_ADMINLANG.home.networkstatus} - <a href="{$smarty.server.PHP_SELF}?checknetwork=true">{$_ADMINLANG.home.checknow}</a></h2>
<table width=100% bgcolor="#cccccc" cellspacing=1>
<tr style="background-color:#efefef;font-weight:bold;text-align:center"><td>{$_ADMINLANG.mergefields.servername}</td><td>HTTP</td><td>{$_ADMINLANG.home.load}</td><td>{$_ADMINLANG.home.uptime}</td><td>{$_ADMINLANG.home.percentuse}</td></tr>
{foreach key=num from=$servers item=server}
<tr bgcolor="#ffffff"><td align="center">{$server.name}</td><td align="center">{$server.http}</td><td align="center">{$server.load}</td><td align="center">{$server.uptime}</td><td align="center">{$server.usage}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="5">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<p align="center"><input type="button" value="{$_ADMINLANG.invoices.geninvoices}" class="button" onClick="showDialog('geninvoices')">{if $showattemptccbutton} <input type="button" value="{$_ADMINLANG.invoices.attemptcccaptures}" class="button" onClick="showDialog('cccapture')">{/if}</p>

<div id="geninvoices" title="{$_ADMINLANG.invoices.geninvoices}">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span>{$_ADMINLANG.invoices.geninvoicessendemails}</p>
</div>
<div id="cccapture" title="{$_ADMINLANG.invoices.attemptcccaptures}">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span>{$_ADMINLANG.invoices.attemptcccapturessure}</p>
</div>