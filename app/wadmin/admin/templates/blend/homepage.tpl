<script type="text/javascript" src="../includes/jscript/jqueryag.js"></script>

{if $viewincometotals}<div style="float:right;position:relative;top:-35px;font-size:18px;"><a href="transactions.php"><img src="images/icons/transactions.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.billing.income}</b></a> {$_ADMINLANG.billing.incometoday}: <span class="textgreen"><b>{$stats.income.today}</b></span> {$_ADMINLANG.billing.incomethismonth}: <span class="textred"><b>{$stats.income.thismonth}</b></span> {$_ADMINLANG.billing.incomethisyear}: <span class="textblack"><b>{$stats.income.thisyear}</b></span></div>{/if}

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

<p>Welcome Back {$admin_username}!</p>

{foreach from=$addons_html item=addon_html}
<div style="margin-bottom:15px;">{$addon_html}</div>
{/foreach}

<table width="100%" align="center" cellspacing="0" cellpadding="0"><tr><td width="25%" align="center">

<table width="90%" class="form">
<tr><td colspan="4" class="fieldarea" style="text-align:center;"><a href="orders.php?status=Pending"><img src="images/icons/orders.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.orders.title}</b></a></td></tr>
<tr><td class="fieldlabel"><a href="orders.php">{$_ADMINLANG.stats.todaysorders}</a></td><td width="50" class="fieldarea"><span class="textblue"><b>{$stats.orders.today.total}</b></span></td><td class="fieldlabel">{$_ADMINLANG.stats.yesterdaysorders}</td><td width="50" class="fieldarea"><span class="textblue"><b>{$stats.orders.yesterday.total}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Pending">{$_ADMINLANG.stats.todayspending}</a></td><td class="fieldarea"><span class="textred"><b>{$stats.orders.today.pending}</b></span></td><td class="fieldlabel">{$_ADMINLANG.stats.yesterdayspending}</td><td class="fieldarea"><span class="textgreen"><b>{$stats.orders.yesterday.pending}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Active">{$_ADMINLANG.stats.todayscompleted}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.orders.today.active}</b></span></td><td class="fieldlabel">{$_ADMINLANG.stats.yesterdayscompleted}</td><td class="fieldarea"><span class="textgreen"><b>{$stats.orders.yesterday.active}</b></span></td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.stats.monthtodatetotal}</td><td class="fieldarea"><span class="textgold"><b>{$stats.orders.thismonth.total}</b></span></td><td class="fieldlabel">{$_ADMINLANG.stats.yeartodatetotal}</td><td class="fieldarea"><span class="textblack"><b>{$stats.orders.thisyear.total}</b></span></td></tr>
<tr><td class="fieldlabel">&nbsp;</td><td class="fieldarea">&nbsp;</td><td class="fieldlabel">&nbsp;</td><td class="fieldarea">&nbsp;</td></tr>
</table>

</td><td width="30%" align="center">

