<?php /* Smarty version 2.6.26, created on 2012-05-14 09:37:57
         compiled from v4/sidebar.tpl */ ?>
<?php if ($this->_tpl_vars['sidebar'] == 'home'): ?>

<span class="header"><img src="images/icons/home.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['global']['shortcuts']; ?>
</span>
<ul class="menu">
    <li><a href="clientsadd.php"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['addnew']; ?>
</a></li>
    <li><a href="ordersadd.php"><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['addnew']; ?>
</a></li>
    <li><a href="quotes.php?action=manage"><?php echo $this->_tpl_vars['_ADMINLANG']['quotes']['createnew']; ?>
</a></li>
    <li><a href="todolist.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['todolistcreatenew']; ?>
</a></li>
    <li><a href="supporttickets.php?action=open"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['opennewticket']; ?>
</a></li>
    <li><a href="whois.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['whois']; ?>
</a></li>
    <li><a href="#" onClick="showDialog('geninvoices');return false"><?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['geninvoices']; ?>
</a></li>
    <li><a href="#" onClick="showDialog('cccapture');return false"><?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['attemptcccaptures']; ?>
</a></li>
</ul>

<span class="plain_header"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['incomeprojection']; ?>
</span>
<div class="smallfont"><?php echo $this->_tpl_vars['incomestats']; ?>
</div>

<br />

<span class="plain_header"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['systeminfo']; ?>
</span>
<div class="smallfont"><?php echo $this->_tpl_vars['_ADMINLANG']['license']['regto']; ?>
: <?php echo $this->_tpl_vars['licenseinfo']['registeredname']; ?>
<br /><?php echo $this->_tpl_vars['_ADMINLANG']['license']['type']; ?>
: <?php echo $this->_tpl_vars['licenseinfo']['productname']; ?>
<br /><?php echo $this->_tpl_vars['_ADMINLANG']['license']['expires']; ?>
: <?php echo $this->_tpl_vars['licenseinfo']['expires']; ?>
<br /><?php echo $this->_tpl_vars['_ADMINLANG']['global']['version']; ?>
: <?php echo $this->_tpl_vars['licenseinfo']['currentversion']; ?>
<?php if ($this->_tpl_vars['licenseinfo']['currentversion'] != $this->_tpl_vars['licenseinfo']['latestversion']): ?><br /><span class="textred"><b><?php echo $this->_tpl_vars['_ADMINLANG']['license']['updateavailable']; ?>
</b></span><?php endif; ?></div>

<?php elseif ($this->_tpl_vars['sidebar'] == 'clients'): ?>

<span class="header"><img src="images/icons/clients.png" class="absmiddle" alt="Clients" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['clients']['title']; ?>
</span>
<ul class="menu">
    <li><a href="clients.php"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['viewsearch']; ?>
</a></li>
    <li><a href="clientsadd.php"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['addnew']; ?>
</a></li>
    <li><a href="massmail.php"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['massmail']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/products.png" alt="Products/Services" width="16" height="16" class="absmiddle" /> <?php echo $this->_tpl_vars['_ADMINLANG']['services']['title']; ?>
</span>
<ul class="menu">
    <li><a href="clientshostinglist.php"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['listall']; ?>
</a></li>
    <li><a href="clientshostinglist.php?type=hostingaccount">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listhosting']; ?>
</a></li>
    <li><a href="clientshostinglist.php?type=reselleraccount">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listreseller']; ?>
</a></li>
    <li><a href="clientshostinglist.php?type=server">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listservers']; ?>
</a></li>
    <li><a href="clientshostinglist.php?type=other">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listother']; ?>
</a></li>
    <li><a href="clientsaddonslist.php"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['listaddons']; ?>
</a></li>
    <li><a href="clientsdomainlist.php"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['listdomains']; ?>
</a></li>
    <li><a href="cancelrequests.php"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['cancelrequests']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/affiliates.png" alt="Affiliates" width="16" height="16" class="absmiddle" /> <?php echo $this->_tpl_vars['_ADMINLANG']['affiliates']['title']; ?>
