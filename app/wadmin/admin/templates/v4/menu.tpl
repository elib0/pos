<li class="menuButton"><a href="index.php" title="Home" class="menuFont">{$_ADMINLANG.home.title}</a>
  <ul>
    <li><a title="" href="index.php" class="subMenuLinks">{$_ADMINLANG.global.hometitle}</a></li>
    <li><a title="" href="myaccount.php" class="subMenuLinks">{$_ADMINLANG.global.myaccount}</a></li>
    <li><a title="" href="logout.php" class="subMenuLinks">{$_ADMINLANG.global.logout}</a></li>
  </ul>
</li>
<li class="menuButton"><a {if in_array("List Clients",$admin_perms)}href="clients.php"{/if} title="Clients" class="menuFont">{$_ADMINLANG.clients.title}</a>
  <ul>
    {if in_array("List Clients",$admin_perms)}<li><a title="" href="clients.php" class="subMenuLinks">{$_ADMINLANG.clients.viewsearch}</a></li>{/if}
    {if in_array("Add New Client",$admin_perms)}<li><a title="" href="clientsadd.php" class="subMenuLinks">{$_ADMINLANG.clients.addnew}</a></li>{/if}
    {if in_array("Mass Mail",$admin_perms)}<li><a title="" href="massmail.php" class="subMenuLinks">{$_ADMINLANG.clients.massmail}</a></li>{/if}
    {if in_array("List Services",$admin_perms)}
    <li><a title="" href="clientshostinglist.php" class="subMenuLinks">{$_ADMINLANG.services.listall}</a></li>
    <li><a title="" href="clientshostinglist.php?type=hostingaccount" class="subMenuLinks">- {$_ADMINLANG.services.listhosting}</a></li>
    <li><a title="" href="clientshostinglist.php?type=reselleraccount" class="subMenuLinks">- {$_ADMINLANG.services.listreseller}</a></li>
    <li><a title="" href="clientshostinglist.php?type=server" class="subMenuLinks">- {$_ADMINLANG.services.listservers}</a></li>
    <li><a title="" href="clientshostinglist.php?type=other" class="subMenuLinks">- {$_ADMINLANG.services.listother}</a></li>
    {/if}
    {if in_array("List Addons",$admin_perms)}<li><a title="" href="clientsaddonslist.php" class="subMenuLinks">{$_ADMINLANG.services.listaddons}</a></li>{/if}
    {if in_array("List Domains",$admin_perms)}<li><a title="" href="clientsdomainlist.php" class="subMenuLinks">{$_ADMINLANG.services.listdomains}</a></li>{/if}
    {if in_array("View Cancellation Requests",$admin_perms)}<li><a title="" href="cancelrequests.php" class="subMenuLinks">{$_ADMINLANG.clients.cancelrequests}</a></li>{/if}
    {if in_array("Manage Affiliates",$admin_perms)}<li><a title="" href="affiliates.php" class="subMenuLinks">{$_ADMINLANG.affiliates.manage}</a></li>{/if}
  </ul>
</li>
<li class="menuButton"><a {if in_array("View Orders",$admin_perms)}href="orders.php"{/if} title="Orders" class="menuFont">{$_ADMINLANG.orders.title}</a>
  <ul>
    {if in_array("View Orders",$admin_perms)}<li><a title="" href="orders.php" class="subMenuLinks">{$_ADMINLANG.orders.listall}</a></li>
    <li><a title="" href="orders.php?status=Pending" class="subMenuLinks">- {$_ADMINLANG.orders.listpending}</a></li>
    <li><a title="" href="orders.php?status=Active" class="subMenuLinks">- {$_ADMINLANG.orders.listactive}</a></li>
    <li><a title="" href="orders.php?status=Fraud" class="subMenuLinks">- {$_ADMINLANG.orders.listfraud}</a></li>
    <li><a title="" href="orders.php?status=Cancelled" class="subMenuLinks">- {$_ADMINLANG.orders.listcancelled}</a></li>{/if}
    {if in_array("Add New Order",$admin_perms)}<li><a title="" href="ordersadd.php" class="subMenuLinks">{$_ADMINLANG.orders.addnew}</a></li>{/if}
  </ul>