<table width="90%" class="form">
<tr><td colspan="4" class="fieldarea" style="text-align:center;"><img src="images/icons/stats.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.stats.title}</b></td></tr>
<tr><td class="fieldlabel"><a href="clients.php?status=Active">{$_ADMINLANG.stats.activeclients}</a></td><td width="50" class="fieldarea"><span class="textgreen"><b>{$sidebarstats.clients.active}</b></span></td><td class="fieldlabel"><a href="invoices.php?status=Unpaid">{$_ADMINLANG.stats.unpaidinvoices}</a></td><td width="50" class="fieldarea"><span class="textred"><b>{$sidebarstats.invoices.unpaid}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientsdomainlist.php?status=Pending%20Transfer">{$_ADMINLANG.stats.pendingtransferdomains}</a></td><td class="fieldarea"><span class="textgold"><b>{$sidebarstats.domains.pendingtransfer}</b></span></td><td class="fieldlabel"><a href="invoices.php?status=Overdue">{$_ADMINLANG.stats.overdueinvoices}</a></td><td class="fieldarea"><span class="textblack"><b>{$sidebarstats.invoices.overdue}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientshostinglist.php?status=Suspended">{$_ADMINLANG.stats.suspendedservices}</a></td><td class="fieldarea"><span class="testblue"><b>{$sidebarstats.services.suspended}</b></span></td><td class="fieldlabel"><a href="billableitems.php?status=Uninvoiced">{$_ADMINLANG.stats.uninvoicedbillableitems}</a></td><td class="fieldarea"><span class="textred"><b>{$stats.billableitems.uninvoiced}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="supporttickets.php?view=active">{$_ADMINLANG.stats.activetickets}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.tickets.allactive}</b></span></td><td class="fieldlabel"><a href="quotes.php?validity=Valid">{$_ADMINLANG.stats.validquotes}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.quotes.valid}</b></span></td></tr>
<tr><td class="fieldlabel"><a href="supporttickets.php?view=flagged">{$_ADMINLANG.stats.activeflagged}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.tickets.flaggedtickets}</b></span></td><td class="fieldlabel"><a href="cancelrequests.php">{$_ADMINLANG.stats.pendingcancellations}</a></td><td class="fieldarea"><span class="textgreen"><b>{$stats.cancellations.pending}</b></span></td></tr>
</table>

</td><td width="20%" align="center">

<table width="90%" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><img src="images/icons/system.png" align="absmiddle" border="0"> <b>{$_ADMINLANG.global.systeminfo}</b></td></tr>
<tr><td width="105" class="fieldlabel">{$_ADMINLANG.global.staffonline}</td><td class="fieldarea">{$adminsonline}</td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.license.regto}</td><td class="fieldarea">{$licenseinfo.registeredname}</td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.license.type}</td><td class="fieldarea">{$licenseinfo.productname}</td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.license.expires}</td><td class="fieldarea">{$licenseinfo.expires}</td></tr>
<tr><td class="fieldlabel">{$_ADMINLANG.global.version}</td><td class="fieldarea">{$licenseinfo.currentversion}{if $licenseinfo.currentversion neq $licenseinfo.latestversion} <span class="textred"><b>{$_ADMINLANG.license.updateavailable}</b></span>{/if}</td></tr>
</table>

</td><td width="25%" align="center">

<img src="reports.php?displaygraph=graph_monthly_signups&homepage=true">

</td></tr></table>

<br />

{literal}<script language="javascript">
$(document).ready(function(){
    $(".tabbox").css("display","none");
    var selectedTab;
    $(".tab").click(function(){
        var elid = $(this).attr("id");
        $(".tab").removeClass("tabselected");
        $("#"+elid).addClass("tabselected");
        $(".tabbox").slideUp();
        if (elid != selectedTab) {
            selectedTab = elid;
            $("#"+elid+"box").slideDown();
        } else {
            selectedTab = null;
            $(".tab").removeClass("tabselected");
        }
        $("#tab").val(elid.substr(3));
    });
    $("#tab0").addClass("tabselected");
    $("#tab0box").show();
});
</script>{/literal}

<div id="tabs">
    <ul>
        <li id="tab0" class="tab"><a href="javascript:;">Recent Activity</a></li>
        <li id="tab1" class="tab"><a href="javascript:;">Recent User Activity</a></li>
        <li id="tab2" class="tab"><a href="javascript:;">To-Do List</a></li>
        <li id="tab3" class="tab"><a href="javascript:;">Network Status</a></li>
    </ul>
</div>
<div id="tab0box" class="tabbox">
  <div id="tab_content">

<h3>{$_ADMINLANG.home.recentactivity}</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td width="120">{$_ADMINLANG.fields.date}</td><td>{$_ADMINLANG.fields.description}</td><td width="100">{$_ADMINLANG.fields.username}</td><td width="80">{$_ADMINLANG.fields.ipaddress}</td></tr>
{foreach from=$recentactivity item=activity}
<tr bgcolor="#ffffff"><td align="center">{$activity.date}</td><td>{$activity.description}</td><td align="center">{$activity.username}</td><td align="center">{$activity.ipaddr}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="4">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