</span>
<ul class="menu">
    <li><a href="affiliates.php"><?php echo $this->_tpl_vars['_ADMINLANG']['affiliates']['manage']; ?>
</a></li>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'orders'): ?>

<span class="header"><img src="images/icons/orders.png" alt="Affiliates" width="16" height="16" class="absmiddle" /> <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['title']; ?>
</span>
<ul class="menu">
    <li><a href="orders.php"><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listall']; ?>
</a></li>
    <li><a href="orders.php?status=Pending">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listpending']; ?>
</a></li>
    <li><a href="orders.php?status=Active">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listactive']; ?>
</a></li>
    <li><a href="orders.php?status=Fraud">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listfraud']; ?>
</a></li>
    <li><a href="orders.php?status=Cancelled">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listcancelled']; ?>
</a></li>
    <li><a href="ordersadd.php"><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['addnew']; ?>
</a></li>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'billing'): ?>

<span class="header"><img src="images/icons/transactions.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['billing']['title']; ?>
</span>
<ul class="menu">
    <li><a href="transactions.php"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['transactionslist']; ?>
</a></li>
    <li><a href="gatewaylog.php"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['gatewaylog']; ?>
</a></li>
    <li><a href="offlineccprocessing.php"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['offlinecc']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/invoices.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['title']; ?>
</span>
<ul class="menu">
    <li><a href="invoices.php"><?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['listall']; ?>
</a></li>
    <li><a href="invoices.php?status=Paid">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['paid']; ?>
</a></li>
    <li><a href="invoices.php?status=Unpaid">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['unpaid']; ?>
</a></li>
    <li><a href="invoices.php?status=Overdue">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['overdue']; ?>
</a></li>
    <li><a href="invoices.php?status=Cancelled">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['cancelled']; ?>
</a></li>
    <li><a href="invoices.php?status=Refunded">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['refunded']; ?>
</a></li>
    <li><a href="invoices.php?status=Collections">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['collections']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/billableitems.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['title']; ?>
</span>
<ul class="menu">
    <li><a href="billableitems.php"><?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['listall']; ?>
</a></li>
    <li><a href="billableitems.php?status=Uninvoiced">- <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['uninvoiced']; ?>
</a></li>
    <li><a href="billableitems.php?status=Recurring">- <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['recurring']; ?>
</a></li>
    <li><a href="billableitems.php?action=manage"><?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['addnew']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/quotes.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['quotes']['title']; ?>
</span>
<ul class="menu">
    <li><a href="quotes.php"><?php echo $this->_tpl_vars['_ADMINLANG']['quotes']['listall']; ?>
</a></li>
    <li><a href="quotes.php?validity=Valid">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['valid']; ?>
</a></li>
    <li><a href="quotes.php?validity=Expired">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['expired']; ?>
</a></li>
    <li><a href="quotes.php?action=manage"><?php echo $this->_tpl_vars['_ADMINLANG']['quotes']['createnew']; ?>
</a></li>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'support'): ?>

<span class="header"><img src="images/icons/support.png" alt="Support Center" width="16" height="16" class="absmiddle" /> <?php echo $this->_tpl_vars['_ADMINLANG']['support']['title']; ?>
</span>
<ul class="menu">
    <li><a href="supportannouncements.php"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['announcements']; ?>
</a></li>
    <li><a href="supportdownloads.php"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['downloads']; ?>
</a></li>
    <li><a href="supportkb.php"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['knowledgebase']; ?>
</a></li>
    <li><a href="supporttickets.php?action=open"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['opennewticket']; ?>
</a></li>
    <li><a href="supportticketpredefinedreplies.php"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['predefreplies']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/tickets.png" alt="Filter Tickets" width="16" height="16" class="absmiddle" /> <?php echo $this->_tpl_vars['_ADMINLANG']['support']['filtertickets']; ?>
