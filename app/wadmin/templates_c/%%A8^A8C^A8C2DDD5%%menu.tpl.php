<?php /* Smarty version 2.6.26, created on 2012-05-14 09:37:57
         compiled from v4/menu.tpl */ ?>
<li class="menuButton"><a href="index.php" title="Home" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['home']['title']; ?>
</a>
  <ul>
    <li><a title="" href="index.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['hometitle']; ?>
</a></li>
    <li><a title="" href="myaccount.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['myaccount']; ?>
</a></li>
    <li><a title="" href="logout.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['logout']; ?>
</a></li>
  </ul>
</li>
<li class="menuButton"><a <?php if (in_array ( 'List Clients' , $this->_tpl_vars['admin_perms'] )): ?>href="clients.php"<?php endif; ?> title="Clients" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['title']; ?>
</a>
  <ul>
    <?php if (in_array ( 'List Clients' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="clients.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['viewsearch']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Add New Client' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="clientsadd.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['addnew']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Mass Mail' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="massmail.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['massmail']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'List Services' , $this->_tpl_vars['admin_perms'] )): ?>
    <li><a title="" href="clientshostinglist.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['listall']; ?>
</a></li>
    <li><a title="" href="clientshostinglist.php?type=hostingaccount" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listhosting']; ?>
</a></li>
    <li><a title="" href="clientshostinglist.php?type=reselleraccount" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listreseller']; ?>
</a></li>
    <li><a title="" href="clientshostinglist.php?type=server" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listservers']; ?>
</a></li>
    <li><a title="" href="clientshostinglist.php?type=other" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['listother']; ?>
</a></li>
    <?php endif; ?>
    <?php if (in_array ( 'List Addons' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="clientsaddonslist.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['listaddons']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'List Domains' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="clientsdomainlist.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['services']['listdomains']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Cancellation Requests' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="cancelrequests.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['clients']['cancelrequests']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Manage Affiliates' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="affiliates.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['affiliates']['manage']; ?>
</a></li><?php endif; ?>
  </ul>
</li>
<li class="menuButton"><a <?php if (in_array ( 'View Orders' , $this->_tpl_vars['admin_perms'] )): ?>href="orders.php"<?php endif; ?> title="Orders" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['title']; ?>
</a>
  <ul>
    <?php if (in_array ( 'View Orders' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="orders.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listall']; ?>
</a></li>
    <li><a title="" href="orders.php?status=Pending" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listpending']; ?>
</a></li>
    <li><a title="" href="orders.php?status=Active" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listactive']; ?>
</a></li>
    <li><a title="" href="orders.php?status=Fraud" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listfraud']; ?>
</a></li>
    <li><a title="" href="orders.php?status=Cancelled" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['orders']['listcancelled']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Add New Order' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="ordersadd.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['orders']['addnew']; ?>
</a></li><?php endif; ?>
  </ul>
</li>
<li class="menuButton"><a <?php if (in_array ( 'List Transactions' , $this->_tpl_vars['admin_perms'] )): ?>href="transactions.php"<?php endif; ?> title="Billing" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['title']; ?>
</a>
  <ul>
    <?php if (in_array ( 'List Transactions' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="transactions.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['transactionslist']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Offline Credit Card Processing' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="offlineccprocessing.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['offlinecc']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Gateway Log' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="gatewaylog.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['billing']['gatewaylog']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'List Invoices' , $this->_tpl_vars['admin_perms'] )): ?>
    <li><a title="" href="invoices.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['invoices']['listall']; ?>
</a></li>
    <li><a title="" href="invoices.php?status=Paid" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['paid']; ?>
</a></li>
    <li><a title="" href="invoices.php?status=Unpaid" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['unpaid']; ?>
</a></li>
    <li><a title="" href="invoices.php?status=Overdue" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['overdue']; ?>
</a></li>
    <li><a title="" href="invoices.php?status=Cancelled" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['cancelled']; ?>
</a></li>
    <li><a title="" href="invoices.php?status=Refunded" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['refunded']; ?>
</a></li>
    <li><a title="" href="invoices.php?status=Collections" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['collections']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Billable Items' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="billableitems.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['listall']; ?>
</a></li>
    <li><a title="" href="billableitems.php?status=Uninvoiced" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['uninvoiced']; ?>
</a></li>
    <li><a title="" href="billableitems.php?status=Recurring" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['recurring']; ?>
</a></li>
    <?php if (in_array ( 'Manage Billable Items' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="billableitems.php?action=manage" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['addnew']; ?>
</a></li><?php endif; ?><?php endif; ?>
    <?php if (in_array ( 'Manage Quotes' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="quotes.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['quotes']['listall']; ?>
</a></li>
    <li><a title="" href="quotes.php?validity=Valid" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['valid']; ?>
</a></li>
    <li><a title="" href="quotes.php?validity=Expired" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['status']['expired']; ?>
</a></li>
    <li><a title="" href="quotes.php?action=manage" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['quotes']['createnew']; ?>
</a></li><?php endif; ?>
  </ul>
</li>
<li class="menuButton"><a <?php if (in_array ( 'Support Center Overview' , $this->_tpl_vars['admin_perms'] )): ?>href="supportcenter.php"<?php endif; ?> title="Support" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['title']; ?>
</a>
  <ul>
    <?php if (in_array ( 'Manage Announcements' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supportannouncements.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['announcements']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Manage Downloads' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supportdownloads.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['downloads']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Manage Knowledgebase' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supportkb.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['knowledgebase']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'List Support Tickets' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supporttickets.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['supporttickets']; ?>
</a></li><?php endif; ?>
    <li><a title="" href="supporttickets.php?view=flagged" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['support']['flagged']; ?>
</a></li>
    <?php if (in_array ( 'List Support Tickets' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supporttickets.php?view=active" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['support']['allactive']; ?>
</a></li>
    <li><a title="" href="supporttickets.php?view=Open" class="subMenuLinks">- Open</a></li>
    <li><a title="" href="supporttickets.php?view=Answered" class="subMenuLinks">- Answered</a></li>
    <li><a title="" href="supporttickets.php?view=Customer-Reply" class="subMenuLinks">- Customer-Reply</a></li>
    <li><a title="" href="supporttickets.php?view=On Hold" class="subMenuLinks">- On Hold</a></li>
    <li><a title="" href="supporttickets.php?view=In Progress" class="subMenuLinks">- In Progress</a></li>
    <li><a title="" href="supporttickets.php?view=Closed" class="subMenuLinks">- Closed</a></li><?php endif; ?>
    <?php if (in_array ( 'Open New Ticket' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supporttickets.php?action=open" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['opennewticket']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Manage Predefined Replies' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="supportticketpredefinedreplies.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['predefreplies']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Manage Network Issues' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="networkissues.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['title']; ?>
</a></li>
    <li><a title="" href="networkissues.php" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['open']; ?>
</a></li>
    <li><a title="" href="networkissues.php?view=scheduled" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['scheduled']; ?>
</a></li>
    <li><a title="" href="networkissues.php?view=resolved" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['resolved']; ?>
</a></li>
    <li><a title="" href="networkissues.php?action=manage" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['networkissues']['addnew']; ?>
</a></li><?php endif; ?>
  </ul>
</li>
<?php if (in_array ( 'View Reports' , $this->_tpl_vars['admin_perms'] )): ?><li class="menuButton"><a title="Reports" href="reports.php" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['reports']['title']; ?>
</a>
  <ul>
    <li><a title="" href="reports.php#reports" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['reports']['title']; ?>
</a></li>
    <li><a title="" href="reports.php#graphs" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['reports']['graphs']; ?>
</a></li>
    <li><a title="" href="reports.php#exports" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['reports']['exports']; ?>
</a></li>
    <?php if (in_array ( 'CSV Downloads' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="csvdownload.php?type=clients" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['clients']['title']; ?>
</a></li>
    <li><a title="" href="csvdownload.php?type=products" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['services']['title']; ?>
</a></li>
    <li><a title="" href="csvdownload.php?type=domains" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['domains']['title']; ?>
</a></li>
    <li><a title="" href="reports.php?report=transactions" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['billing']['transactionslist']; ?>
</a></li>
    <li><a title="" href="reports.php?report=pdfbatch" class="subMenuLinks">- <?php echo $this->_tpl_vars['_ADMINLANG']['reports']['pdfbatch']; ?>
</a></li><?php endif; ?>
  </ul>
</li><?php endif; ?>
<li class="menuButton"><a title="Utilities" href="" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['title']; ?>
</a>
  <ul>
    <?php if (in_array ( 'Link Tracking' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="utilitieslinktracking.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['linktracking']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Browser' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="browser.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['browser']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Calendar' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="calendar.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['calendar']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( "To-Do List" , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="todolist.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['todolist']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'WHOIS Lookups' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="whois.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['whois']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Domain Resolver Checker' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="utilitiesresolvercheck.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['domainresolver']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Integration Code' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemintegrationcode.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['integrationcode']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'WHM Import Script' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="whmimport.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['cpanelimport']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Database Status' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemdatabase.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['dbstatus']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'System Cleanup Operations' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemcleanup.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['syscleanup']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View PHP Info' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemphpinfo.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['phpinfo']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Activity Log' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemactivitylog.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['activitylog']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Admin Log' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemadminlog.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['adminlog']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Email Message Log' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systememaillog.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['emaillog']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View Ticket Mail Import Log' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemmailimportlog.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['ticketmaillog']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'View WHOIS Lookup Log' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemwhoislog.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['whoislog']; ?>
</a></li><?php endif; ?>
  </ul>
</li>
<?php if ($this->_tpl_vars['addon_modules']): ?>
<li class="menuButton"><a title="Addons" href="addonmodules.php" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['utilities']['addonmodules']; ?>
</a>
  <ul>
    <?php $_from = $this->_tpl_vars['addon_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module'] => $this->_tpl_vars['displayname']):
?>
    <li><a title="" href="addonmodules.php?module=<?php echo $this->_tpl_vars['module']; ?>
" class="subMenuLinks"><?php echo $this->_tpl_vars['displayname']; ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
  </ul>
</li>
<?php endif; ?>
<li class="menuButton"><a title="Setup" href="" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['title']; ?>
</a>
  <ul>
    <?php if (in_array ( 'Configure General Settings' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configgeneral.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['general']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Automation Settings' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configauto.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['automation']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Email Templates' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configemailtemplates.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['emailtpls']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Fraud Protection' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configfraud.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['fraud']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Client Groups' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configclientgroups.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['clientgroups']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Custom Client Fields' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configcustomfields.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['customclientfields']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Administrators' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configadmins.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['admins']; ?>
</a></li><?php else: ?><li><a title="" href="myaccount.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['myaccount']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Admin Roles' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configadminroles.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['adminroles']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Addon Modules' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configaddonmods.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['addonmodules']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Currencies' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configcurrencies.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['currencies']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Payment Gateways' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configgateways.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['gateways']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Tax Setup' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configtax.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['tax']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Promotions' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configpromotions.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['promos']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( "Configure Products/Services" , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configproducts.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['products']; ?>
</a></li>
    <li><a title="" href="configproductoptions.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['configoptions']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Product Addons' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configaddons.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['addons']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Domain Pricing' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configdomains.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['domainpricing']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Domain Registrars' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configregistrars.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['registrars']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Servers' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configservers.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['servers']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Support Departments' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configticketdepartments.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['supportdepartments']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Ticket Statuses' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configticketstatuses.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['ticketstatuses']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Support Departments' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configticketescalations.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['escalationrules']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Spam Control' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configticketspamcontrol.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['spam']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Security Questions' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configsecurityqs.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['securityqs']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Ban Control' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configbannedips.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['bannedips']; ?>
</a></li>
    <li><a title="" href="configbannedemails.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['bannedemails']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Database Backups' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="configbackups.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['backups']; ?>
</a></li><?php endif; ?>
  </ul>
</li>
<li class="menuButton"><a title="Help" href="" class="menuFont"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['title']; ?>
</a>
  <ul>
    <li><a title="" href="http://dereferer.ws/?http://docs.whmcs.com/" target="_blank" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['docs']; ?>
</a></li>
    <?php if (in_array ( 'Main Homepage' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemlicense.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['licenseinfo']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure Administrators' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="licenseerror.php?licenseerror=change" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['changelicense']; ?>
</a></li><?php endif; ?>
    <?php if (in_array ( 'Configure General Settings' , $this->_tpl_vars['admin_perms'] )): ?><li><a title="" href="systemupdates.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['updates']; ?>
</a></li>
    <li><a title="" href="systemsupportrequest.php" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['support']; ?>
</a></li><?php endif; ?>
    <li><a title="" href="http://dereferer.ws/?http://forum.whmcs.com/" target="_blank" class="subMenuLinks"><?php echo $this->_tpl_vars['_ADMINLANG']['help']['forums']; ?>
</a></li>
  </ul>
</li>