<p align="right"><a href="systemactivitylog.php">View More &raquo;</a></p>

  </div>
</div>
<div id="tab1box" class="tabbox">
  <div id="tab_content">

<table width="100%"><tr><td width="49%" valign="top">

<h3>{$_ADMINLANG.home.recentclientactivity}</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.client}</td><td>{$_ADMINLANG.fields.ipaddress}</td><td>{$_ADMINLANG.system.lastaccess}</td></tr>
{foreach from=$recentclients item=activity}
<tr bgcolor="#ffffff" style="text-align:center;"><td><a href="clientssummary.php?userid={$activity.id}">{$activity.firstname} {$activity.lastname}</a></td><td><a href="http://www.geoiptool.com/en/?IP={$activity.ip}" target="_blank">{$activity.ip}</a></td><td>{$activity.lastlogin}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="3">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

</td><td width="2%"></td><td width="49%" valign="top">

<h3>{$_ADMINLANG.home.recentadminactivity}</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.admin}</td><td>{$_ADMINLANG.fields.ipaddress}</td><td>{$_ADMINLANG.system.lastaccess}</td></tr>
{foreach from=$recentadmins item=activity}
<tr bgcolor="#ffffff" style="text-align:center;"><td>{$activity.username}</td><td><a href="http://www.geoiptool.com/en/?IP={$activity.ip}" target="_blank">{$activity.ip}</a></td><td>{$activity.lastvisit}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="3">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

</td></tr></table>

  </div>
</div>
<div id="tab2box" class="tabbox">
  <div id="tab_content">

<h3>{$_ADMINLANG.utilities.todolist} - <a href="todolist.php">{$_ADMINLANG.home.manage}</a></h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor=#efefef style="text-align:center;font-weight:bold;"><td>{$_ADMINLANG.fields.date}</td><td>{$_ADMINLANG.fields.title}</td><td>{$_ADMINLANG.fields.description}</td><td>{$_ADMINLANG.fields.duedate}</td><td>{$_ADMINLANG.fields.status}</td><td width="20"></td></tr>
{foreach key=num from=$todoitems item=todoitem}
<tr bgcolor="{$todoitem.bgcolor}"><td align=center>{$todoitem.date}</td><td align=center>{$todoitem.title}</td><td>{$todoitem.description|truncate:80:"..."}</td><td align=center>{$todoitem.duedate}</td><td align=center>{$todoitem.status}</td><td><a href="todolist.php?action=edit&id={$todoitem.id}"><img src="images/edit.gif" border="0"></a></td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="6">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

  </div>
</div>
<div id="tab3box" class="tabbox">
  <div id="tab_content">

<a name="checknetwork"></a>

<h3>{$_ADMINLANG.home.networkstatus} - <a href="{$smarty.server.PHP_SELF}?checknetwork=true#checknetwork">{$_ADMINLANG.home.checknow}</a></h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr style="background-color:#efefef;font-weight:bold;text-align:center"><td>{$_ADMINLANG.mergefields.servername}</td><td>HTTP</td><td>{$_ADMINLANG.home.load}</td><td>{$_ADMINLANG.home.uptime}</td><td>{$_ADMINLANG.home.percentuse}</td></tr>
{foreach key=num from=$servers item=server}
<tr bgcolor="#ffffff"><td align="center">{$server.name}</td><td align="center">{$server.http}</td><td align="center">{$server.load}</td><td align="center">{$server.uptime}</td><td align="center">{$server.usage}</td></tr>
{foreachelse}
<tr bgcolor="#ffffff"><td align="center" colspan="5">{$_ADMINLANG.global.norecordsfound}</td></tr>
{/foreach}
</table>

  </div>
</div>

<div id="geninvoices" title="{$_ADMINLANG.invoices.geninvoices}">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span>{$_ADMINLANG.invoices.geninvoicessendemails}</p>
</div>
<div id="cccapture" title="{$_ADMINLANG.invoices.attemptcccaptures}">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span>{$_ADMINLANG.invoices.attemptcccapturessure}</p>
</div>