</span>
<ul class="menu">
    <li><a href="supporttickets.php"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['awaitingreply']; ?>
 (<?php echo $this->_tpl_vars['ticketsawaitingreply']; ?>
)</a></li>
    <li><a href="supporttickets.php?view=flagged"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['flagged']; ?>
 (<?php echo $this->_tpl_vars['ticketsflagged']; ?>
)</a></li>
    <li><a href="supporttickets.php?view=active"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['allactive']; ?>
 (<?php echo $this->_tpl_vars['ticketsallactive']; ?>
)</a></li>
<?php $_from = $this->_tpl_vars['ticketcounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
    <li><a href="supporttickets.php?view=<?php echo $this->_tpl_vars['ticket']['title']; ?>
">- <?php echo $this->_tpl_vars['ticket']['title']; ?>
 (<?php echo $this->_tpl_vars['ticket']['count']; ?>
)</a></li>
<?php endforeach; endif; unset($_from); ?></ul>

<span class="header"><img src="images/icons/networkissues.png" alt="Network Issues" width="16" height="16" class="absmiddle" /> <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['title']; ?>
</span>
<ul class="menu">
    <li><a href="networkissues.php">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['open']; ?>
</a></li>
    <li><a href="networkissues.php?view=scheduled">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['scheduled']; ?>
</a></li>
    <li><a href="networkissues.php?view=resolved">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['resolved']; ?>
</a></li>
    <li><a href="networkissues.php?action=manage"><?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['addnew']; ?>
</a></li>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'reports'): ?>

<span class="header"><img src="images/icons/reports.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['reports']['title']; ?>
</span>
<ul class="menu">
    <?php $_from = $this->_tpl_vars['text_reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filename'] => $this->_tpl_vars['reporttitle']):
?>
    <li><a href="reports.php?report=<?php echo $this->_tpl_vars['filename']; ?>
"><?php echo $this->_tpl_vars['reporttitle']; ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
</ul>

<span class="header"><img src="images/icons/graphs.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['reports']['graphs']; ?>
</span>
<ul class="menu">
    <?php $_from = $this->_tpl_vars['graph_reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filename'] => $this->_tpl_vars['reporttitle']):
?>
    <li><a href="reports.php?graph=<?php echo $this->_tpl_vars['filename']; ?>
"><?php echo $this->_tpl_vars['reporttitle']; ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
</ul>

<span class="header"><img src="images/icons/csvexports.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['reports']['exports']; ?>
</span>
<ul class="menu">
    <li><a href="csvdownload.php?type=clients"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['title']; ?>
</a></li>
    <li><a href="csvdownload.php?type=products"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['title']; ?>
</a></li>
    <li><a href="csvdownload.php?type=domains"><?php echo $this->_tpl_vars['_ADMINLANG']['domains']['title']; ?>
</a></li>
    <li><a href="reports.php?report=transactions"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['transactionslist']; ?>
</a></li>
    <li><a href="reports.php?report=pdfbatch"><?php echo $this->_tpl_vars['_ADMINLANG']['reports']['pdfbatch']; ?>
</a></li>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'browser'): ?>