</li>
<li class="menuButton"><a {if in_array("List Transactions",$admin_perms)}href="transactions.php"{/if} title="Billing" class="menuFont">{$_ADMINLANG.billing.title}</a>
  <ul>
    {if in_array("List Transactions",$admin_perms)}<li><a title="" href="transactions.php" class="subMenuLinks">{$_ADMINLANG.billing.transactionslist}</a></li>{/if}
    {if in_array("Offline Credit Card Processing",$admin_perms)}<li><a title="" href="offlineccprocessing.php" class="subMenuLinks">{$_ADMINLANG.billing.offlinecc}</a></li>{/if}
    {if in_array("View Gateway Log",$admin_perms)}<li><a title="" href="gatewaylog.php" class="subMenuLinks">{$_ADMINLANG.billing.gatewaylog}</a></li>{/if}
    {if in_array("List Invoices",$admin_perms)}
    <li><a title="" href="invoices.php" class="subMenuLinks">{$_ADMINLANG.invoices.listall}</a></li>
    <li><a title="" href="invoices.php?status=Paid" class="subMenuLinks">- {$_ADMINLANG.status.paid}</a></li>
    <li><a title="" href="invoices.php?status=Unpaid" class="subMenuLinks">- {$_ADMINLANG.status.unpaid}</a></li>
    <li><a title="" href="invoices.php?status=Overdue" class="subMenuLinks">- {$_ADMINLANG.status.overdue}</a></li>
    <li><a title="" href="invoices.php?status=Cancelled" class="subMenuLinks">- {$_ADMINLANG.status.cancelled}</a></li>
    <li><a title="" href="invoices.php?status=Refunded" class="subMenuLinks">- {$_ADMINLANG.status.refunded}</a></li>
    <li><a title="" href="invoices.php?status=Collections" class="subMenuLinks">- {$_ADMINLANG.status.collections}</a></li>{/if}
    {if in_array("View Billable Items",$admin_perms)}<li><a title="" href="billableitems.php" class="subMenuLinks">{$_ADMINLANG.billableitems.listall}</a></li>
    <li><a title="" href="billableitems.php?status=Uninvoiced" class="subMenuLinks">- {$_ADMINLANG.billableitems.uninvoiced}</a></li>
    <li><a title="" href="billableitems.php?status=Recurring" class="subMenuLinks">- {$_ADMINLANG.billableitems.recurring}</a></li>
    {if in_array("Manage Billable Items",$admin_perms)}<li><a title="" href="billableitems.php?action=manage" class="subMenuLinks">- {$_ADMINLANG.billableitems.addnew}</a></li>{/if}{/if}
    {if in_array("Manage Quotes",$admin_perms)}<li><a title="" href="quotes.php" class="subMenuLinks">{$_ADMINLANG.quotes.listall}</a></li>
    <li><a title="" href="quotes.php?validity=Valid" class="subMenuLinks">- {$_ADMINLANG.status.valid}</a></li>
    <li><a title="" href="quotes.php?validity=Expired" class="subMenuLinks">- {$_ADMINLANG.status.expired}</a></li>
    <li><a title="" href="quotes.php?action=manage" class="subMenuLinks">- {$_ADMINLANG.quotes.createnew}</a></li>{/if}
  </ul>
</li>
<li class="menuButton"><a {if in_array("Support Center Overview",$admin_perms)}href="supportcenter.php"{/if} title="Support" class="menuFont">{$_ADMINLANG.support.title}</a>
  <ul>
    {if in_array("Manage Announcements",$admin_perms)}<li><a title="" href="supportannouncements.php" class="subMenuLinks">{$_ADMINLANG.support.announcements}</a></li>{/if}
    {if in_array("Manage Downloads",$admin_perms)}<li><a title="" href="supportdownloads.php" class="subMenuLinks">{$_ADMINLANG.support.downloads}</a></li>{/if}
    {if in_array("Manage Knowledgebase",$admin_perms)}<li><a title="" href="supportkb.php" class="subMenuLinks">{$_ADMINLANG.support.knowledgebase}</a></li>{/if}
    {if in_array("List Support Tickets",$admin_perms)}<li><a title="" href="supporttickets.php" class="subMenuLinks">{$_ADMINLANG.support.supporttickets}</a></li>{/if}
    <li><a title="" href="supporttickets.php?view=flagged" class="subMenuLinks">- {$_ADMINLANG.support.flagged}</a></li>
    {if in_array("List Support Tickets",$admin_perms)}<li><a title="" href="supporttickets.php?view=active" class="subMenuLinks">- {$_ADMINLANG.support.allactive}</a></li>
    <li><a title="" href="supporttickets.php?view=Open" class="subMenuLinks">- Open</a></li>
    <li><a title="" href="supporttickets.php?view=Answered" class="subMenuLinks">- Answered</a></li>
    <li><a title="" href="supporttickets.php?view=Customer-Reply" class="subMenuLinks">- Customer-Reply</a></li>
    <li><a title="" href="supporttickets.php?view=On Hold" class="subMenuLinks">- On Hold</a></li>
    <li><a title="" href="supporttickets.php?view=In Progress" class="subMenuLinks">- In Progress</a></li>
    <li><a title="" href="supporttickets.php?view=Closed" class="subMenuLinks">- Closed</a></li>{/if}
    {if in_array("Open New Ticket",$admin_perms)}<li><a title="" href="supporttickets.php?action=open" class="subMenuLinks">{$_ADMINLANG.support.opennewticket}</a></li>{/if}
    {if in_array("Manage Predefined Replies",$admin_perms)}<li><a title="" href="supportticketpredefinedreplies.php" class="subMenuLinks">{$_ADMINLANG.support.predefreplies}</a></li>{/if}
    {if in_array("Manage Network Issues",$admin_perms)}<li><a title="" href="networkissues.php" class="subMenuLinks">{$_ADMINLANG.networkissues.title}</a></li>
    <li><a title="" href="networkissues.php" class="subMenuLinks">- {$_ADMINLANG.networkissues.open}</a></li>
    <li><a title="" href="networkissues.php?view=scheduled" class="subMenuLinks">- {$_ADMINLANG.networkissues.scheduled}</a></li>
    <li><a title="" href="networkissues.php?view=resolved" class="subMenuLinks">- {$_ADMINLANG.networkissues.resolved}</a></li>
    <li><a title="" href="networkissues.php?action=manage" class="subMenuLinks">- {$_ADMINLANG.networkissues.addnew}</a></li>{/if}
  </ul>
