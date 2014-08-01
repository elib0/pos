<?php /* Smarty version 2.6.26, created on 2012-05-14 09:38:02
         compiled from v4/homepage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'v4/homepage.tpl', 102, false),)), $this); ?>
<script type="text/javascript" src="../includes/jscript/jqueryag.js"></script>

<?php if ($this->_tpl_vars['maintenancemode']): ?>
<div class="errorbox" style="font-size:14px;">
<?php echo $this->_tpl_vars['_ADMINLANG']['home']['maintenancemode']; ?>

</div>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['freetrial']): ?>
<div class="errorbox" style="font-size:14px;">
You are currently running our 15 Day Free Trial!  <a href="http://dereferer.ws/?http://www.whmcs.com/order.php" target="_blank">Click here to order a full license</a>
</div>
<br />
<?php endif; ?>

<?php echo $this->_tpl_vars['infobox']; ?>


<?php if ($this->_tpl_vars['viewincometotals']): ?><div class="contentbox" style="font-size:18px;"><a href="transactions.php"><img src="images/icons/transactions.png" align="absmiddle" border="0"> <b><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['income']; ?>
</b></a> <?php echo $this->_tpl_vars['_ADMINLANG']['billing']['incometoday']; ?>
: <span class="textgreen"><b><?php echo $this->_tpl_vars['stats']['income']['today']; ?>
</b></span> <?php echo $this->_tpl_vars['_ADMINLANG']['billing']['incomethismonth']; ?>
: <span class="textred"><b><?php echo $this->_tpl_vars['stats']['income']['thismonth']; ?>
</b></span> <?php echo $this->_tpl_vars['_ADMINLANG']['billing']['incomethisyear']; ?>
: <span class="textblack"><b><?php echo $this->_tpl_vars['stats']['income']['thisyear']; ?>
</b></span></div>

<br /><?php endif; ?>

<?php $_from = $this->_tpl_vars['addons_html']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['addon_html']):
?>
<div style="margin-bottom:15px;"><?php echo $this->_tpl_vars['addon_html']; ?>
</div>
<?php endforeach; endif; unset($_from); ?>

<table width="100%" cellspacing="0" cellpadding="0"><tr><td align="center">

<table width="250" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><a href="orders.php?status=Pending"><img src="images/icons/orders.png" align="absmiddle" border="0"> <b><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['title']; ?>
</b></a></td></tr>
<tr><td width="160" class="fieldlabel"><a href="orders.php"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['todaysorders']; ?>
</a></td><td class="fieldarea"><span class="textblue"><b><?php echo $this->_tpl_vars['stats']['orders']['today']['total']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Pending"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['todayspending']; ?>
</a></td><td class="fieldarea"><span class="textred"><b><?php echo $this->_tpl_vars['stats']['orders']['today']['pending']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="orders.php?status=Active"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['todayscompleted']; ?>
</a></td><td class="fieldarea"><span class="textgreen"><b><?php echo $this->_tpl_vars['stats']['orders']['today']['active']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['yesterdaysorders']; ?>
</td><td class="fieldarea"><span class="textblue"><b><?php echo $this->_tpl_vars['stats']['orders']['yesterday']['total']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['yesterdayscompleted']; ?>
</td><td class="fieldarea"><span class="textgreen"><b><?php echo $this->_tpl_vars['stats']['orders']['yesterday']['active']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['monthtodatetotal']; ?>
</td><td class="fieldarea"><span class="textgold"><b><?php echo $this->_tpl_vars['stats']['orders']['thismonth']['total']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['yeartodatetotal']; ?>
</td><td class="fieldarea"><span class="textblack"><b><?php echo $this->_tpl_vars['stats']['orders']['thisyear']['total']; ?>
</b></span></td></tr>
</table>

</td><td align="center">

<table width="250" class="form">
<tr><td colspan="2" class="fieldarea" style="text-align:center;"><img src="images/icons/stats.png" align="absmiddle" border="0"> <b><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['title']; ?>
</b></td></tr>
<tr><td width="180" class="fieldlabel"><a href="clients.php?status=Active"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['activeclients']; ?>
</a></td><td class="fieldarea"><span class="textgreen"><b><?php echo $this->_tpl_vars['sidebarstats']['clients']['active']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="invoices.php?status=Unpaid"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['unpaidinvoices']; ?>
</a></td><td class="fieldarea"><span class="textred"><b><?php echo $this->_tpl_vars['sidebarstats']['invoices']['unpaid']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="invoices.php?status=Overdue"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['overdueinvoices']; ?>
</a></td><td class="fieldarea"><span class="textblack"><b><?php echo $this->_tpl_vars['sidebarstats']['invoices']['overdue']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientsdomainlist.php?status=Pending%20Transfer"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['pendingtransferdomains']; ?>
</a></td><td class="fieldarea"><span class="textgold"><b><?php echo $this->_tpl_vars['sidebarstats']['domains']['pendingtransfer']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="clientshostinglist.php?status=Suspended"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['suspendedservices']; ?>
</a></td><td class="fieldarea"><span class="testblue"><b><?php echo $this->_tpl_vars['sidebarstats']['services']['suspended']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="billableitems.php?status=Uninvoiced"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['uninvoicedbillableitems']; ?>
</a></td><td class="fieldarea"><span class="textred"><b><?php echo $this->_tpl_vars['stats']['billableitems']['uninvoiced']; ?>
</b></span></td></tr>
<tr><td class="fieldlabel"><a href="quotes.php?validity=Valid"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['validquotes']; ?>
</a></td><td class="fieldarea"><span class="textgreen"><b><?php echo $this->_tpl_vars['stats']['quotes']['valid']; ?>
</b></span></td></tr>
</table>

</td><td width="400">

<img src="reports.php?displaygraph=graph_monthly_signups&homepage=true">

</td></tr></table>

<br />

<div class="errorbox" style="font-size:14px;"><a href="supporttickets.php"><?php echo $this->_tpl_vars['sidebarstats']['tickets']['awaitingreply']; ?>
 <?php echo $this->_tpl_vars['_ADMINLANG']['stats']['ticketsawaitingreply']; ?>
</a> || <a href="cancelrequests.php"><?php echo $this->_tpl_vars['stats']['cancellations']['pending']; ?>
 <?php echo $this->_tpl_vars['_ADMINLANG']['stats']['pendingcancellations']; ?>
</a> || <a href="todolist.php"><?php echo $this->_tpl_vars['stats']['todoitems']['due']; ?>
 <?php echo $this->_tpl_vars['_ADMINLANG']['stats']['todoitemsdue']; ?>
</a> || <a href="networkissues.php"><?php echo $this->_tpl_vars['stats']['networkissues']['open']; ?>
 <?php echo $this->_tpl_vars['_ADMINLANG']['stats']['opennetworkissues']; ?>
</a></div>

<br />

<div class="contentbox"><form method="post" action="index.php"><input type="hidden" name="action" value="savenotes"><table width="100%"><tr><td width="40"><b><?php echo $this->_tpl_vars['_ADMINLANG']['global']['mynotes']; ?>
</b></td><td><textarea name="notes" class="expanding" style="width:95%;"><?php echo $this->_tpl_vars['adminnotes']; ?>
</textarea></td><td width="40"><input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['savechanges']; ?>
"></td></tr></table></form></div>

<br />

<table width="100%" cellspacing="0" cellpadding="0"><tr><td width="49%" valign="top">

<h3 align="center"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['recentclientactivity']; ?>
</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['client']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['ipaddress']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['system']['lastaccess']; ?>
</td></tr>
<?php $_from = $this->_tpl_vars['recentclients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['activity']):
?>
<tr bgcolor="#ffffff" style="text-align:center;"><td><a href="clientssummary.php?userid=<?php echo $this->_tpl_vars['activity']['id']; ?>
"><?php echo $this->_tpl_vars['activity']['firstname']; ?>
 <?php echo $this->_tpl_vars['activity']['lastname']; ?>
</a></td><td><a href="http://www.geoiptool.com/en/?IP=<?php echo $this->_tpl_vars['activity']['ip']; ?>
" target="_blank"><?php echo $this->_tpl_vars['activity']['ip']; ?>
</a></td><td><?php echo $this->_tpl_vars['activity']['lastlogin']; ?>
</td></tr>
<?php endforeach; else: ?>
<tr bgcolor="#ffffff"><td align="center" colspan="3"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['norecordsfound']; ?>
</td></tr>
<?php endif; unset($_from); ?>
</table>

</td><td width="2%"></td><td width="49%" valign="top">

<h3 align="center"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['recentadminactivity']; ?>
</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['admin']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['ipaddress']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['system']['lastaccess']; ?>
</td></tr>
<?php $_from = $this->_tpl_vars['recentadmins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['activity']):
?>
<tr bgcolor="#ffffff" style="text-align:center;"><td><?php echo $this->_tpl_vars['activity']['username']; ?>
</td><td><a href="http://www.geoiptool.com/en/?IP=<?php echo $this->_tpl_vars['activity']['ip']; ?>
" target="_blank"><?php echo $this->_tpl_vars['activity']['ip']; ?>
</a></td><td><?php echo $this->_tpl_vars['activity']['lastvisit']; ?>
</td></tr>
<?php endforeach; else: ?>
<tr bgcolor="#ffffff"><td align="center" colspan="3"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['norecordsfound']; ?>
</td></tr>
<?php endif; unset($_from); ?>
</table>

</td></tr></table>

<h3 align="center"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['todolist']; ?>
 - <a href="todolist.php"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['manage']; ?>
</a></h3>

<table width=100% cellspacing=1 bgcolor="#cccccc">
<tr bgcolor=#efefef style="text-align:center;font-weight:bold;"><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['date']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['title']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['description']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['duedate']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['status']; ?>
</td><td width="20"></td></tr>
<?php $_from = $this->_tpl_vars['todoitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['todoitem']):
?>
<tr bgcolor="<?php echo $this->_tpl_vars['todoitem']['bgcolor']; ?>
"><td align=center><?php echo $this->_tpl_vars['todoitem']['date']; ?>
</td><td align=center><?php echo $this->_tpl_vars['todoitem']['title']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['todoitem']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...") : smarty_modifier_truncate($_tmp, 80, "...")); ?>
</td><td align=center><?php echo $this->_tpl_vars['todoitem']['duedate']; ?>
</td><td align=center><?php echo $this->_tpl_vars['todoitem']['status']; ?>
</td><td><a href="todolist.php?action=edit&id=<?php echo $this->_tpl_vars['todoitem']['id']; ?>
"><img src="images/edit.gif" border="0"></a></td></tr>
<?php endforeach; else: ?>
<tr bgcolor="#ffffff"><td align="center" colspan="6"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['norecordsfound']; ?>
</td></tr>
<?php endif; unset($_from); ?>
</table>

<a name="checknetwork"></a>

<h3 align="center"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['networkstatus']; ?>
 - <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?checknetwork=true#checknetwork"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['checknow']; ?>
</a></h3>

<table width=100% bgcolor="#cccccc" cellspacing=1>
<tr style="background-color:#efefef;font-weight:bold;text-align:center"><td><?php echo $this->_tpl_vars['_ADMINLANG']['mergefields']['servername']; ?>
</td><td>HTTP</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['home']['load']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['home']['uptime']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['home']['percentuse']; ?>
</td></tr>
<?php $_from = $this->_tpl_vars['servers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['server']):
?>
<tr bgcolor="#ffffff"><td align="center"><?php echo $this->_tpl_vars['server']['name']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['server']['http']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['server']['load']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['server']['uptime']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['server']['usage']; ?>
</td></tr>
<?php endforeach; else: ?>
<tr bgcolor="#ffffff"><td align="center" colspan="5"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['norecordsfound']; ?>
</td></tr>
<?php endif; unset($_from); ?>
</table>

<h3 align="center"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['recentactivity']; ?>
</h3>

<table width="100%" bgcolor="#cccccc" cellspacing="1">
<tr bgcolor="#efefef" style="text-align:center;font-weight:bold;"><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['date']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['description']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['username']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['ipaddress']; ?>
</td></tr>
<?php $_from = $this->_tpl_vars['recentactivity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['activity']):
?>
<tr bgcolor="#ffffff"><td align="center"><?php echo $this->_tpl_vars['activity']['date']; ?>
</td><td><?php echo $this->_tpl_vars['activity']['description']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['activity']['username']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['activity']['ipaddr']; ?>
</td></tr>
<?php endforeach; else: ?>
<tr bgcolor="#ffffff"><td align="center" colspan="4"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['norecordsfound']; ?>
</td></tr>
<?php endif; unset($_from); ?>
</table>

<div id="geninvoices" title="<?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['geninvoices']; ?>
">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span><?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['geninvoicessendemails']; ?>
</p>
</div>
<div id="cccapture" title="<?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['attemptcccaptures']; ?>
">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 40px 0;"></span><?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['attemptcccapturessure']; ?>
</p>
</div>