<span class="header"><img src="images/icons/browser.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['browser']['bookmarks']; ?>
</span>
<ul class="menu">
    <li><a href="http://dereferer.ws/?http://www.whmcs.com/" target="brwsrwnd">WHMCS Homepage</a></li>
    <li><a href="http://dereferer.ws/?http://www.whmcs.com/clients/" target="brwsrwnd">WHMCS Client Area</a></li>
    <?php $_from = $this->_tpl_vars['browserlinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
    <li><a href="<?php echo $this->_tpl_vars['link']['url']; ?>
" target="brwsrwnd"><?php echo $this->_tpl_vars['link']['name']; ?>
 <img src="images/delete.gif" width="10" border="0" onclick="doDelete('<?php echo $this->_tpl_vars['link']['id']; ?>
')"></a></li>
    <?php endforeach; endif; unset($_from); ?>
</ul>

<form method="post" action="browser.php?action=add">
<span class="header"><img src="images/icons/browseradd.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['browser']['addnew']; ?>
</span>
<ul class="menu">
    <li><?php echo $this->_tpl_vars['_ADMINLANG']['browser']['sitename']; ?>
:<br><input type="text" name="sitename" size="25" style="font-size:9px;"><br><?php echo $this->_tpl_vars['_ADMINLANG']['browser']['url']; ?>
:<br><input type="text" name="siteurl" size="25" value="http://" style="font-size:9px;"><br><input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['browser']['add']; ?>
" style="font-size:9px;"></li>
</ul>
</form>

<?php elseif ($this->_tpl_vars['sidebar'] == 'utilities'): ?>

<span class="header"><img src="images/icons/utilities.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['title']; ?>
</span>
<ul class="menu">
    <li><a href="utilitieslinktracking.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['linktracking']; ?>
</a></li>
    <li><a href="browser.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['browser']; ?>
</a></li>
    <li><a href="calendar.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['calendar']; ?>
</a></li>
    <li><a href="todolist.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['todolist']; ?>
</a></li>
    <li><a href="whois.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['whois']; ?>
</a></li>
    <li><a href="utilitiesresolvercheck.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['domainresolver']; ?>
</a></li>
    <li><a href="systemintegrationcode.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['integrationcode']; ?>
</a></li>
    <li><a href="whmimport.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['cpanelimport']; ?>
</a></li>
    <li><a href="systemdatabase.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['dbstatus']; ?>
</a></li>
    <li><a href="systemcleanup.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['syscleanup']; ?>
</a></li>
    <li><a href="systemphpinfo.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['phpinfo']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/logs.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['logs']; ?>
</span>
<ul class="menu">
    <li><a href="systemactivitylog.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['activitylog']; ?>
</a></li>
    <li><a href="systemadminlog.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['adminlog']; ?>
</a></li>
    <li><a href="systememaillog.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['emaillog']; ?>
</a></li>
    <li><a href="systemmailimportlog.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['ticketmaillog']; ?>
</a></li>
    <li><a href="systemwhoislog.php"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['whoislog']; ?>
</a></li>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'addonmodules'): ?>

<?php echo $this->_tpl_vars['addon_module_sidebar']; ?>


<span class="header"><img src="images/icons/addonmodules.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['addonmodules']; ?>
</span>
<ul class="menu">
    <?php $_from = $this->_tpl_vars['addon_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filename'] => $this->_tpl_vars['addontitle']):
?>
    <li><a href="addonmodules.php?module=<?php echo $this->_tpl_vars['filename']; ?>
"><?php echo $this->_tpl_vars['addontitle']; ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
</ul>

<?php elseif ($this->_tpl_vars['sidebar'] == 'config'): ?>

<span class="header"><img src="images/icons/config.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['setup']['config']; ?>
</span>
<ul class="menu">
    <li><a href="configgeneral.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['general']; ?>
</a></li>
    <li><a href="configauto.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['automation']; ?>
</a></li>
    <li><a href="configemailtemplates.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['emailtpls']; ?>
</a></li>
    <li><a href="configfraud.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['fraud']; ?>
</a></li>
    <li><a href="configclientgroups.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['clientgroups']; ?>
</a></li>
    <li><a href="configcustomfields.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['customclientfields']; ?>
</a></li>
    <li><a href="configadmins.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['admins']; ?>
</a></li>
    <li><a href="configadminroles.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['adminroles']; ?>
</a></li>
    <li><a href="configaddonmods.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['addonmodules']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/income.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['setup']['payments']; ?>
</span>
<ul class="menu">
    <li><a href="configcurrencies.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['currencies']; ?>
</a></li>
    <li><a href="configgateways.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['gateways']; ?>
</a></li>
    <li><a href="configtax.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['tax']; ?>
</a></li>
    <li><a href="configpromotions.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['promos']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/products.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['setup']['products']; ?>
</span>
<ul class="menu">
    <li><a href="configproducts.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['products']; ?>
</a></li>
    <li><a href="configproductoptions.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['configoptions']; ?>
</a></li>
    <li><a href="configaddons.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['addons']; ?>
</a></li>
    <li><a href="configdomains.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['domainpricing']; ?>
</a></li>
    <li><a href="configregistrars.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['registrars']; ?>
</a></li>
    <li><a href="configservers.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['servers']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/support.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['support']['title']; ?>