</li>
{if in_array("View Reports",$admin_perms)}<li class="menuButton"><a title="Reports" href="reports.php" class="menuFont">{$_ADMINLANG.reports.title}</a>
  <ul>
    <li><a title="" href="reports.php#reports" class="subMenuLinks">{$_ADMINLANG.reports.title}</a></li>
    <li><a title="" href="reports.php#graphs" class="subMenuLinks">{$_ADMINLANG.reports.graphs}</a></li>
    <li><a title="" href="reports.php#exports" class="subMenuLinks">{$_ADMINLANG.reports.exports}</a></li>
    {if in_array("CSV Downloads",$admin_perms)}<li><a title="" href="csvdownload.php?type=clients" class="subMenuLinks">- {$_ADMINLANG.clients.title}</a></li>
    <li><a title="" href="csvdownload.php?type=products" class="subMenuLinks">- {$_ADMINLANG.services.title}</a></li>
    <li><a title="" href="csvdownload.php?type=domains" class="subMenuLinks">- {$_ADMINLANG.domains.title}</a></li>
    <li><a title="" href="reports.php?report=transactions" class="subMenuLinks">- {$_ADMINLANG.billing.transactionslist}</a></li>
    <li><a title="" href="reports.php?report=pdfbatch" class="subMenuLinks">- {$_ADMINLANG.reports.pdfbatch}</a></li>{/if}
  </ul>
</li>{/if}
<li class="menuButton"><a title="Utilities" href="" class="menuFont">{$_ADMINLANG.utilities.title}</a>
  <ul>
    {if in_array("Link Tracking",$admin_perms)}<li><a title="" href="utilitieslinktracking.php" class="subMenuLinks">{$_ADMINLANG.utilities.linktracking}</a></li>{/if}
    {if in_array("Browser",$admin_perms)}<li><a title="" href="browser.php" class="subMenuLinks">{$_ADMINLANG.utilities.browser}</a></li>{/if}
    {if in_array("Calendar",$admin_perms)}<li><a title="" href="calendar.php" class="subMenuLinks">{$_ADMINLANG.utilities.calendar}</a></li>{/if}
    {if in_array("To-Do List",$admin_perms)}<li><a title="" href="todolist.php" class="subMenuLinks">{$_ADMINLANG.utilities.todolist}</a></li>{/if}
    {if in_array("WHOIS Lookups",$admin_perms)}<li><a title="" href="whois.php" class="subMenuLinks">{$_ADMINLANG.utilities.whois}</a></li>{/if}
    {if in_array("Domain Resolver Checker",$admin_perms)}<li><a title="" href="utilitiesresolvercheck.php" class="subMenuLinks">{$_ADMINLANG.utilities.domainresolver}</a></li>{/if}
    {if in_array("View Integration Code",$admin_perms)}<li><a title="" href="systemintegrationcode.php" class="subMenuLinks">{$_ADMINLANG.utilities.integrationcode}</a></li>{/if}
    {if in_array("WHM Import Script",$admin_perms)}<li><a title="" href="whmimport.php" class="subMenuLinks">{$_ADMINLANG.utilities.cpanelimport}</a></li>{/if}
    {if in_array("Database Status",$admin_perms)}<li><a title="" href="systemdatabase.php" class="subMenuLinks">{$_ADMINLANG.utilities.dbstatus}</a></li>{/if}
    {if in_array("System Cleanup Operations",$admin_perms)}<li><a title="" href="systemcleanup.php" class="subMenuLinks">{$_ADMINLANG.utilities.syscleanup}</a></li>{/if}
    {if in_array("View PHP Info",$admin_perms)}<li><a title="" href="systemphpinfo.php" class="subMenuLinks">{$_ADMINLANG.utilities.phpinfo}</a></li>{/if}
    {if in_array("View Activity Log",$admin_perms)}<li><a title="" href="systemactivitylog.php" class="subMenuLinks">{$_ADMINLANG.utilities.activitylog}</a></li>{/if}
    {if in_array("View Admin Log",$admin_perms)}<li><a title="" href="systemadminlog.php" class="subMenuLinks">{$_ADMINLANG.utilities.adminlog}</a></li>{/if}
    {if in_array("View Email Message Log",$admin_perms)}<li><a title="" href="systememaillog.php" class="subMenuLinks">{$_ADMINLANG.utilities.emaillog}</a></li>{/if}
    {if in_array("View Ticket Mail Import Log",$admin_perms)}<li><a title="" href="systemmailimportlog.php" class="subMenuLinks">{$_ADMINLANG.utilities.ticketmaillog}</a></li>{/if}
    {if in_array("View WHOIS Lookup Log",$admin_perms)}<li><a title="" href="systemwhoislog.php" class="subMenuLinks">{$_ADMINLANG.utilities.whoislog}</a></li>{/if}
  </ul>
</li>
{if $addon_modules}
<li class="menuButton"><a title="Addons" href="addonmodules.php" class="menuFont">{$_ADMINLANG.utilities.addonmodules}</a>
  <ul>
    {foreach from=$addon_modules key=module item=displayname}
    <li><a title="" href="addonmodules.php?module={$module}" class="subMenuLinks">{$displayname}</a></li>
    {/foreach}
  </ul>