</span>
<ul class="menu">
    <li><a href="configticketdepartments.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['supportdepartments']; ?>
</a></li>
    <li><a href="configticketstatuses.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['ticketstatuses']; ?>
</a></li>
    <li><a href="configticketescalations.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['escalationrules']; ?>
</a></li>
    <li><a href="configticketspamcontrol.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['spam']; ?>
</a></li>
</ul>

<span class="header"><img src="images/icons/configother.png" class="absmiddle" width="16" height="16" /> <?php echo $this->_tpl_vars['_ADMINLANG']['setup']['other']; ?>
</span>
<ul class="menu">
    <li><a href="configsecurityqs.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['securityqs']; ?>
</a></li>
    <li><a href="configbannedips.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['bannedips']; ?>
</a></li>
    <li><a href="configbannedemails.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['bannedemails']; ?>
</a></li>
    <li><a href="configbackups.php"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['backups']; ?>
</a></li>
</ul>

<?php endif; ?>

<?php if ($this->_tpl_vars['sidebar'] == 'clients' || $this->_tpl_vars['sidebar'] == 'orders' || $this->_tpl_vars['sidebar'] == 'billing'): ?>

<span class="plain_header"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['quicklinks']; ?>
</span>
<div class="smallfont">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td><a href="orders.php?filter=true&amp;status=Pending"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['pendingorders']; ?>
</a></td>
      <td align="left" valign="middle"><?php echo $this->_tpl_vars['sidebarstats']['orders']['pending']; ?>
</td>
    </tr>
    <tr>
      <td><a href="clients.php?status=Active"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['activeclients']; ?>
</a></td>
      <td align="left" valign="middle"><?php echo $this->_tpl_vars['sidebarstats']['clients']['active']; ?>
</td>
    </tr>
    <tr>
      <td><a href="clientshostinglist.php?status=Active"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['activeservices']; ?>
</a></td>
      <td align="left" valign="middle"><?php echo $this->_tpl_vars['sidebarstats']['services']['active']; ?>
</td>
    </tr>
    <tr>
      <td><a href="clientsdomainlist.php?status=Active"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['activedomains']; ?>
</a></td>
      <td align="left" valign="middle"><?php echo $this->_tpl_vars['sidebarstats']['domains']['active']; ?>
</td>
    </tr>
    <tr>
      <td><a href="invoices.php?status=Overdue"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['overdueinvoices']; ?>
</a></td>
      <td align="left" valign="middle"><?php echo $this->_tpl_vars['sidebarstats']['invoices']['overdue']; ?>
</td>
    </tr>
    <tr>
      <td><a href="supporttickets.php?view=active"><?php echo $this->_tpl_vars['_ADMINLANG']['stats']['activetickets']; ?>
</a></td>
      <td align="left" valign="middle"><?php echo $this->_tpl_vars['sidebarstats']['tickets']['active']; ?>
</td>
    </tr>
</table>
</div>

<?php endif; ?>

<br />

<span class="plain_header"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['advancedsearch']; ?>
</span>
<div class="smallfont">

<form method="get" action="search.php">
    <select name="type" id="searchtype" onchange="populate(this)">
      <option value="clients">Clients </option>
      <option value="orders">Orders </option>
      <option value="services">Services </option>
      <option value="domains">Domains </option>
      <option value="invoices">Invoices </option>
      <option value="tickets">Tickets </option>
    </select>
    <select name="field" id="searchfield">
      <option>Client ID</option>
      <option selected="selected">Client Name</option>
      <option>Company Name</option>
      <option>Email Address</option>
      <option>Address 1</option>
      <option>Address 2</option>
      <option>City</option>
      <option>State</option>
      <option>Postcode</option>
      <option>Country</option>
      <option>Phone Number</option>
      <option>CC Last Four</option>
    </select>
    <input type="text" name="q" style="width:100%;" />
    <input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['search']; ?>
" class="button" />
  </form>

</div>

<br />

<span class="plain_header"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['staffonline']; ?>
</span>
<div class="smallfont"><?php echo $this->_tpl_vars['adminsonline']; ?>
</div>