</li>
{/if}
<li class="menuButton"><a title="Setup" href="" class="menuFont">{$_ADMINLANG.setup.title}</a>
  <ul>
    {if in_array("Configure General Settings",$admin_perms)}<li><a title="" href="configgeneral.php" class="subMenuLinks">{$_ADMINLANG.setup.general}</a></li>{/if}
    {if in_array("Configure Automation Settings",$admin_perms)}<li><a title="" href="configauto.php" class="subMenuLinks">{$_ADMINLANG.setup.automation}</a></li>{/if}
    {if in_array("Configure Email Templates",$admin_perms)}<li><a title="" href="configemailtemplates.php" class="subMenuLinks">{$_ADMINLANG.setup.emailtpls}</a></li>{/if}
    {if in_array("Configure Fraud Protection",$admin_perms)}<li><a title="" href="configfraud.php" class="subMenuLinks">{$_ADMINLANG.setup.fraud}</a></li>{/if}
    {if in_array("Configure Client Groups",$admin_perms)}<li><a title="" href="configclientgroups.php" class="subMenuLinks">{$_ADMINLANG.setup.clientgroups}</a></li>{/if}
    {if in_array("Configure Custom Client Fields",$admin_perms)}<li><a title="" href="configcustomfields.php" class="subMenuLinks">{$_ADMINLANG.setup.customclientfields}</a></li>{/if}
    {if in_array("Configure Administrators",$admin_perms)}<li><a title="" href="configadmins.php" class="subMenuLinks">{$_ADMINLANG.setup.admins}</a></li>{else}<li><a title="" href="myaccount.php" class="subMenuLinks">{$_ADMINLANG.global.myaccount}</a></li>{/if}
    {if in_array("Configure Admin Roles",$admin_perms)}<li><a title="" href="configadminroles.php" class="subMenuLinks">{$_ADMINLANG.setup.adminroles}</a></li>{/if}
    {if in_array("Configure Addon Modules",$admin_perms)}<li><a title="" href="configaddonmods.php" class="subMenuLinks">{$_ADMINLANG.setup.addonmodules}</a></li>{/if}
    {if in_array("Configure Currencies",$admin_perms)}<li><a title="" href="configcurrencies.php" class="subMenuLinks">{$_ADMINLANG.setup.currencies}</a></li>{/if}
    {if in_array("Configure Payment Gateways",$admin_perms)}<li><a title="" href="configgateways.php" class="subMenuLinks">{$_ADMINLANG.setup.gateways}</a></li>{/if}
    {if in_array("Configure Tax Setup",$admin_perms)}<li><a title="" href="configtax.php" class="subMenuLinks">{$_ADMINLANG.setup.tax}</a></li>{/if}
    {if in_array("Configure Promotions",$admin_perms)}<li><a title="" href="configpromotions.php" class="subMenuLinks">{$_ADMINLANG.setup.promos}</a></li>{/if}
    {if in_array("Configure Products/Services",$admin_perms)}<li><a title="" href="configproducts.php" class="subMenuLinks">{$_ADMINLANG.setup.products}</a></li>
    <li><a title="" href="configproductoptions.php" class="subMenuLinks">{$_ADMINLANG.setup.configoptions}</a></li>{/if}
    {if in_array("Configure Product Addons",$admin_perms)}<li><a title="" href="configaddons.php" class="subMenuLinks">{$_ADMINLANG.setup.addons}</a></li>{/if}
    {if in_array("Configure Domain Pricing",$admin_perms)}<li><a title="" href="configdomains.php" class="subMenuLinks">{$_ADMINLANG.setup.domainpricing}</a></li>{/if}
    {if in_array("Configure Domain Registrars",$admin_perms)}<li><a title="" href="configregistrars.php" class="subMenuLinks">{$_ADMINLANG.setup.registrars}</a></li>{/if}
    {if in_array("Configure Servers",$admin_perms)}<li><a title="" href="configservers.php" class="subMenuLinks">{$_ADMINLANG.setup.servers}</a></li>{/if}
    {if in_array("Configure Support Departments",$admin_perms)}<li><a title="" href="configticketdepartments.php" class="subMenuLinks">{$_ADMINLANG.setup.supportdepartments}</a></li>{/if}
    {if in_array("Configure Ticket Statuses",$admin_perms)}<li><a title="" href="configticketstatuses.php" class="subMenuLinks">{$_ADMINLANG.setup.ticketstatuses}</a></li>{/if}
    {if in_array("Configure Support Departments",$admin_perms)}<li><a title="" href="configticketescalations.php" class="subMenuLinks">{$_ADMINLANG.setup.escalationrules}</a></li>{/if}
    {if in_array("Configure Spam Control",$admin_perms)}<li><a title="" href="configticketspamcontrol.php" class="subMenuLinks">{$_ADMINLANG.setup.spam}</a></li>{/if}
    {if in_array("Configure Security Questions",$admin_perms)}<li><a title="" href="configsecurityqs.php" class="subMenuLinks">{$_ADMINLANG.setup.securityqs}</a></li>{/if}
    {if in_array("Configure Ban Control",$admin_perms)}<li><a title="" href="configbannedips.php" class="subMenuLinks">{$_ADMINLANG.setup.bannedips}</a></li>
    <li><a title="" href="configbannedemails.php" class="subMenuLinks">{$_ADMINLANG.setup.bannedemails}</a></li>{/if}
    {if in_array("Configure Database Backups",$admin_perms)}<li><a title="" href="configbackups.php" class="subMenuLinks">{$_ADMINLANG.setup.backups}</a></li>{/if}
  </ul>
</li>
<li class="menuButton"><a title="Help" href="" class="menuFont">{$_ADMINLANG.help.title}</a>
  <ul>
    <li><a title="" href="http://dereferer.ws/?http://docs.whmcs.com/" target="_blank" class="subMenuLinks">{$_ADMINLANG.help.docs}</a></li>
    {if in_array("Main Homepage",$admin_perms)}<li><a title="" href="systemlicense.php" class="subMenuLinks">{$_ADMINLANG.help.licenseinfo}</a></li>{/if}
    {if in_array("Configure Administrators",$admin_perms)}<li><a title="" href="licenseerror.php?licenseerror=change" class="subMenuLinks">{$_ADMINLANG.help.changelicense}</a></li>{/if}
    {if in_array("Configure General Settings",$admin_perms)}<li><a title="" href="systemupdates.php" class="subMenuLinks">{$_ADMINLANG.help.updates}</a></li>
    <li><a title="" href="systemsupportrequest.php" class="subMenuLinks">{$_ADMINLANG.help.support}</a></li>{/if}
    <li><a title="" href="http://dereferer.ws/?http://forum.whmcs.com/" target="_blank" class="subMenuLinks">{$_ADMINLANG.help.forums}</a></li>
  </ul>
</li>